@extends('layouts.app')
@section('content')
<a href="{{ route('spareparts.edit',$item) }}"
    class="btn btn-warning btn-sm">
    Edit
</a>


<form action="{{ route('spareparts.update',$sparepart) }}" method="POST">

    @csrf

    @method('PUT')

    <input
        type="text"
        name="code"
        value="{{ old('code',$sparepart->code) }}">

    <input
        type="text"
        name="name"
        value="{{ old('name',$sparepart->name) }}">

    <button class="btn btn-warning">

        Update

    </button>


</form>

@endsection