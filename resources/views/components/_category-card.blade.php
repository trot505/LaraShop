<div class="col">
    <div class="d-flex bg-white rounded-2 border border-secondary">
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
                <a href="{{route('categoryShow',$category)}}" class="text-cyan">
                    <i class="fas fa-info fs-5"></i>
                </a>
            </li>
            <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Количество товара в категории">
                <a href="{{route('productCategory',$category)}}" class="text-white">
                    <i class="fas fa-th-list fs-5"></i>
                    <span class="position-absolute start-50 top-0 badge rounded-pill bg-info">{{$countProducts ?? 0}}</span>
                </a>
            </li>
            @if(Auth::user()->is_admin)
            <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Добавить товар">
                <a href="{{route('createProductCategory', $category)}}" class="text-warning">
                    <i class="fas fa-plus fs-5"></i>
                </a>
            </li>
            <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать категорию">
                <a href="{{route('categoryEdit',$category)}}" class="text-teal">
                    <i class="fas fa-pen fs-5"></i>
                </a>
            </li>
            <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить категорию">
                <a href="{{route('categoryDelete',$category)}}"
                    class="text-danger"
                    onclick="event.preventDefault();
                            document.getElementById('deleteCategory_{{$category->id}}').submit();">
                    <i class="far fa-trash-alt fs-5"></i>
                </a>
                <form action="{{route('categoryDelete',$category)}}" method="POST" id="deleteCategory_{{$category->id}}" class="d-none">
                    @method('DELETE')
                    @csrf
                </form>
            </li>
            @endif
        </ul>
      </div>
    </div>
</div>
