<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm dashboard-title">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
    <div class="pb-12 overflow-hidden max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white flex shadow-sm countries-wrapper">
            <form action="{{ route('countries.store') }}" class="w-2/5" method="POST">
                @csrf
                @method('POST')

                <div class="flex flex-col m-6 border border-gray-300 rounded-sm">
                    <x-box>
                        Add New Country
                    </x-box>
                    <div class="flex flex-col gap-6 p-4 border-y border-gray-300">
                        <div class="flex flex-col gap-2">
                            @error('name')
                                <span class="text-red-500 text-xs">*{{ $message }}</span>
                            @enderror
                            <x-label>Name</x-label>
                            <input class="input" type="text" name="name" value="{{ old('name') }}">
                        </div>
                        <div class="flex flex-col gap-2">
                            @error('iso')
                                <span class="text-red-500 text-xs">*{{ $message }}</span>
                            @enderror
                            <x-label>ISO</x-label>
                            <input class="input" type="text" name="iso" value="{{ old('iso') }}">
                        </div>
                    </div>
                    <x-box>
                        <x-button class="float-right">Save</x-button>
                    </x-box>
                </div>
            </form>
            <div class="w-3/5">
                <div class="flex flex-col m-6 border border-gray-300 rounded-sm">
                    <x-box class="border-b  border-gray-300">
                        List of countries
                    </x-box>
                    <div class="border-b border-gray-200 pt-5 mx-4"></div>
                    <div class="table">
                        <table class="text-sm w-full">
                            <colgroup>
                                <col style="width: 25%;">
                                <col style="width: 30%;">
                                <col style="width: 20%;">
                                <col style="width: 25%;">
                            </colgroup>
                            <thead>
                                <tr class="border-b-2 border-gray-200 h-10 font-bold mx-4">
                                    <td>#</td>
                                    <td>Name</td>
                                    <td>ISO</td>
                                    <td>Edit</td>
                                </tr>
                            </thead>
                            <tbody class="h-5">
                                @foreach ($countries as $country)
                                    <tr class="table-row">
                                        <td class="font-bold">{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td class="iso">{{ $country->iso }}</td>
                                        <td>
                                            <button class="edit-button open_modal" type="button"
                                                data-id="{{ $country->id }}" data-name="{{ $country->name }}"
                                                data-iso="{{ $country->iso }}">Edit</button>
                                        </td>
                                    </tr>
                                    <x-edit-modal :country="$country"></x-edit-modal>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
