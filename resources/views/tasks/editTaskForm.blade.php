<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editing task: {{ $task->title }}<br>
            <a href="{{ route('tasks.index') }}">Cancel</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                        <ul>
                            <li>
                                <form method="post" action="{{ route('tasks.update', $task)  }}">
                                    @csrf
                                    @method('PUT')
                                    <p><label for="name">New title:</label></p>
                                    <input id="name" type="text" name="title">

                                    <p><label for="content">New description:</label></p>
                                    <textarea id="content" name="content" rows="5" cols="40"></textarea>

                                    <p><button type="submit">Submit</button></p>
                                </form>
                            </li>
                        </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
