<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Увеличить количество">
    <a href="#" class="text-warning"
        onclick="event.preventDefault();
                let i = document.getElementById('amount_{{$product->id}}');
                if (i.value < {{$product->amount}}) i.value++;"
                >
        <i class="fas fa-plus fs-5"></i>
    </a>
</li>
<li class="list-group-item text-center bg-transparent p-0" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В корзину">
    <form action="" method="POST" id="amountForm_{{$product->id}}">
        @csrf
        <input class="p-0 m-0 w-100 text-light text-center border-0 bg-transparent focus-none" type="text" name="amount" id="amount_{{$product->id}}" value="0" readonly>
    </form>
</li>
<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Уменьшить количество">
    <a href="#" class="text-danger"
        onclick="event.preventDefault();
                let i = document.getElementById('amount_{{$product->id}}');
                if(i.value > 0) i.value--;"
                >
        <i class="fas fa-minus fs-5"></i>
    </a>
</li>

<li class="list-group-item text-center bg-transparent" style="border:none;" data-bs-toggle="tooltip" data-bs-placement="bottom" title="В корзину">
    <a href="#"
        class="text-teal"
        onclick="event.preventDefault();
                document.getElementById('amountForm_{{$product->id}}').submit();">
        <i class="fas fa-shopping-basket fs-5"></i>
    </a>
</li>
