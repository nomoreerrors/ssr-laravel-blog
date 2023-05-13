<x-app-layout>


    <div class="mt-10 text-2xl flex-col">
       







        <table class="mb-6  mx-auto flex-col justify-center w-screen">
            <thead >
                <tr>
                    <th class="pl-4">#</th>
                    <th class="pl-4">Автор</th>
                    <th class="pl-4">Категория</th>
                    <th class="pl-4">Заголовок</th>
                    <th class="pl-4">Дата публикации</th>
                </tr>
            </thead>


            <tbody>
            @foreach($paginator as $post)
                <tr @if(!$post->is_published) class="bg-purple-200" @endif >
                    <td class="p-6 bg-slate-300 ">{{ $post->id }}</td>
                    <td class="p-6">{{ $post->user_id }}</td>
                    <td class="p-6 bg-slate-300">{{ $post->category_id }}</td>
                    <td class="p-6">
                        <a href="{{ route('blog.admin.posts.edit', $post->id) }}">{{ $post->title }}</a>
                    </td>
                    <td class="p-6 bg-slate-300">{{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.M H:i') : '' }}</td>
                </tr>
            @endforeach

        </tbody>
        </table>

        <div class="flex justify-between mt-10 items-center mx-10">
            <nav class="inline-block">
                <a class="p-4 bg-pink-300 rounded" href="{{ route('blog.admin.posts.create') }}">Опубликовать</a>
            </nav>


            <div class="inline-block">
                @if($paginator->total() > $paginator->count())
                    {{ $paginator->links() }} 
                @endif
            </div>
        </div>
    </div>




 
</x-app-layout>