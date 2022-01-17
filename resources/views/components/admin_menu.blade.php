<li class="nav-item">
    <a class="nav-link" href="{{ route('adminUsers') }}">Пользователи</a>
</li>
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Каталог
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('adminCategories') }}">Категории</a>
        <a class="dropdown-item" href="{{ route('adminProducts') }}">Продукты</a>
    </div>
</li>