

<div class="flex flex-col  m-5 w-2/4">

        {{-- Заголовок --}}
        <label for="title">Заголовок</label>
        <x-text-input name="title"
                      value="{{ old('title', $item->title) }}"
                      type="text"
                      minlength="3"
                      required
                      class="mb-4"/>
                     

   


        {{-- Поле Идентификатор --}}
        {{-- <label for="slug">Идентификатор</label>
        <x-text-input name="slug"
                      value="{{ old('slug', $item->slug) }}"
                      type="text"
                      minlength="3"
                      class="mb-4"/> --}}
                      



        {{-- Колонка выбора родительской категории --}}
          <label for="category_id">Категория</label>
            <select  name="category_id"
                      placeholder="Выберите категорию"
                      required
                      class="mb-4">
                    @foreach($categoryList as $categoryOption)
                      <option value="{{ $categoryOption->id }}"
                        @if($categoryOption->id == $item->category_id) selected @endif>
                         {{ $categoryOption->id_title }}
                      </option>
                    @endforeach
            </select>
          
           
         



        {{-- Описание --}}
        <label for="content_html">Описание</label> 
            <textarea 
                  class="h-96"
                  name="content_html" >{{ old('content_html', $item->content_html) }}</textarea>
                        {{-- old = helper laravel --}}



                        
  </div>


   
