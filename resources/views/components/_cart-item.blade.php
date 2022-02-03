<div class="row mb-2 border-2 border-bottom {{($loop->first) ? 'border-top' : ''}} border-secondary p-2">
    <div class="col-1 text-center ">
        <img class="rounded" src="{{asset(config('my.images_product').$product->picture)}}" alt="{{$product->name}}" style="height: 5em;">
    </div>
    <div class="col-5 d-flex flex-column p-1">
        <h5>{{$product->category->name}}</h5>
        <small class="text-muted">{{$product->name}}</small>
    </div>
    <div class="col-6 d-flex align-items-center justify-content-between">
        <div class="text-center">{{$product->price}}<i class="fas fa-ruble-sign ms-1"></i></div>
        <div class="btn-group me-2 lh-base align-items-center" role="group">
            <a href="#" class="btn btn-outline-secondary text-warning"
                onclick="event.preventDefault();
                        let i = document.getElementById('quantity_{{$product->id}}');
                        if (i.value < {{$product->amount}}) i.value++;"
                        >
                <i class="fas fa-plus fs-5"></i>
            </a>
            <form class="border-0 border-secondary" action="{{route('updateProductCart')}}" method="POST" id="quantityForm_{{$product->id}}">
                @csrf
                <input hidden name="id" value="{{$product->id}}">
                <input class="p-0 m-0 fs-5 lh-base text-info text-center border-0 bg-transparent focus-none" type="text" name="quantity" id="quantity_{{$product->id}}" value="{{$product->quantity}}" style="width:5rem;"readonly>
            </form>
            <a href="#" class="btn btn-outline-secondary text-danger"
                onclick="event.preventDefault();
                        let i = document.getElementById('quantity_{{$product->id}}');
                        if(i.value > 1) i.value--;"
                        >
                <i class="fas fa-minus fs-5"></i>
            </a>
            <a href="#" class="btn btn-outline-secondary text-teal"
                onclick="event.preventDefault();
                        document.getElementById('quantityForm_{{$product->id}}').submit();"
                        >
                <i class="fas fa-sync fs-5"></i>
            </a>
        </div>
        <div class="text-center fs-5">{{$product->sum}}<i class="fas fa-ruble-sign ms-1"></i></div>
        <div class="btn-group me-2 lh-base align-items-center" role="group">
            <a href="{{route('removeProductCart', $product->id)}}" class="btn btn-outline-secondary text-danger">
                <i class="fas fa-trash-alt fs-5"></i>
            </a>
        </div>
    </div>
</div>
