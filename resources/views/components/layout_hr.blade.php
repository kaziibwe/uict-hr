<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HR Attendance</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <style>
        .icon-overlay {
            position: relative;
        }

        .icon {
            position: absolute;
            /* width: 20px;
            height: 20px; */
            opacity: 0.7;
            /* Adjust opacity for transparency */
            display: none;
            /* Hide icons by default */
            cursor: pointer;
        }

        .icon-overlay:hover .icon {
            display: block;
            /* Show icons on hover */
        }
    </style>
    <script>
        function toggleCollapse(id) {
            document.getElementById(id).classList.toggle("hidden");
        }

        function toggleDropdown() {
            document.getElementById("profileDropdown").classList.toggle("hidden");
        }
    </script>
    <style>
        /* Custom scrollbar styles */
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
            height: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #4a5568;
            /* Customize thumb color */
            border-radius: 50px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background-color: #e2e8f0;
            /* Customize track color */
        }

        table>tbody>tr>th {
            cursor: pointer;
        }
    </style>
</head>

<body class="bg-gray-100 flex h-screen">
    <!-- Side Panel -->
    <div class="w-64 bg-indigo-600 text-white flex flex-col">
        <div class="p-2 text-center text-2xl font-bold border-b border-indigo-500">
            <img src="https://workplan.uict.ac.ug/logo.jpg" />
        </div>
        <nav class="flex-1 p-4">
            <ul class="space-y-4">
                <li>
                    <a class="block py-2 px-3 rounded-md hover:bg-indigo-700" href="/">Dashboard</a>
                    <!-- <ul id="dashboardSubmenu" class="pl-6 hidden">
                        <li><a href="#" class="block py-2 px-3 rounded-md hover:bg-indigo-700">Workplan Overview</a>
                        </li>
                        <li><a href="#" class="block py-2 px-3 rounded-md hover:bg-indigo-700">Budget Overview</a></li>
                    </ul> -->
                </li>
                <li>
                    <a href="#" class="block py-2 px-3 rounded-md hover:bg-indigo-700"
                        onclick="toggleCollapse('workplanSubmenu')">Staff Attendance</a>
                    <ul id="workplanSubmenu" class="pl-6 hidden">
                        <li>
                            <a href="{{ route('todayAttendance') }}"
                                class="block py-2 px-3 rounded-md hover:bg-indigo-700">Attendance Today</a>
                        </li>
                        <li>
                            <a href="{{ route('attendance_history') }}"
                                class="block py-2 px-3 rounded-md hover:bg-indigo-700">Attendance History</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('manage_staff') }}" class="block py-2 px-3 rounded-md hover:bg-indigo-700">Staff
                        Management</a>
                </li>
            </ul>
        </nav>
        <div class="p-4 border-t border-indigo-500">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <input type="submit" value="logout"
                    class="block py-2 px-3 rounded-md hover:bg-indigo-700 text-center logout-button">
            </form>
        </div>
    </div>

    <!-- Main Dashboard Area -->
    <div class="flex-1 p-6 h-screen overflow-auto custom-scrollbar">
        <!-- Top Bar -->
        <div class="flex items-center justify-between p-4 mb-10 bg-white shadow-md">
            <div class="text-2xl font-bold">UICT Staff Attendance Monitoring <x-flush-message />
            </div>

            @auth('hr')

            <div class="relative ml-auto">
                <button onclick="toggleDropdown()" class="flex items-center focus:outline-none">
                    <img src="{{ auth('hr')->user()->image ? asset('storage/' . auth('hr')->user()->image) : asset('/avatar.png') }}" alt="User Profile"
                        class="w-10 h-10 rounded-full" />
                    <span class="ml-2 text-gray-700"> {{ auth('hr')->user()->name }} </span>
                </button>
                <div id="profileDropdown" class="hidden z-50 absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2">
                    <a href="{{ route('hrProfilePage') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Profile</a>
                    <a href="{{ route('allSettings') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100">Settings</a>

                    <form method="POST" action="{{ route('logout') }} "
                        >
                        @csrf

                        <input type="submit" value="logout"
                            class="block px-4 py-2 text-gray-800 hover:bg-gray-100 logout-button z-[100]">
                    </form>
                </div>
            </div>
            @endauth




        </div>


        {{ $slot }}

        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>



</body>

</html>
