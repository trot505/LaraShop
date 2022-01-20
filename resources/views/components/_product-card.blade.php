<div class="card mb-3 ul_actions_card align-items-stretch d-flex flex-row" style="max-width: 280px;">
    <div class="g-0 d-flex flex-column">
      <div class="text-center p-1">
        <img src="{{asset(config('my.images_product').$picture)}}" class="img-fluid h-100" alt="{{$name}}" style="object-fit:contain;">
      </div>
      <div class="d-flex align-items-stretch">
        <div class="card-body">
            <h5 class="card-title">{{$name}}</h5>
            <div class="d-flex">
                <p class="card-text w-100"><small class="text-muted">{{substr($description,0,35).'...'}}</small></p>
                <div cass="flex-shrink-2 fs-4">{{$price}} <i class="fas fa-ruble-sign"></i></div>
            </div>
        </div>
      </div>
    </div>
    <ul class="list-group justify-content-end bg-secondary" style="border:none;">
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Информация о категории">
            <a href="#" class="text-cyan">
                <i class="fas fa-info fs-4"></i>
            </a>
        </li>
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Количество товара в категории">
            <a href="#" class="text-white">
                <i class="fas fa-th-list fs-4"></i>
                <span class="position-absolute start-50 top-0 badge rounded-pill bg-info">{{$countProducts ?? 0}}</span>
            </a>
        </li>
        @if(Auth::user()->is_admin)
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать категорию">
            <a href="#" class="text-teal">
                <i class="fas fa-pen fs-4"></i>
            </a>
        </li>
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить категорию">
            <a href="#" class="text-danger">
                <i class="far fa-trash-alt fs-4"></i>
            </a>
        </li>
        @endif
    </ul>
</div>
