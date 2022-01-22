@extends('admin.layouts.app')

@section('content')
    <div class="d-flex">
        <h1 class="flex-fill">{{ $title }}</h1>
        <div class="d-flex align-items-center">
            <div class="btn-group float-end lh-base" role="group">
                <a class="btn btn-secondary fs-5 text-warning" href="{{route('categoryCreate')}}" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить  категорию">
                    <i class="fas fa-plus"></i>
                </a>
                <a class="btn btn-secondary fs-5 text-teal" href="{{route('categoryCreate')}}" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Выгрузить в файл">
                    <i class="fas fa-file-upload"></i>
                </a>
            </div>
            <form class="rounded-2 ms-2 bg-secondary d-flex" action="" enctype="multipart/form-data">
                <input class="form-control form-control-sm align-self-center m-1" name="add_file" type="file">
                <a class="btn btn-secondary fs-5 text-info" href="{{route('categoryCreate')}}" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Загрузить из файла">
                    <i class="fas fa-file-download"></i>
                </a>

            </form>
        </div>
    </div>
    <div class="row">
        {{--d-flex flex-wrap align-items-stretch justify-content-around--}}
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
