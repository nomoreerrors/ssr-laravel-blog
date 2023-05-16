
@if($errors->any())
    <div class=" bg-red-300 p-2"> {{ $errors->first() }} </div>
@endif
{{-- здесь мог бы быть цельный список ошибок --}}

@if(session('success'))
    <div class=" bg-green-300 p-2">{{ session()->get('success') }}</div>
@endif
