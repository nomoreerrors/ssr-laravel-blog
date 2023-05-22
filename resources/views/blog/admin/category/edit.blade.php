@php    /** @var \App\Models\BlogCategories $item */ 
        /** @var \App\Models\BlogCategories $categoryList */ 
        /** @var Illuminate\Support\ViewErrorBag $errors */
@endphp



<x-app-layout>
     {{-- Страница редактирования категорий --}}
                


                    {{-- header --}}
                        <x-slot name="header">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    @if($item->exists)  {{ __('Редактировать категорию') }}
                    @else {{ __('Добавить категорию') }}
                    @endif
                        </h2>
                        </x-slot>

                    <x-results-messages-component />
                      
                        
                    {{-- update form --}}
                    @if($item->exists)
                    <form method="POST"
                              action="{{ route('blog.admin.category.update', $item->id )}}"
                              class="flex justify-center mt-10 border border-gray-200 rounded-lg h-2/3 space-x-20" >
                        @method('PATCH')

                        
                    @else 
                    {{-- category creating form --}}
                    <form method="POST"
                                    action="{{ route('blog.admin.category.store') }}"
                                    class="flex justify-center mt-10 border border-gray-200 rounded-lg h-2/3  space-x-20" >

                    @endif
                        @csrf


                     

                     

                        {{-- inputs and right info column --}}
                              @include('blog.admin.category.includes.edit-category-inputs')
                             <x-edit-info-column-component :item='$item'/>
                              
                    </form>


            </x-app-layout>

            