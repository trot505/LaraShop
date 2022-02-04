<div class="row mb-2 border-2 border-bottom align-items-center {{($loop->first) ? 'border-top' : ''}} border-secondary p-2">
    <div class="col-2 d-flex flex-column border-end p-2">
        <small class="text-muted">Дата :</small>
        <div class="fs-4 mt-1">{{$order->updated_at->format('d.m.Y H:i')}}</div>
    </div>
    <div class="col-2 d-flex flex-column border-end p-2">
        <small class="text-muted">Номер :</small>
        <div class="fs-4 mt-1 text-center">{{$order->id}}</div>
    </div>
    <div class="col-2 d-flex flex-column border-end p-2">
        <small class="text-muted">Сумма :</small>
        <div class="fs-4 mt-1 text-center">{{$order->sum}}<i class="fas fa-ruble-sign fs-4 ms-1"></i></div>
    </div>
    <div class="col-5 d-flex flex-column border-end p-2">
        <small class="text-muted">Адрес доставки :</small>
        <div class="fs-5 mt-1 text-center">{{$order->address}}</div>
    </div>
    <div class="col-1 btn-group p-2" role="group">
        <a href="{{route('repeatOrder',$order)}}" class="btn btn-outline-secondary"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Повторить заказ"
            >
            <i class="fas fa-redo fs-3 text-teal"></i>
        </a>
        <a href="#" class="btn btn-outline-secondary"
            data-bs-toggle="tooltip" data-bs-placement="bottom" title="Информация о товаре"
            >
            <i class="fas fa-chevron-down fs-3"></i>
        </a>
    </div>
</div>
