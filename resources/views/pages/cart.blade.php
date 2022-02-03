@extends('layouts.app')

@section('content')
<div class="d-flex mb-3 flex-column">
    <h1 class="flex-fill">{{ $title ?? 'Ваша корзина' }}</h1>
    <div class="flex-fill mt-3">
    @if ($products)
        @php $totalSum = 0; @endphp
        @foreach ($products as $product)
            @php $totalSum += $product->sum; @endphp
            @include('components._cart-item')
        @endforeach
        <div class="mb-2 p-2 text-end fs-3">
            <small class="me-2">Итого к оплате:</small>{{$totalSum}}<i class="fas fa-ruble-sign ms-1"></i>
        </div>
        <a href="" class="btn btn-outline-success mt-3 w-100">Оформить заказ</a>
    @else
        <div class="text-warning fs-4 text-center">Корзина пуста начать <a href="{{route('home')}}" class="link-info">покупки !</a></div>
    @endif
    </div>
</div>
@endsection
