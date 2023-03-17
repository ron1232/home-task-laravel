<div class="relative z-10 edit-modal bg-red-500" aria-labelledby="modal-title" role="dialog" aria-modal="true"
    data-id="{{ $country->id }}">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0 relative">
            <div
                class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg inner-modal-form">
                <form action="{{ route('countries.update', $country->id) }}" method="POST" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $country->id }}">
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full ">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Edit
                                    Country
                                </h3>
                                <div class="flex flex-col gap-2 my-3">
                                    <span class="text-red-500 edit-name-error"></span>
                                    <x-label>Name</x-label>
                                    <input class="input" id="edit-name" type="text" name="name"
                                        value="{{ $country->name }}">
                                </div>
                                <div class="flex flex-col gap-2 my-3">
                                    <span class="text-red-500 edit-iso-error"></span>
                                    <x-label>ISO</x-label>
                                    <input class="input" id="edit-iso" type="text" name="iso"
                                        value="{{ $country->iso }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 flex justify-end sm:px-6">
                        <button type="submit" id="save-button" style=" height: 30px; line-height: 30px"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Save</button>
                    </div>
                </form>
                <div style="position: absolute; left:25px; bottom:10.5px">
                    <form action="{{ route('countries.destroy', $country->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button style=" height: 30px; line-height: 30px"
                            class="inline-flex justify-center rounded-md bg-red-600 px-3 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
