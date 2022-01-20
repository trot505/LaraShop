@extends('admin.layouts.app')

@section('content')
    <h1>{{ $title }} <a class="link-info float-end fs-5 lh-base" href="{{route('productCreate')}}" role="button">Добавить товар</a></h1>
    <div class="d-flex flex-wrap align-items-stretch justify-content-around">
    @forelse ($products as $product)
            @include('components._product-card',$product)
    @empty
        <div class="fs-3 text-warning">{{ $title }} пуст</div>
    @endforelse
    </div>
@endsection
