@extends('admin.layouts.app')

@section('content')
    <h1>{{ $title }} <a class="link-info float-end fs-5 lh-base" href="{{route('categoryCreate')}}" role="button">Создать категорию</a> </h1>

            @forelse ($categories as $category)
                @include('components._category-card',$category)
            @empty
                <div>{{ $title }} пуст</div>
            @endforelse

@endsection
