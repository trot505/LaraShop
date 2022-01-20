@extends('admin.layouts.app')

@section('content')
<form action="{{(!empty($product))?route('productUpdate', $product):route('productSave')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if(!empty($product))
        @method('PUT')
        <input type="text" hidden name="id" value="{{ $product->id ?? old('id')}}">
    @endif
    <h1>{{ $title ?? 'Создание продукта'}}</h1>
    <div class="form-floating mb-3">
        <input type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name"
            id="formName"
            placeholder="Название продукта"
            value={{ $product->name ?? old('name')}}
            >
        <label for="formName">Название продукта</label>
    </div>
    @php
        $defaultSelected = 'категорию';
        $selectName = 'category_id';
        $options = $categories;
        $selected = $product->category_id ?? null;
        $selectOptions = compact('defaultSelected','selectName','options','selected');
    @endphp
    @include('components._select',$selectOptions)
    <div class="form-floating mb-3">
        <input type="text"
            class="form-control @error('price') is-invalid @enderror"
            name="price"
            id="formPrice"
            placeholder="Цена"
            value={{ $product->price ?? old('price')}}
            >
        <label for="formPrice">Цена</label>
    </div>
    <div class="form-floating mb-3">
        <input type="number"
            class="form-control @error('amount') is-invalid @enderror"
            name="amount"
            id="formAmount"
            placeholder="Количество"
            value={{ $product->amount ?? old('amount')}}
            >
        <label for="formAmount">Количество</label>
    </div>
    <div class="form-floating">
        <textarea class="form-control @error('description') is-invalid @enderror"
            name="description"
            id="formDescription"
            placeholder="Описание категории">{{ $product->description ?? old('discription')}}</textarea>
        <label for="formDescription">Описание товара</label>
    </div>
    <div class="mt-3">
        <label for="formPicture" class="form-label">Загрузить изображение товара</label>
        <input id="formPicture" class="form-control form-control-lg align-self-center @error('picture') is-invalid @enderror" type="file" name="picture">
    </div>
    <button type="submit" class="btn btn-outline-success mt-3 w-100">Сохранить</button>
</form>
@endsection
