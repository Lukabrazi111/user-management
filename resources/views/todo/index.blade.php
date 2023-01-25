<x-layout>
    <x-navigation/>

    <div class="container mx-auto mt-20 w-1/2 flex items-center justify-center font-sans">
        <div class="bg-white rounded shadow p-6 m-4 w-full">
            <form action="#" method="post">
                @csrf
                <div class="mb-4">
                    <h1 class="text-grey-darkest">Todo List</h1>
                    <div class="flex mt-4">
                        <input class="shadow appearance-none border rounded w-full py-2 px-3 mr-4 text-grey-darker"
                               placeholder="Add Todo">
                        <button
                            class="p-2 border rounded text-teal border-teal hover:text-white hover:bg-sky-400 transition-colors">
                            Add
                        </button>
                    </div>
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
