<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2>Your current Tasks:</h2>
                    @foreach($tasks as $task)
                        <ul>
                            <li>
                                <form method="post" action="/tasks/{{ $task->id }}/completed">
                                    @method('PATCH')
                                    @csrf
                                    <button type="submit">Press meee</button>
                                </form>
                                    <h2>{{ $task->title }}</h2>
                                    <p>{{ $task->content }}</p>
                                <a href="{{ route('tasks.edit', $task) }}">EDIT</a>
                                <form method="post" action="{{ route('tasks.destroy', $task) }}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">DELETE</button>
                                </form>
                            </li>
                        </ul>
                    @endforeach
                </div>
                <a href="{{ route('tasks.create') }}">Create Task</a>
            </div>
        </div>
    </div>

</x-app-layout>
