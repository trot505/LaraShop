@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Описание</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td><a href="{{ route('category.edit', $product) }}">{{ $category->name }}</td>
                    <td>{{ $category->description }}</td>
                </tr>
            @empty
                <tr><td class="text-center" colspan="3">{{ $title }} пуст</td></tr>
            @endforelse
            
        </tbody>
    </table>
@endsection