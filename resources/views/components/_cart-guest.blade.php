<div class="form-floating mb-2">
    <input type="email"
        class="form-control @error('email') is-invalid @enderror"
        name="email"
        id="formEmail"
        placeholder="Электронная почта"
        value="{{ old('email') }}"
        required>
    <label for="formEmail">Электронная почта</label>
    @error('email')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-floating mb-2">
    <input type="text"
        class="form-control @error('name') is-invalid @enderror"
        name="name" id="formName"
        placeholder="Имя"
        value="{{ old('name') }}"
        required>
    <label for="formName">Имя</label>
    @error('name')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="form-floating mb-2">
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

<div class="form-floating mb-2">
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

<div class="form-floating">
    <input type="text"
        class="form-control @error('address') is-invalid @enderror"
        name="address" id="formAddress"
        placeholder="Адрес"
    >
    <label for="formAddress">Адрес</label>
    @error('address')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
