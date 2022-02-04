<div class="form-floating mb-3">
    <select class="form-select @if($errors->has("$selectName")) is-invalid @endif" name="{{$selectName}}" id="formSelect">
      @if(!$selected)<option disabled selected>-- {{$defaultSelected}} --</option>@endif
      @forelse ($options as $option)
        <option value="{{ $option->id }}" @if($selected == $option->id) selected @endif>{{ $option->name }}</option>
      @empty
        <option disabled>Список пуст</option>
      @endforelse
    </select>
    <label for="formSelect">Укажите {{$defaultSelected}}</label>
    @if($errors->has("$selectName"))
    <div class="invalid-feedback">
        {{$errors->first("$selectName")}}
    </div>
    @endif
</div>
