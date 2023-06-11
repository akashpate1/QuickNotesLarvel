<x-app-layout>
    <x-editorjs></x-editorjs>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route("notes.store") }}" method="POST">

                <div class="my-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                        @csrf
                        <x-text-input
                            field="title"
                            class="w-full mb-6"
                            autocomplete="off"
                            type="text"
                            name="title"
                            placeholder="Title"
                            :value="@old('title')"></x-text-input>
                        <x-textarea
                            id="editortext"
                            field="text"
                            name="text"
                            class="w-full"
                            rows="10"
                            hidden=""
                            placeholder="Start typing here...."
                            :value="@old('text')"></x-textarea>
                </div>
                <div id="editor" class="mt-2 mb-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                </div>
                    <x-primary-button class="mt-6">Save Note</x-primary-button>

            </form>
        </div>
    </div>
</x-app-layout>
