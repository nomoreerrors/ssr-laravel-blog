


<div class="flex flex-col flex-1 border border-gray-300 rounded-xs p-4" >


           <div class="flex-1  bg-green-200 flex justify-center items-center">
                <x-primary-button >
                    Click here
                </x-primary-button>
           </div>



@if($item->exists())

           <div class="flex-1 bg-blue-400 flex justify-center items-center  " >
               ID: {{ $item->id }}
           </div>


           <div class="h-2/5 bg-green-600 flex flex-col items-center justify-center">

                    <label for="created_at">Создано</label>
                            <input class=" rounded-md" name="created_at" 
                                    value="{{ $item->created_at }}" type="text" disabled>


                    <label for="updated_at">Обновлено</label>
                            <input class=" rounded-md" name="updated_at" 
                                    value="{{ $item->updated_at }}"  type="text" disabled>


                    <label for="deleted_at">Удалено</label>
                            <input class=" rounded-md" name="deleted_at" 
                                    value="{{ $item->deleted_at }}"   type="text" disabled>

            </div>

</div>


@endif