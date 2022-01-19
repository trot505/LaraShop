<div class="card mb-3" style="max-width: 380px;">
    <div class="row g-0">
      <div class="col-md-5">
        <img src="{{asset(config('my.images_product').$picture)}}" class="img-fluid rounded-start" alt="{{$name}}">
      </div>
      <div class="col-md-7 d-flex align-items-stretch">
        <ul class="list-group" style="justify-content: space-between;border:none;">
            <li class="list-group-item" style="border:none;">An item</li>
            <li class="list-group-item" style="border:none;">A second item</li>
            <li class="list-group-item" style="border:none;">A third item</li>
        </ul>
        <div class="card-body">
          <h5 class="card-title">{{$name}}</h5>
          <p class="card-text"></p>
          <p class="card-text"><small class="text-muted">{{substr($description,0,120).'...'}}</small></p>
        </div>
      </div>
    </div>
</div>
