@extends('admin.layouts.app')

@section('title', 'Cadastrar novo produto')

@section('content')
    <h1>Cadastrar novo produto</h1>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="form">
        @include('admin.pages.products._parts.form')
    </form>
@endsection