<li class="nav-item">
    <a class="nav-link d-flex" href="{{ route('adminUsers') }}"><i class="fas fa-users"></i>Пользователи</a>
</li>
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        <i class="fas fa-layer-group mr-2"></i>Каталог
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('categories') }}">Категории</a>
        <a class="dropdown-item" href="{{ route('products') }}">Продукты</a>
    </div>
</li>
