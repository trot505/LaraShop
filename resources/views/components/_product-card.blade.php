<div class="col">
<div class="card mb-3 h-100 border-secondary d-flex flex-row">
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
        @if(Auth::user()?->is_admin)
            @include('admin.components._actions-product-card')
        @else
            @include('components._actions-product-card')
        @endif
    </ul>
</div>
</div>
