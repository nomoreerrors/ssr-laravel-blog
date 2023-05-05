@props(['propsArray'])

@php ['item' => $item, 'categoryList' => $categoryList] = $propsArray @endphp

 
<div class="max-w-xl">
        <form method="POST" action="{{ route('blog.admin.category.update', $item->id )}}">
        @method('patch')
        @csrf
      
        <div class="max-w-xl">
        <x-text-input name="title"
                      value="{{ $item->title }}"
                      type="text"
                      minlength="3"
                      required/>
                      <label for="title">Заголовок</label>
        </div>
        {{-- Нужно создать колонку справа - edited_at_column --}}
        {{-- Нужно создать колонку справа - edited_at_column --}}
        {{-- Нужно создать колонку справа - edited_at_column --}}

        <div class="max-w-xl">
        <x-text-input name="slug"
                      value="{{ $item->slug }}"
                      type="text"
                      minlength="3"
                      required/>
                      <label for="slug">Идентификатор</label>
        </div>



        <div class="max-w-xl">
            <select  name="parent_id"
                      placeholder="Выберите категорию"
                      required>
                    @foreach($categoryList as $categoryOption)
                      <option value="{{ $categoryOption->id }}"
                        @if($categoryOption->id == $item->parent_id) selected @endif>
                        {{ $categoryOption->id }} .{{ $categoryOption->title }}
                      </option>
                    @endforeach
            </select>
            <label for="parent_id">Родитель</label>
        </div>


        <div class="max-w-xl">
            <textarea name="description"
                      rows="3"></textarea>
            <label for="description">Описание</label>


          </div>    


      </form>
    </div>
