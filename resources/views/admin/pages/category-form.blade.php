@extends('admin.layouts.app')

@section('content')
<form action="" method="post">
    <input type="text" hidden name="id" value="{{ $category?->id ?? null}}"
    @method('PUT')
    @csrf
    <h1>{{ $title }}</h1>
    <div class="form-floating mb-3">
        <input type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name"
            id="formName"
            placeholder="Имя категории"
            value="{{ $category?->name }}">
        <label for="formEmail">Имя категории</label>
    </div>
    @include('admin.components.category-select')
    <div class="form-floating">
        <textarea class="form-control @error('name') is-invalid @enderror"
            name="name"
            id="formDescription"
            placeholder="Описание категории">{{ $category?->description }}</textarea>
        <label for="formDescription">Описание категории</label>
    </div>

    <button type="submit" class="btn btn-outline-success mt-3 w-100">Сохранить</button>
</form>
@endsection
