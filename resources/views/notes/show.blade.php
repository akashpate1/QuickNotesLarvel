<x-app-layout>
    <x-editorjs :edit="1" :readonly="1" :data="$note->text"></x-editorjs>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ !$note->trashed()  ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-alert-success>
                {{ session('success') }}
            </x-alert-success>

            <div class="flex">
                @if(!$note->trashed())
                    <p class="opacity-70">
                        <strong>Created: </strong>{{ $note->created_at->diffForHumans() }}
                    </p>
                    <p class="opacity-70 ml-8">
                        <strong>Updated: </strong>{{ $note->updated_at->diffForHumans() }}
                    </p>
                    <a href="{{ route("notes.edit",$note) }}" class="btn-link ml-auto">Edit Note</a>
                    <form action="{{ route("notes.destroy",$note) }}" method="POST">
                        @method("delete")
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to move to trash?')" class="btn btn-danger ml-4">Move to Trash</button>
                    </form>
                @else
                    <p class="opacity-70 ml-8">
                        <strong>Deleted: </strong>{{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form class="ml-auto" action="{{ route("trash.notes.update",$note) }}" method="POST">
                        @method("put")
                        @csrf
                        <button type="submit"  class="btn-link ">Restore Note</button>
                    </form>
                    <form action="{{ route("trash.notes.destroy",$note) }}" method="POST">
                        @method("delete")
                        @csrf
                        <button type="submit" onclick="return confirm('Are you sure you want to delete forever? This cannot be undone')" class="btn btn-danger ml-4">Delete Forever</button>
                    </form>
                @endif
            </div>
                <div class="my-6 mb-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <h2 class="font-bold text-3xl text-gray-600">
                        {{ $note->title }}
                    </h2>

                </div>
                <div id="editor" class="my-6 mb-4 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                </div>
        </div>
    </div>
</x-app-layout>
