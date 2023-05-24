<x-app-layout>

   

    <div class="text-xl flex-col">
        
        <x-results-messages-component />

            {{-- THEAD --}}
        <table class="mb-6  flex-col justify-center mx-auto max-w-[1920px]">
            <thead class="bg-orange-300">
                <tr>
                    <th class="pl-4 py-6 ">#</th>
                    <th class="pl-4 py-6">Автор</th>
                    <th class="pl-4 py-6">Категория</th>
                    <th class="pl-4 py-6">Заголовок</th>
                    <th class="pl-4 py-6">Дата публикации</th>
                    <th class="pl-4 py-6 ">Delete</th>
                </tr>
            </thead>




            {{-- TBODY --}}

            <tbody>
            @foreach($paginator as $post)
                <tr @if(!$post->is_published) class="bg-purple-200 " @endif >
                    <td class="p-6 pl-10 bg-slate-300 ">{{ $post->id }}</td>
                    <td class="p-6">{{ $post->author }}</td>
                    <td class="p-6 bg-slate-300">{{ $post->category_name }}</td>
                   

                    {{--REDIRECT TO UPDATE PAGE--}}
                    <td class="p-6">
                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                    </td>



                    {{-- UPDATED AT --}}
                    <td class="p-6 bg-slate-300">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                   



                    {{-- DESTROY POST BUTTON--}}
                    <form method="POST" action="{{ route('blog.admin.posts.destroy', $post->id) }}">
                            @method('DELETE')
                            @csrf
                            
                            <td class="text-center bg-pink-400 px-10">
                                <button type="submit">X</button>
                            </td>
                    </form>
                </tr>
            @endforeach

        </tbody>
        </table>



            {{-- CREATE A NEW POST --}}
        <div class="flex justify-between mt-10 items-center mx-10">
            <nav class="inline-block">
                <a class="p-4 bg-pink-300 rounded" href="{{ route('blog.admin.posts.create') }}">Добавить</a>
            </nav>




            {{-- PAGINATION --}}
            <div class="inline-block">
                @if($paginator->total() > $paginator->count())
                    {{ $paginator->links() }} 
                @endif
            </div>
        </div>
    </div>


 
</x-app-layout>