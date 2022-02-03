<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Увеличить количество">
    <a href="#" class="{{($product->amount === 0) ? 'pe-none text-grey-300' : 'text-warning'}}"
        onclick="event.preventDefault();
                let i = document.getElementById('quantity_{{$product->id}}');
                if (i.value < {{$product->amount}}) i.value++;"
                >
        <i class="fas fa-plus fs-5"></i>
    </a>
</li>
<li class="list-group-item text-center bg-transparent p-0" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В корзину">
    <form action="{{route('addProductCart')}}" method="POST" id="quantityForm_{{$product->id}}">
        @csrf
        <input hidden name="id" value="{{$product->id}}">
        <input class="p-0 m-0 w-100 text-light text-center border-0 bg-transparent focus-none" type="text" name="quantity" id="quantity_{{$product->id}}" value="{{($product->amount !== 0) ? 1 : 0}}" readonly>
    </form>
</li>
<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Уменьшить количество">
    <a href="#" class="{{($product->amount === 0) ? 'pe-none text-grey-300' : 'text-danger'}}"
        onclick="event.preventDefault();
                let i = document.getElementById('quantity_{{$product->id}}');
                if(i.value > 1) i.value--;"
                >
        <i class="fas fa-minus fs-5"></i>
    </a>
</li>

<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В корзину">
    <a href="#"
        class="{{($product->amount === 0) ? 'pe-none text-grey-300' : 'text-teal'}}"
        onclick="event.preventDefault();
                document.getElementById('quantityForm_{{$product->id}}').submit();">
        <i class="fas fa-shopping-basket fs-5"></i>
    </a>
</li>
