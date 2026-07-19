@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card shadow-sm border-0" style="height: 80vh; display: flex; flex-direction: column;">
                <!-- Header -->
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 fw-bold flex items-center gap-1">
                        <i class="bi bi-robot me-2"></i> <span class="bg-gradient-to-r from-amber-300 to-yellow-200 bg-clip-text text-transparent font-black tracking-wide filter drop-shadow-[0_0_8px_rgba(251,191,36,0.2)]">Jasolu AI</span> Assistant
                    </h5>
                    <span class="badge bg-light text-primary py-2 px-3">Gemini 3.5 Flash</span>
                </div>

                <!-- Chat Area -->
                <div class="card-body p-4" id="chat-container" style="flex-grow: 1; overflow-y: auto; background-color: #f8f9fa;">
                    <!-- Welcome Message -->
                    <div class="d-flex mb-4">
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                            <i class="bi bi-robot fs-5"></i>
                        </div>
                        <div class="message-content bg-white p-3 rounded shadow-sm" style="max-width: 80%;">
                            <p class="mb-1 font-black bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">Jasolu AI</p>
                            <p class="mb-0 text-slate-600 leading-relaxed">
                                Halo! Saya adalah Asisten AI bengkel <span class="font-extrabold text-indigo-600">Jasolu Service</span>. Saya bisa membantu Anda memeriksa <span class="font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-lg border border-amber-200">stok suku cadang (harga & ketersediaan)</span> dan <span class="font-bold text-rose-700 bg-rose-50 px-2 py-0.5 rounded-lg border border-rose-200">antrean service hari ini</span> secara cepat.
                            </p>
                            
                            <hr class="my-2">
                            <p class="mb-2 text-muted small"><i class="bi bi-lightbulb"></i> Coba tanyakan hal seperti ini:</p>
                            <div class="d-flex flex-wrap gap-2">
                                <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn">Ada berapa stok oli yang tersisa?</button>
                                <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn">Berapa harga kampas rem?</button>
                                <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn">Siapa saja yang antre service hari ini?</button>
                                <button type="button" class="btn btn-outline-primary btn-sm suggestion-btn">Cari status service dengan plat nomor...</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Input Footer -->
                <div class="card-footer bg-white border-top p-3">
                    <form id="chat-form">
                        @csrf
                        <div class="input-group">
                            <input type="text" id="chat-input" class="form-control py-2 shadow-none" placeholder="Tanyakan stok suku cadang atau status antrean di sini..." autocomplete="off" required>
                            <button class="btn btn-primary px-4" type="submit" id="send-btn">
                                <i class="bi bi-send-fill" id="send-icon"></i>
                                <span class="spinner-border spinner-border-sm d-none" id="send-spinner" role="status"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling bubble chat */
    .message-content {
        line-height: 1.5;
    }
    .message-content p:last-child {
        margin-bottom: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatContainer = document.getElementById('chat-container');
        const chatForm = document.getElementById('chat-form');
        const chatInput = document.getElementById('chat-input');
        const sendBtn = document.getElementById('send-btn');
        const sendIcon = document.getElementById('send-icon');
        const sendSpinner = document.getElementById('send-spinner');
        const suggestionBtns = document.querySelectorAll('.suggestion-btn');

        // Fungsi scroll otomatis ke paling bawah
        function scrollToBottom() {
            chatContainer.scrollTop = chatContainer.scrollHeight;
        }

        // Jalankan scroll pertama kali
        scrollToBottom();

        // Handler untuk tombol saran pertanyaan
        suggestionBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                chatInput.value = this.innerText;
                chatInput.focus();
            });
        });

        // Submit Form Chat
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const question = chatInput.value.trim();
            if (!question) return;

            // 1. Tampilkan pesan user ke layar
            appendUserMessage(question);
            chatInput.value = '';
            scrollToBottom();

            // 2. Set loading state pada tombol
            setLoading(true);

            // 3. Tampilkan dummy bubble loading
            const loadingId = appendLoadingBubble();
            scrollToBottom();

            // 4. Kirim data ke backend menggunakan Fetch API
            fetch("{{ route('ai.chat') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ question: question })
            })
            .then(response => response.json().then(data => ({ status: response.status, body: data })))
            .then(res => {
                // Hapus bubble loading
                document.getElementById(loadingId).remove();

                if (res.status === 200 && res.body.status === 'success') {
                    appendAIMessage(res.body.reply);
                } else {
                    appendErrorMessage(res.body.message || 'Terjadi kesalahan sistem.');
                }
                scrollToBottom();
            })
            .catch(error => {
                document.getElementById(loadingId).remove();
                appendErrorMessage('Gagal menghubungi asisten AI. Silakan periksa jaringan internet atau API Key Anda.');
                scrollToBottom();
            })
            .finally(() => {
                setLoading(false);
            });
        });

        // Fungsi menampilkan pesan User
        function appendUserMessage(text) {
            const messageHtml = `
                <div class="d-flex justify-content-end mb-4">
                    <div class="message-content bg-primary text-white p-3 rounded shadow-sm" style="max-width: 80%;">
                        <p class="mb-1 fw-bold">Anda</p>
                        <p class="mb-0">${escapeHtml(text)}</p>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', messageHtml);
        }

        // Fungsi menampilkan pesan AI
        function appendAIMessage(markdownText) {
            // Parser markdown sederhana untuk menampilkan baris baru, tebal, dan list
            const formattedText = parseMarkdown(markdownText);
            
            const messageHtml = `
                <div class="d-flex mb-4">
                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                        <i class="bi bi-robot fs-5"></i>
                    </div>
                    <div class="message-content bg-white p-3 rounded shadow-sm" style="max-width: 80%;">
                        <p class="mb-1 font-black bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">Jasolu AI</p>
                        <div class="mb-0">${formattedText}</div>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', messageHtml);
        }

        // Fungsi menampilkan bubble Loading
        function appendLoadingBubble() {
            const id = 'loading-' + Date.now();
            const messageHtml = `
                <div class="d-flex mb-4" id="${id}">
                    <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                        <i class="bi bi-robot fs-5"></i>
                    </div>
                    <div class="message-content bg-white p-3 rounded shadow-sm" style="max-width: 80%;">
                        <p class="mb-1 font-black bg-gradient-to-r from-indigo-600 to-violet-600 bg-clip-text text-transparent">Jasolu AI</p>
                        <div class="d-flex align-items-center gap-2 text-muted">
                            <div class="spinner-grow spinner-grow-sm" role="status"></div>
                            <span>Berpikir...</span>
                        </div>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', messageHtml);
            return id;
        }

        // Fungsi menampilkan pesan Error
        function appendErrorMessage(errorMsg) {
            const messageHtml = `
                <div class="d-flex mb-4">
                    <div class="avatar bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px; min-width: 40px;">
                        <i class="bi bi-exclamation-triangle fs-5"></i>
                    </div>
                    <div class="message-content bg-danger-subtle border border-danger-subtle text-danger-emphasis p-3 rounded shadow-sm" style="max-width: 80%;">
                        <p class="mb-1 fw-bold text-danger">Sistem Error</p>
                        <p class="mb-0">${escapeHtml(errorMsg)}</p>
                    </div>
                </div>
            `;
            chatContainer.insertAdjacentHTML('beforeend', messageHtml);
        }

        // Fungsi mengontrol state Loading
        function setLoading(isLoading) {
            if (isLoading) {
                chatInput.disabled = true;
                sendBtn.disabled = true;
                sendIcon.classList.add('d-none');
                sendSpinner.classList.remove('d-none');
            } else {
                chatInput.disabled = false;
                sendBtn.disabled = false;
                sendIcon.classList.remove('d-none');
                sendSpinner.classList.add('d-none');
                chatInput.focus();
            }
        }

        // Sanitasi teks agar aman dari XSS
        function escapeHtml(string) {
            return String(string).replace(/[&<>"']/g, function (s) {
                return {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                }[s];
            });
        }

        // Parser Markdown sederhana untuk Bold, Italic, List, & Line Breaks
        function parseMarkdown(text) {
            let html = escapeHtml(text);
            // Bold (**text**)
            html = html.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
            // Italic (*text*)
            html = html.replace(/\*(.*?)\*/g, '<em>$1</em>');
            // Bullet Points ( - text)
            html = html.replace(/^\s*-\s+(.*?)$/gm, '<li>$1</li>');
            // Bungkus list item dengan <ul>
            html = html.replace(/(<li>.*?<\/li>)/gs, '<ul class="ps-3 mb-2">$1</ul>');
            // Perbaiki penutupan double ul yang bertumpuk
            html = html.replace(/<\/ul>\s*<ul class="ps-3 mb-2">/gs, '');
            // Line break / Enter
            html = html.replace(/\n/g, '<br>');
            return html;
        }
    });
</script>

@endsection
