<x-app-layout>
  
   {{-- Страница списка категорий блога--}}

<div >
    <div class="flex items-center text-2xl">

        <table class="mb-6 mx-auto flex-col justify-center w-screen">

        <thead class="bg-orange-300">
            <th class="pl-4 py-6">#</th>
            <th class="pl-4 py-6">Категория</th>
            <th class="pl-4 py-6">Родитель</th>
        </thead>
        <tbody>
            @foreach($paginator as $category)
                @php /** var \App\Models\BlogCategories $category */ @endphp
                
                    <tr >
                        <td class="p-6 bg-slate-300 ">{{ $category->id }}</td>
                        <td class="p-6">
                            <a href="{{ route('blog.admin.category.edit', $category->id)}}">{{ $category->title }}</a>
                        </td>
                        
                        <td class="p-6 bg-slate-300 ">
                            {{ $category->parentCategory->id .'.' }} {{ $category->parentCategory->title }} 

                            {{ $category->parentTitle .'.old method' }}
                            {{-- {{ $category->created_at .'.new method' }} --}}
                        </td>
                      
                    </tr>

            @endforeach
        </tbody>
        
    </table>

       

    </div>

    <div  class="flex justify-between mt-10 items-center mx-10">
    <a class="bg-purple-500 p-5 rounded-lg relative inline-block" href="{{ route('blog.admin.category.create') }}">Добавить</a>
    

          @if($paginator->total() > $paginator->count())
                <br>
                <div class="inline-block">

                    {{ $paginator->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>