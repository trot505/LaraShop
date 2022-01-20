@extends('admin.layouts.app')

@section('content')
    <h1>{{ $title }} <a class="link-info float-end fs-5 lh-base" href="{{route('categoryCreate')}}" role="button">Создать категорию</a> </h1>
    <div class="d-flex flex-wrap align-items-stretch justify-content-around">
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
