<h2>Tambah Sparepart</h2>

<form action="{{ route('spareparts.store') }}" method="POST">

    @csrf

    <input
        type="text"
        name="code"
        placeholder="Kode">

    <br><br>

    <input
        type="text"
        name="name"
        placeholder="Nama">

    <br><br>

    <input
        type="number"
        name="stock"
        placeholder="Stock">

    <br><br>

    <input
        type="number"
        name="purchase_price"
        placeholder="Harga Beli">

    <br><br>

    <input
        type="number"
        name="selling_price"
        placeholder="Harga Jual">

    <br><br>

    <button>Simpan</button>

</form>