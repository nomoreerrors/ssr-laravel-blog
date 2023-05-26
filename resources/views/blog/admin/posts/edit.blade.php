

<x-app-layout>
     {{-- Страница редактирования постов --}}
                


                    {{-- header --}}
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">

                    @if($item->exists)  
                        {{ __('Редактировать пост') }}
                    @else 
                        {{ __('Добавить пост') }}
                    @endif

                    </h2>
                </x-slot>

                <x-results-messages-component />
                      
                        
                {{-- update form --}}
                         {{-- $user->exists contains true if the model is the real model taken from the database.
                          For example, if you create $user = new User and set some properties to it,
                          $user->exists will contain false, as long as you don't do $user->save().
                           Once it's saved or obtained from database, $model->exists will be true. --}}
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

            