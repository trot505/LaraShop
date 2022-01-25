@extends('layouts.app')

@section('content')
<div class="row row-cols-3 g-3">
    @forelse ($categories as $category)
            @php
                $countProiducts = $category->products->count() ?? 0;
            @endphp
            @include('components._category-card',['category' => $category, 'countProducts' => $countProiducts])
    @empty
        <div class="fs-3 text-warning">{{ $title }} пуст</div>
    @endforelse
</div>
@endsection
