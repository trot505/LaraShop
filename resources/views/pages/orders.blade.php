@extends('layouts.app')

@section('content')
<div class="d-flex mb-3 flex-column">
    <h1 class="flex-fill">{{ $title ?? 'Мои заказы' }}</h1>
    @forelse ($orders as $order)
        @include('components._order-item')
    @empty
        @include('components._clear-title')
    @endforelse
</div>
@endsection
