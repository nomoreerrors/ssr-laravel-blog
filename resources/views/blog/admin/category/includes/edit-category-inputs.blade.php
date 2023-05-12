
<div class="flex flex-col w-3/5 m-5">

        {{-- Заголовок --}}
        <label for="title">Заголовок</label>
        <x-text-input name="title"
                      value="{{ old('title', $item->title) }}"
                      type="text"
                      minlength="3"
                      required
                      class="mb-4"/>
                     

   


        {{-- Поле Идентификатор --}}
        <label for="slug">Идентификатор</label>
        <x-text-input name="slug"
                      value="{{ old('slug', $item->slug) }}"
                      type="text"
                      minlength="3"
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
                         {{ $categoryOption->id_title }}
                      </option>
                    @endforeach
            </select>
          
           
         



        {{-- Описание --}}
        <label for="description">Описание</label> 
            <textarea name="description"rows="3">{{ old('description', $item->description) }}</textarea>
                        {{-- old = helper laravel --}}



                        
  </div>


   
