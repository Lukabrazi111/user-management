<x-layout>
    <x-navigation/>

    <div class="container mx-auto mt-20 w-1/2 flex flex-col items-center justify-center font-sans">
        @if(session()->has('success'))
            <div
                class="bg-gray-200 py-1 px-4 rounded font-bold text-green-600 underline text-2xl">{{ session()->get('success') }}</div>
        @endif
        <div class="bg-white rounded shadow p-6 m-4 w-full">
            <form action="{{ route('todo.store') }}" method="post">
                @csrf
                <div class="mb-4">
                    <h1 class="text-grey-darkest">Todo List</h1>
                    <div class="flex mt-4">
                        <input
                            name="todo"
                            class="{{ $errors->has('todo') ? 'border border-red-400' : '' }} shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                            placeholder="Add Todo">
                        <button
                            class="p-2 border rounded text-teal border-teal hover:text-white hover:bg-sky-400 transition-colors">
                            Add
                        </button>
                    </div>
                    @error('todo')
                    <p class="mt-2 text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </form>

            <div>
                <x-todos.todo-list :todos="$todos"/>
            </div>

            {{-- Pagination --}}
            <div class="flex items-center justify-center mt-6">
                {{ $todos->links() }}
            </div>
        </div>
    </div>
</x-layout>
