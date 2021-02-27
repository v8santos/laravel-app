@extends('admin.layouts.app')

@section('title', "Descrição do produto $product->name")

@section('content')

<a href="{{ route('products.index') }}"><<</a><h1> Produto {{ $product->name }}</h1>

<ul class="list-group list-group-flush">
    <li class="list-group-item"><strong>Nome: </strong>{{$product->name}}</li>
    <li class="list-group-item"><strong>Preço: </strong>{{$product->price}}</li>
    <li class="list-group-item"><strong>Descrição: </strong>{{$product->description}}</li>
</ul>

<form action="{{ route('products.destroy', $product->id) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Deletar o produto: {{ $product->name }}</button>
</form>

@endsection