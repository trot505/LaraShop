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
