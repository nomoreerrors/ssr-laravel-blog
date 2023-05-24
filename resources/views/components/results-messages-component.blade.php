{{-- 'all' method gets text error messages --}}


@if($errors->any())
        @foreach($errors->all() as $errorMessage)
        <div  class=" bg-red-300 p-2">{{ $errorMessage }}</div>
        @endforeach
@endif



@if(session('success'))

        <div class=" bg-green-300 p-2 inline-block absolute">
                {{ session()->get('success') }}
                @if(session('trashedId')) 
                    <form   class="inline-block pl-5"
                            method="POST" 
                            action="{{ route('blog.admin.posts.restore', session('trashedId')) }}">
                            @method('PATCH')
                            @csrf
                            <button type="submit">Отменить</button>
                    </form>
                @endif
        </div> 
    
@endif
