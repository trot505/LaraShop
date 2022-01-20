<div class="card mb-3 category_card align-items-stretch" style="max-width: 425px;">
    <div class="row g-0">
      <div class="col-md-5 text-center p-1">
        <img src="{{asset(config('my.images_product').$category->picture)}}" class="img-fluid h-100" alt="{{$category->name}}" style="object-fit:contain;">
      </div>
      <div class="col-md-7 d-flex align-items-stretch">
        <div class="vr bg-secondary"></div>
        <div class="card-body">
          <h5 class="card-title">{{$category->name}}</h5>
          <p class="card-text"></p>
          <p class="card-text"><small class="text-muted">{{substr($category->description,0,90).'...'}}</small></p>
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
    </div>
</div>
