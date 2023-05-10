@php    /** @var \App\Models\BlogCategories $item */ 
        /** @var \App\Models\BlogCategories $categoryList */ 
        /** @var Illuminate\Support\ViewErrorBag $errors */
@endphp



<x-app-layout>
     {{-- Страница редактирования категорий --}}
                


                    {{-- header --}}
                        <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                            {{ __('Редактировать категорию') }}
                        </h2>
                        </x-slot>
               
                    {{-- update form --}}
                    @if($item->exists)
                    <form method="POST"
                              action="{{ route('blog.admin.category.update', $item->id )}}"
                              class=" flex gap-column gap-x-10 mt-10 border border-gray-200  rounded-lg h-1500 " >
                        @method('PATCH')

                        
                    @else 
                    {{-- create form --}}
                    <form method="POST"
                                    action="{{ route('blog.admin.category.store') }}"
                                    class=" flex gap-column gap-x-10 mt-10 border border-gray-200  rounded-lg h-1500 " >
                    @endif
                        @csrf




                        {{-- display errors --}}
                        @if($errors->any())
                            <div class=" bg-red-300 p-2"> {{ $errors->first() }} </div>
                        @endif

                        @if(session('success'))
                            <div class=" bg-green-300 p-2">{{ session()->get('success') }}</div>
                        @endif
              

                        {{-- inputs and right info column --}}
                              @include('blog.admin.category.includes.edit-category-inputs')
                              @include('blog.admin.category.includes.edit-category-info-col')
                              
                    </form>


            </x-app-layout>

            