@extends('admin.layouts.app')

@section('title', "Editar Produto: $product->name")

@section('content')
    <h1>Editar Produto {{ $product->id }}</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.pages.products._parts.form')
    </form>
@endsection