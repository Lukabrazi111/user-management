<div>
    @forelse($todos as $todo)
        <div class="flex mb-4 items-center">
            <p class="w-full text-grey-darkest {{ $todo->status === 'completed' ? 'line-through' : '' }}">{{ $todo->todo }}</p>
            <form action="{{ route('todo.update', $todo) }}" method="post">
                @csrf
                @method('PUT')

                <button
                    class="whitespace-nowrap flex justify-center items-center mx-2 border py-2 px-4 {{ $todo->status === 'incomplete' ? 'bg-green-200' : 'bg-red-200' }} transition-colors">
                    {{ $todo->status === 'incomplete' ? 'Complete' : 'Incomplete' }}
                </button>
            </form>

            <form action="{{ route('todo.destroy', $todo) }}" method="post">
                @csrf
                @method('DELETE')

                <button
                    class="whitespace-nowrap flex justify-center items-center mx-2 border py-2 px-4 hover:bg-red-400 transition-colors">
                    Remove
                </button>
            </form>

        </div>
    @empty
        <p>No todos.</p>
    @endforelse
</div>
