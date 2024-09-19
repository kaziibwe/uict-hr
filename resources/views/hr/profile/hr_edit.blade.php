<x-layout_hr>
    <style>
        :root {
            --main-color: #4a76a8;
        }

        .bg-main-color {
            background-color: var(--main-color);
        }

        .text-main-color {
            color: var(--main-color);
        }

        .border-main-color {
            border-color: var(--main-color);
        }
    </style>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>



    <div class="bg-gray-100">
        <div class="w-full text-white bg-main-color">
            <div x-data="{ open: false }"
                class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
                <div class="p-4 flex flex-row items-center justify-between">
                    <a href="#"
                        class="text-lg font-semibold tracking-widest uppercase rounded-lg focus:outline-none focus:shadow-outline">
                        profile</a>
                    <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
                        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                            <path x-show="!open" fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                            <path x-show="open" fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <nav :class="{ 'flex': open, 'hidden': !open }"
                    class="flex-col flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
                    <div @click.away="open = false" class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex flex-row items-center space-x-2 w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent hover:bg-blue-800 md:w-auto md:inline md:mt-0 md:ml-4 hover:bg-gray-200 focus:bg-blue-800 focus:outline-none focus:shadow-outline">
                            <span>Jane Doe</span>
                            <img class="inline h-6 rounded-full"
                                src="https://avatars2.githubusercontent.com/u/24622175?s=60&amp;v=4">
                            <svg fill="currentColor" viewBox="0 0 20 20"
                                :class="{ 'rotate-180': open, 'rotate-0': !open }"
                                class="inline w-4 h-4 transition-transform duration-200 transform">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
                            {{-- <div class="py-2 bg-white text-blue-800 text-sm rounded-sm border border-main-color shadow-sm"> --}}
                            {{-- <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="#">Settings</a>
                                <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="#">Help</a>
                                <div class="border-b"></div>
                                <a class="block px-4 py-2 mt-2 text-sm bg-white md:mt-0 focus:text-gray-900 hover:bg-indigo-100 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                                    href="#">Logout</a> --}}
                            {{-- </div> --}}
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!-- End of Navbar -->

        <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="add_member" role="tabpanel"
        aria-labelledby="add_member-tab">
        <form class="p-4" id="add_member_form" action="{{ route('updateHr', $hr->id) }}"
            enctype="multipart/form-data" method="POST">
            @method('PUT')


            @csrf
            <img src="{{ $hr->image ? asset('storage/' . $hr->image) : asset('/avatar.png') }}"
                alt="">

            <div class="grid gap-6 mb-6 md:grid-cols-2">

                <div>
                    <label for="image"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                    <input type="file" name="image" value="{{ $hr->image }}" accept="image/*"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Fullname" />
                    @error('image')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="fullname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                        name</label>
                    <input type="text" name="name" value="{{ $hr->name }}" id="fullname"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Fullname" />
                    @error('name')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="title"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                    <input type="text" id="title" name="title" value="{{ $hr->title }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Duty title" />
                    @error('title')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                        Of
                        Birth</label>

                    <input type="date" id="dob" name="dob" value="{{ $hr->dob }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Date of birth" />
                    @error('dob')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>



                <div>
                    <label for="nin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIN</label>
                    <input type="text" id="nin" name="nin" value="{{ $hr->nin }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="NIN" />
                    @error('nin')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="tin"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN</label>
                    <input type="text" id="tin" name="tin" value="{{ $hr->tin }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="TIN" />
                    @error('tin')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="staff_number"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff
                        Number</label>
                    <input type="text" id="staff_number" name="staff_number"
                        value="{{ $hr->staff_number }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Staff number" />
                    @error('staff_number')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>
                <div>
                    <label for="contact"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                    <input type="text" id="contact" name="phone" value="{{ $hr->phone }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Phone number" />
                    @error('phone')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>







                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ $hr->email }}"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Eg example@gmail.com" />
                    @error('email')
                        <code class="text-red-800">{{ $message }}</code>
                    @enderror
                </div>


            </div>

            <button type="submit" id="add_member_btn"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Edit Hr
            </button>
        </form>


    </div>

    </div>
</x-layout_hr>
