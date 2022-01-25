<div class="col">
<div class="card mb-3 h-100 border-secondary ul_actions_card d-flex flex-row">
    <div class="d-flex flex-column justify-content-end">
      <div class="text-center flex-grow-1 p-1">
        <img src="{{asset(config('my.images_product').$product->picture)}}" class="img-fluid h-100" alt="{{$product->name}}" style="object-fit:contain;">
      </div>
      <div class="d-flex flex-column p-1">
            <h5 class="text-center">{{$product->name}}</h5>
            <div class="d-flex">
                <p class="card-text flex-grow-1"><small class="text-muted">{{substr($product->description,0,35).'...'}}</small></p>
                <div class="vr"></div>
                <div class="price_pdoruct d-flex flex-column ps-1 pe-2">
                    <div class="fs-4 text-info">{{$product->price}}</div>
                    <i class="fas fa-ruble-sign text-secondary text-end pb-2 pe-2"></i>
                </div>
            </div>

        </div>
    </div>
    <ul class="list-group justify-content-end bg-secondary" style="border:none;">
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Информация о товаре">
            <a href="{{route('productShow',$product)}}" class="text-cyan">
                <i class="fas fa-info fs-5"></i>
            </a>
        </li>
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Количество товара">
            <a href="#" class="text-white">
                <i class="fas fa-th-list fs-5"></i>
                <span class="position-absolute start-50 top-0 badge rounded-pill bg-info">{{$product->amount ?? 0}}</span>
            </a>
        </li>
        @if(Auth::user()->is_admin)
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Редактировать товар">
            <a href="{{route('productEdit',$product)}}" class="text-teal">
                <i class="fas fa-pen fs-5"></i>
            </a>
        </li>
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Удалить товар">
            <a href="{{route('productDelete',$product)}}"
                    class="text-danger"
                    onclick="event.preventDefault();
                            document.getElementById('deleteCategory_{{$product->id}}').submit();">
                <i class="far fa-trash-alt fs-5"></i>
            </a>
            <form action="{{route('productDelete',$product)}}" method="POST" id="deleteCategory_{{$product->id}}" class="d-none">
                @method('DELETE')
                @csrf
            </form>
        </li>
        @else
        <li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В корзину">
            <a href="#" class="text-danger">
                <i class="fas fa-cart-plus fs-5"></i>
            </a>
        </li>
        @endif
    </ul>
</div>
</div>
