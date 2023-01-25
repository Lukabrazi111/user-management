<form action="#" method="post">
    @csrf

    <div>
        @forelse($todos as $todo)
            <div class="flex mb-4 items-center">
                <p class="w-full text-grey-darkest">{{ $todo->todo }}</p>
                <button
                    class="whitespace-nowrap flex justify-center items-center mx-2 border py-2 px-4 hover:bg-green-400 transition-colors">
                    Done
                </button>
                <button
                    class="whitespace-nowrap flex justify-center items-center mx-2 border py-2 px-4 hover:bg-red-400 transition-colors">
                    Remove
                </button>
            </div>
        @empty
            <p>No todos.</p>
        @endforelse
    </div>
</form>

