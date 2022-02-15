<h1>Уважаемый {{$name}} !</h1>
<p>Ваш заказ прнят в обработку, ожидайте уведомления о доставке по адресу {{$address}}.</p>
<small>Состав заказа:</small>
<hr>
@foreach ($products as $product)
    <div>
        <p>{{$product->name}}</p>
        <p>{{$product->price}}</p>
        <p>{{$product->quantity}}</p>
        <p>{{$product->sum}}</p>
    </div>
    <hr>
@endforeach
<div>
    <p>Итого:</p>
    <p>{{$totalSum}}</p>
</div>
