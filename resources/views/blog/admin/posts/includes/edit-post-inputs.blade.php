

<div class="flex flex-col  m-5 w-2/4">

        {{-- Заголовок --}}
        <label for="title">Заголовок</label>
        <x-text-input name="title"
                      value="{{ old('title', $item->title) }}"
                      type="text"
                      minlength="3"
                      required
                      class="mb-4"/>
                     

   

                      



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
        <label for="content_raw">Описание</label> 
            <textarea 
                  class="h-96"
                  name="content_raw" >{{ old("content_raw", $item->content_raw) }}</textarea>
                        {{-- old = helper laravel --}}




        {{-- IS_PUBLISHED SENDS TRUE OR NOTHING --}}
        <div>
        <input
            name="is_published"
            type="checkbox"
            class="my-10"
            value="1"
            @if($item->is_published)
            checked
            @endif
            >
            <label for="is_published">Опубликовано</label>


            {{-- <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
              @method('DELETE')
              @csrf
              
              <td class="text-center ">
                  <button type="submit">Удалить</button>
              </td>
            </form> --}}
        </div>


        {{-- DESTROY POST BUTTON--}}
        

        {{-- CONTENT_RAW --}}
        {{-- <label for="content_raw">Описание RAW</label> 
            <textarea 
                  class="h-96"
                  name="content_raw" >{{ old("content_raw", $item->content_raw) }}</textarea> --}}
                        {{-- old = helper laravel --}}



                        
  </div>


   
