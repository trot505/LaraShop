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
