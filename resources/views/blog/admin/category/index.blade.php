<x-app-layout>
  
    <style>
        .wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;

        }
        .add-btn {
            background-color: #04a8d1;
            border-radius: 5px;
            padding: 5px;
        }
        .page-table {
            width: 600px;
        }
        td {
            text-align: center;
        }
    </style>


<div class='wrapper'>
    <div>
    <nav>
        <a class="add-btn" href="{{ route('blog.admin.category.create') }}">Добавить</a>
    </nav>
    <table class="page-table">

        <thead>
            <th>#</th>
            <th>Категория</th>
            <th>Родитель</th>
        </thead>
        <tbody>
            @foreach($blogCategories as $category)
                @php /** var \App\Models\BlogCategories $category */ @endphp
                
                    <tr>
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
    </div>
    @if($blogCategories->total() > $blogCategories->count())
        <br>
        <div style="display:flex; justify-content:space-around">
            {{ $blogCategories->links() }}
        </div>
    @endif
</div>

</x-app-layout>