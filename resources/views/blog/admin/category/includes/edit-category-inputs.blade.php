

        {{-- Заголовок --}}
        <label for="title">Заголовок</label>
        <x-text-input name="title"
                      value="{{ $item->title }}"
                      type="text"
                      minlength="3"
                      required
                      class="mb-4"/>
                     

   


        {{-- Поле Идентификатор --}}
        <label for="slug">Идентификатор</label>
        <x-text-input name="slug"
                      value="{{ $item->slug }}"
                      type="text"
                      minlength="3"
                      required
                      class="mb-4"/>
                      





        {{-- Колонка выбора родительской категории --}}
          <label for="parent_id">Родитель</label>
            <select  name="parent_id"
                      placeholder="Выберите категорию"
                      require
                      class="mb-4">
                    @foreach($categoryList as $categoryOption)
                      <option value="{{ $categoryOption->id }}"
                        @if($categoryOption->id == $item->parent_id) selected @endif>
                        {{ $categoryOption->id }} .{{ $categoryOption->title }}
                      </option>
                    @endforeach
            </select>
           




        {{-- Описание --}}
        <label for="description">Описание</label>
            <textarea name="description"rows="3">{{ $item->description }}</textarea>
            




   