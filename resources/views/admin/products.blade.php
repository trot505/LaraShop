@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Товар</th>
                <th scope="col">Категория</th>
                <th scope="col">Цена</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td><a href="{{ route('product.edit', $product) }}">{{ $product->name }}</td>
                    <td>{{ $category->category_id }}</td>
                    <td>{{ $category->price }}</td>
                </tr>
            @empty
                <tr><td class="text-center" colspan="4">{{ $title }} пуст</td></tr>    
            @endforelse
            
        </tbody>
    </table>
@endsection