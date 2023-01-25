<x-layout>
    <x-navigation/>
    <div class="mt-20 w-full flex items-center justify-center bg-teal-lightest font-sans">
        <div class="bg-white rounded shadow p-6 m-4 w-1/2">
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

            <x-todos.todo-list/>
        </div>
    </div>
</x-layout>
