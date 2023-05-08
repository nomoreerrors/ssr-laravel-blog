<x-app-layout>
    @php /** @var \App\Models\BlogCategories $item */ @endphp
    @php /** @var \App\Models\BlogCategories $categoryList */ @endphp

    {{-- @php  $cuddy = ['lolwut', 'cameron', 'house', 'melrstroy'];
                unset($cuddy[1]) --}}
    
    @endphp
    {{ dd($cuddy) }}
                
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Profile') }}
                    </h2>
                </x-slot>


                {{-- Страница редактирования категорий --}}
                <div class=" flex gap-column gap-x-10 mt-10 border border-gray-200  rounded-lg h-3/5 " >
                        
                        <form method="POST"
                              action="{{ route('blog.admin.category.update', $item->id )}}"
                              class=" flex flex-col w-3/5 m-5">
                                    @method('PATCH')
                                    @csrf

                              @include('blog.admin.category.includes.edit-category-inputs')
                        </form>

                        
                               @include('blog.admin.category.includes.edit-category-info-col')

               
                    </div>

            </x-app-layout>

            