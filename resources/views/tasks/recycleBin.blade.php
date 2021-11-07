<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{ route('tasks.create') }}">Back</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-20 bg-white border-b border-gray-200">


                    @foreach($tasks as $task)
                        @if($task->recycled == 'yes')
                        <div id="table">
                            <div class="tr">
                                <div class="td" style="border:0;height:20px;width:300px">
                                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                                        <x-dropdown align="middle" width="48">
                                            <x-slot name="trigger">
                                                <button class="flex items-center text-lg font-medium text-black hover:text-black hover:border-gray-300 focus:outline-none focus:text-gray-700 transition duration-150 ease-in-out">
                                                    <div>
                                                        <p>{{ $task->title }}</p>
                                                    </div>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <p>{{ $task->content }}</p>
                                            </x-slot>
                                        </x-dropdown>
                                        <div class="td"  style="background:#6dab32;height:30px;width:90px;text-align: center">
                                            <form method="post" action="{{ route('tasks.changeRecycle', $task) }}">
                                                @method('PATCH')
                                                @csrf
                                                <button type="submit">Take Out</button>
                                            </form>
                                        </div>
                                        <div class="td" style="background:#d94242;height:30px;width:70px;text-align: center">
                                            <form method="post" action="{{ route('tasks.destroy', $task) }}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" onclick="confirm('Are you sure you want to delete? You will lose this data.')">DELETE</button>
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
