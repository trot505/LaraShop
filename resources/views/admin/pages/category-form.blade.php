@extends('admin.layouts.app')

@section('content')
<form action="{{(!empty($category))?route('categoryUpdate', $category):route('categorySave')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if(!empty($category))
        @method('PUT')
        <input type="text" hidden name="id" value="{{ $category->id ?? old('id')}}">
    @endif
    <h1>{{ $title ?? 'Создание категории'}}</h1>
    <div class="form-floating mb-3">
        <input type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name"
            id="formName"
            placeholder="Имя категории"
            value={{ $category->name ?? old('name')}}
            >
        <label for="formName">Имя категории</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control @error('description') is-invalid @enderror"
            name="description"
            id="formDescription"
            placeholder="Описание категории">{{ $category->description ?? old('discription')}}</textarea>
        <label for="formDescription">Описание категории</label>
    </div>
    <div class="mt-3">
        <label for="formPicture" class="form-label">Загрузить изображение категории</label>
        <input id="formPicture" class="form-control form-control-lg align-self-center @error('picture') is-invalid @enderror" type="file" name="picture">
    </div>
    <button type="submit" class="btn btn-outline-success mt-3 w-100">Сохранить</button>
</form>
@endsection
