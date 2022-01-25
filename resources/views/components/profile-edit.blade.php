<form action="{{ route('profile.update', $user) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <h1>{{ $title }}</h1>
    <div class="mb-3">
        <div class="row">
            <div class="col-3 text-center">
                <img class="rounded" src="{{asset(config('my.images_user').$user->avatar)}}" alt="Аватар пользователя" style="height: 12em;">
            </div>
            <div class="col-9 d-flex">
                <input class="form-control form-control-lg align-self-center @error('avatar') is-invalid @enderror" type="file" name="avatar">
            </div>
        </div>
    </div>
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
    <div class="addresses">
        <h5>Адреса пользователя</h5>
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">Адрес пользователя</th>
                    <th scope="col">Основной</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user->addresses as $address)
                    <tr style="vertical-align: middle;">
                        <td>{{ $address->address }}</td>
                        <td class="text-center">
                            @if($address->main)
                                <span class="border border-2 border-info rounded-3 text-info " style="padding:.2em .4em">v</span>
                            @endif
                        </td>
                        <td class="text-center" width="5em">
                            <div class="btn-group" role="group">
                                <a href="#" class="btn btn-outline-primary">Основной</a>
                                <a href="#" class="btn btn-outline-success">Редактировать</a>
                                <a href="#" class="btn btn-outline-danger">Удалить</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center" colspan="3">Список адресов пуст</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="row gx-3 gy-2 align-items-center">
            <div class="col-10 form-floating">
                <input type="text"
                    class="form-control"
                    name="address" id="formAddress"
                    placeholder="Адрес"
                >
                <label for="formAddress">Адрес</label>
            </div>
            <div class="col-2 form-check form-switch">
                <input class="form-check-input" type="checkbox" id="formMainAddress" value="1" name="main">
                <label class="form-check-label" for="formMainAddress">Основной адрес</label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-outline-success mt-3 w-100">Сохранить</button>
</form>
