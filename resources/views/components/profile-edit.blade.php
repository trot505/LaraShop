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
                @error('avatar')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
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
        @error('email')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-floating">
        <input type="text"
            class="form-control @error('name') is-invalid @enderror"
            name="name" id="formName"
            placeholder="Имя"
            value="{{ $user->name }}">
        <label for="formName">Имя</label>
        @error('name')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="addresses mt-3">
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
                        <td>
                            @if ($loop->first)<form></form>@endif
                            <form class="d-flex flex-row" action="{{route('addressUpdate',$address)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="text" name="address" id="addresFormInput_{{$address->id}}" class="form-control" value="{{ $address->address }}" disabled>
                                <div class="btn-group lh-base me-2" role="group">
                                <button type="submit" id="addresFormBtn_{{$address->id}}" class="btn btn-secondary ms-2 fs-4 text-teal d-none">
                                    <i class="fas fa-sync-alt"></i>
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            @if($address->main)
                            <i class="fas fa-check fs-4 text-success"></i>
                            @endif
                        </td>
                        <td width="5em">
                            <div class="float-end btn-group lh-base me-2" role="group">
                                    <a class="btn btn-secondary fs-4 text-info" href="{{route('addressUpdate', $address)}}" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Сделать основным"
                                    onclick="event.preventDefault();
                                            let f = document.getElementById('mainForm_{{$address->id}}');
                                            f.querySelector('input[name=main]').checked = true;
                                            f.submit();
                                    ">
                                        <i class="far fa-check-circle"></i>
                                    </a>
                                    <form id="mainForm_{{$address->id}}" action="{{route('addressUpdate',$address)}}" method="POST" class="d-none">
                                        @csrf
                                        @method('PUT')
                                        <input type="checkbox" value="1" name="main">
                                    </form>
                                    <a class="btn btn-secondary fs-4 text-teal" href="#" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать адрес"
                                    onclick="event.preventDefault();
                                            let i_{{$address->id}} = document.getElementById('addresFormInput_{{$address->id}}')
                                            i_{{$address->id}}.disabled = false;
                                            i_{{$address->id}}.focus();
                                            document.getElementById('addresFormBtn_{{$address->id}}').classList.remove('d-none');
                                    ">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                    <a class="btn btn-secondary fs-4 text-danger" href="{{route('addressDelete',$address)}}" role="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить адрес"
                                    onclick="event.preventDefault();
                                            document.getElementById('deleteForm_{{$address->id}}').submit();
                                    ">
                                        <i class="far fa-times-circle"></i>
                                    </a>
                                    <form id="deleteForm_{{$address->id}}" action="{{route('addressDelete',$address)}}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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
