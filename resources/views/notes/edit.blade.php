<x-app-layout>
    <x-editorjs :edit="1" :data="$note->text"></x-editorjs>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                @if(!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created: </strong>{{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-8">
                        <strong>Updated: </strong>{{ $note->updated_at->diffForHumans() }}
                    </p>
                    <form class="ml-auto" action="{{ route("notes.destroy",$note) }}" method="POST">
                        @method("delete")
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to move to trash?')" class="btn btn-danger ml-4">Move to Trash</button>
                    </form>
                @endif
            </div>
            <form action="{{ route("notes.update",$note) }}" method="POST">

                <div class="my-6 mb-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                        @method("put")
                        @csrf
                        <x-text-input
                            field="title"
                            class="w-full mb-6"
                            autocomplete="off"
                            type="text"
                            name="title"
                            placeholder="Title"
                            :value="@old('title',$note->title)"></x-text-input>
                        <x-textarea
                            id="editortext"
                            field="text"
                            name="text"
                            class="w-full mt-6"
                            rows="10"
                            hidden=""
                            placeholder="Start typing here...."
                            :value="@old('text',$note->text)"></x-textarea>
                </div>
                <div id="editor" class="mt-2 mb-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">

                </div>
                <x-primary-button class="mt-6">Save Note</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
<?php
