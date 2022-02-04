@extends('layouts.app')

@section('content')
<div class="d-flex mb-3 flex-column">
    <h1 class="flex-fill">{{ $title ?? 'Моя корзина' }}</h1>
    <div class="flex-fill mt-3">
    @if ($products && $products->count() > 0)
        @php $totalSum = 0; @endphp
        @foreach ($products as $product)
            @php $totalSum += $product->sum; @endphp
            @include('components._cart-item')
        @endforeach
        <div class="mb-2 p-2 text-end fs-3">
            <small class="me-2">Итого к оплате:</small>{{$totalSum}}<i class="fas fa-ruble-sign ms-1"></i>
        </div>
        <form action="{{route('createOrder')}}" method="post" class="d-flex flex-column mt-3">
            @csrf
            <h4>Данные о заказчике и адресе доставки:</h4>
            @auth
                @include('components._cart-auth')
            @endauth
            @guest
                @include('components._cart-guest')
            @endguest
            <button type="submit" class="btn btn-outline-success mt-3 w-100">Оформить заказ</button>
        </form>
    @else
        <div class="text-warning fs-4 text-center">Корзина пуста начать <a href="{{route('home')}}" class="link-info">покупки !</a></div>
    @endif
    </div>
</div>
@endsection
