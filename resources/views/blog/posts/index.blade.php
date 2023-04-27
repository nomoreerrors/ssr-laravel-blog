<table>
    @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->excerpt }}</td>
        </tr>
    @endforeach
</table>