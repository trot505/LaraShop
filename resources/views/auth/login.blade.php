@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Авторизация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                id="formEmail"
                                placeholder="Электроннная почта"
                                value="{{ old('email') }}"
                                required
                                autofocus
                                autocomplete="email"
                                >
                            <label for="formEmail">Электронная почта</label>
                            @error('email')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                id="formPassword"
                                placeholder="Пароль"
                                autocomplete="current-password"
                                required
                                >
                            <label for="formPassword">Пароль</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="formRemember" {{ old('remember') ? 'checked' : '' }} name="remember">
                            <label class="form-check-label" for="formRemember">Запомнить меня</label>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">Войти</button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">Забыли пароль?</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </?div>
        </div>
    </div>
</div>
@endsection
