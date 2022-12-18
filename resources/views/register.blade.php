<x-layout>
    <section class="h-screen">
        <div class="px-6 h-full text-gray-800">
            <div
                class="flex xl:justify-center lg:justify-between justify-center items-center flex-wrap h-full g-6"
            >
                <div class="xl:ml-20 xl:w-5/12 lg:w-5/12 md:w-8/12 mb-12 md:mb-0">
                    <form action="{{ route('register.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="flex flex-row items-center justify-center lg:justify-start">
                            <p class="text-lg mb-2 mr-4">Create Password</p>
                        </div>

                        <!-- Password input -->
                        <div class="mb-6">
                            <input
                                type="password"
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="password"
                                name="password"
                                placeholder="Password"
                            />
                            @error('password')
                            <span class="text-red-400 underline">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Confirmation input -->
                        <div class="mb-6">
                            <input
                                type="password"
                                class="form-control block w-full px-4 py-2 text-xl font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                id="password_confirmation"
                                name="password_confirmation"
                                placeholder="Password Confirmation"
                            />
                            @error('password_confirmation')
                            <span class="text-red-400 underline">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="text-center lg:text-left">
                            <button
                                type="submit"
                                class="inline-block px-7 py-3 bg-blue-600 text-white font-medium text-sm leading-snug uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                            >
                                Register
                            </button>
                            <p class="text-sm font-semibold mt-2 pt-1 mb-0">
                                Already have an account?
                                <a
                                    href="{{ route('login.create') }}"
                                    class="text-red-600 hover:text-red-700 focus:text-red-700 transition duration-200 ease-in-out"
                                >Login</a
                                >
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layout>
