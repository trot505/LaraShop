<div class="form-floating">
    <select class="form-select" name="category_id" id="categorySelect" aria-label="Категория">
      <option disabled selected>-- Категории --</option>
      @forelse ($categories as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @empty
        <option disabled>Список категорий пуст</option>
      @endforelse
    </select>
    <label for="categorySelect">Выберите категорию</label>
</div>
