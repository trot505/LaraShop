@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                name="name"
                                id="formName"
                                placeholder="Ваше имя"
                                value="{{ old('name') }}"
                                autocomplete="name"
                                required
                                autofocus
                                >
                            <label for="formName">Ваше имя</label>
                            @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                name="email"
                                id="formEmail"
                                placeholder="Электроннная почта"
                                value="{{ old('email') }}"
                                autocomplete="email"
                                required
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
                                autocomplete="new-password"
                                required
                                >
                            <label for="formPassword">Пароль</label>
                            @error('password')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                name="password_confirmation"
                                id="formPasswordConfirm"
                                placeholder="Подтверждение пароля"
                                required
                                >
                            <label for="formPasswordConfirm">Подтверждение пароля</label>
                            @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
