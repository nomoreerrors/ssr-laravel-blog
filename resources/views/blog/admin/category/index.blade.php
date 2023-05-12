<x-app-layout>
  
   {{-- Страница списка категорий блога--}}

<div class='p-10'>
    <div class="flex items-center text-2xl">

    <table class="border-separate my-table-spacing text-center">

        <thead>
            <th>#</th>
            <th>Категория</th>
            <th>Родитель</th>
        </thead>
        <tbody>
            @foreach($paginator as $category)
                @php /** var \App\Models\BlogCategories $category */ @endphp
                
                    <tr >
                        <td>{{ $category->id }}</td>
                        <td>
                            <a href="{{ route('blog.admin.category.edit', $category->id)}}">{{ $category->title }}</a>
                        </td>
                        
                        <td
                            @if(in_array($category->parent_id, [0, 1])) style="color: red" @endif>
                                {{ $category->parent_id }}
                        </td>
                    </tr>

            @endforeach
        </tbody>
        
    </table>

        <a class="bg-purple-500 p-5 rounded-lg relative " href="{{ route('blog.admin.category.create') }}">Добавить</a>

    </div>
    

            {{-- Если в базе категорий станет меньше, чем мы установили в пагинации, то ссылки на страницы исчезнут --}}
            {{-- @if($blogCategories->total() > $blogCategories->count())
                <br>
                <div >

                    {{ $blogCategories->links() }}
                </div>
            @endif --}}
        </div>

</x-app-layout>