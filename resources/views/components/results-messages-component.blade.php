{{-- all method gets text error messages --}}
@if($errors->any())
        @foreach($errors->all() as $errorMessage)
        <div  class=" bg-red-300 p-2">{{ $errorMessage }}</div>
        @endforeach
@endif
{{-- здесь мог бы быть цельный список ошибок --}}

@if(session('success'))
    <div class=" bg-green-300 p-2">{{ session()->get('success') }}</div>
@endif
