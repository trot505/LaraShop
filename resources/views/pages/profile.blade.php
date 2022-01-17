@extends('layouts.app')

@section('content')
    
    @if($errors->isNotEmpty())
    <div class="alert alert-warning" role="alert">

    </div>
    @endif
    <form action="{{ route('profile.update', $user) }}" method="post">    
        @method('PUT')
        @csrf
        <h1>{{ $title }}</h1>
        <div class="form-floating mb-3">
            <input type="email" 
                class="form-control @error('email') is-invalid @enderror" 
                name="email" 
                id="formEmail" 
                placeholder="Электронная почта" 
                value="{{ $user->email }}">
            <label for="formEmail">Электронная почта</label>
        </div>
        <div class="form-floating">
            <input type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                name="name" id="formName" 
                placeholder="Имя" 
                value="{{ $user->name }}">
            <label for="formName">Имя</label>
        </div>
        <button type="submit" class="btn btn-outline-success mt-3 w-100">Сохранить</button>
    </form>
@endsection