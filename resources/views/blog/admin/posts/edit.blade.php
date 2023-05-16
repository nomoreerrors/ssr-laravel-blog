

<x-app-layout>
     {{-- Страница редактирования постов --}}
                


                    {{-- header --}}
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

                    @if($item->exists)  
                        {{ __('Редактировать пост') }}
                    @else 
                        {{ __('Добавить категорию') }}
                    @endif

                    </h2>
                </x-slot>

                <x-results-messages-component />
                      
                        
                       {{-- update form --}}
                       @if($item->exists)
                       <form method="POST"
                                 action="{{ route('blog.admin.posts.update', $item->id )}}"
                                 class="flex justify-center mt-10 border border-gray-200 rounded-lg h-2/3 space-x-20" >
                           @method('PATCH')
   
                           
                       @else 
                       {{-- create form --}}
                       <form method="POST"
                                       action="{{ route('blog.admin.posts.store') }}"
                                       class="flex justify-center mt-10 border border-gray-200 rounded-lg h-2/3  space-x-20" >
                       @endif
                           @csrf


                     

                        
              

                        {{-- inputs and right info column --}}
                              @include('blog.admin.posts.includes.edit-post-inputs')
                              <x-edit-info-column-component :item='$item'/>
                              
                    </form>


            </x-app-layout>

            