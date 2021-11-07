<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('tasks.create') }}">Create new task</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 bg-white border-b border-gray-200">


                    @foreach($tasks as $task)
                        @if($task->recycled == 'no')
                        <div id="table">
                            <div class="tr">
                                <div class="td" style="border: 0;height:20px;width:120px">
                                    <form method="post" action="/tasks/{{ $task->id }}/completed">
                                        @method('PATCH')
                                        @csrf
                                            @if($task->completed_at == null)
                                            <input type="checkbox" onChange="this.form.submit()">
                                            @else
                                            <input type="checkbox" onChange="this.form.submit()" checked>
                                            @endif
                                    </form>
                                </div>
                                <div class="td" style="border:0;height:20px;width:300px">
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <x-dropdown align="middle" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-lg font-medium text-black hover:text-black hover:border-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                                    <div>
                                                        @if($task->completed_at == null)
                                                            <p>{{ $task->title }}</p>
                                                        @else
                                                            <strike><p>{{ $task->title }}</p></strike>
                                                        @endif
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <p>{{ $task->content }}</p>
                                            </x-slot>
                                        </x-dropdown>
                                        <div class="td"  style="background:#6dab32;height:30px;width:50px;text-align: center">
                                            <a href="{{ route('tasks.edit', $task) }}">EDIT</a>
                                        </div>
                                        <div style="vertical-align: middle">
                                            <form method="post" action="{{ route('tasks.changeRecycle', $task) }}">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit"><img src="https://image.pngaaa.com/415/982415-middle.png" width="30" height="30" alt="Bin"></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
