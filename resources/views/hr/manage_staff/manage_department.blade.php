<x-layout_hr>
    <div class="mt-10 mb-20 relative overflow-x-auto custom-scrollbar shadow-md sm:rounded-lg z-0">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
               <a href="{{ route('manage_staff') }}">

                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                       >
                        Staff Members
                    </button>
                </li>
            </a>


                <a href="{{ route('manage_department') }}">

                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="" data-tabs-target="#member_preview" type="button"
                            aria-controls="member_preview" aria-selected="false">
                            Manage Department
                        </button>
                    </li>
                </a>


                <a href="{{ route('add_department') }}">

                    <li class="me-2" role="presentation">
                        <button
                            class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                            id="" data-tabs-target="#member_preview" type="button"
                            aria-controls="member_preview" aria-selected="false">
                            Add Department
                        </button>
                    </li>
                </a>
                {{-- <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="add_member-tab" data-tabs-target="#add_member" type="button" role="tab"
                        aria-controls="add_member" aria-selected="false">
                        Add Member
                    </button>
                </li> --}}
                {{-- <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="department-tab" data-tabs-target="#department" type="button" role="tab"
                        aria-controls="department" aria-selected="false">
                        Add Department
                    </button>
                </li> --}}
            </ul>
        </div>

        <!-- staff members -->
        <div id="default-tab-content ">
            <div class=" rounded-lg bg-gray-50 dark:bg-gray-800" id="staff_member_preview" role="tabpanel"
                aria-labelledby="member_preview-tab">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg staff_member_table ">
                    <div
                        class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900 ml-5">
                        <label for="table-search" class="sr-only">Search</label>
                        <div class="relative mr-4">
                            <div
                                class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="text" id="table-search-users"
                                class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Find Staff Member" />
                        </div>
                    </div>
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">SN</th>

                                <th scope="col" class="px-6 py-3">Name</th>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Head of Department</th>
                                <th scope="col" class="px-6 py-3">Manage department</th>


                            </tr>
                        </thead>

                        <tbody id="tableRows">

                            @php
                                $sn = 1;
                            @endphp

                            @unless ($departments->isEmpty())
                                @foreach ($departments as $department)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">






                                        <td class="px-6 py-4">
                                            {{ $sn++ }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $department->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $department->description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($department->stuff_id)
                                            @php
                                                $hod = \App\Models\User::find($department->stuff_id); // Assuming Member is your model
                                            @endphp

                                            @if ($hod)
                                            {{ $hod->name }}
                                            @endif
                                        @else
                                        <code>
                                           <a href="{{ route('edit_department', ['id' => $department->id]) }}" class="color-blue">Assign HOD</a>
                                        </code>
                                        </td>
                                        @endif

                                        <td class="px-6 py-4">


                                                <form method="POST" action="{{ route('deleteDepartment' ,['id' => $department->id]) }}">
                                                    @method('delete')
                                                    @csrf
                                                    <input class="bg-red-500 py-1 px-2 rounded text-white text-sm" type="submit"  value="Delete">
                                                </form>
                                            </td>

                                                <td class="px-6 py-4">

                                                <a href="{{ route('edit_department',$department->id) }}"><span
                                                    class="bg-blue-500 py-1 px-2 rounded text-white text-sm">Edit</span>  </a>
                                        </td>




                                    </tr>
                                @endforeach
                            @else
                                <div>
                                    No Department available!
                                </div>
                    </div>
                @endunless



                </tbody>
                </table>
            </div>
            <div class="flex flex-col items-center">
                <!-- Help text -->
                {{-- <span class="text-sm text-gray-700 dark:text-gray-400">
                                    Showing
                                    <span class="font-semibold text-gray-900 dark:text-white current-page"></span>
                                    to
                                    <span class="font-semibold text-gray-900 dark:text-white per-page"></span>
                                    of
                                    <span class="font-semibold text-gray-900 dark:text-white total-members"></span>
                                    Entries
                                </span>
                                <div class="inline-flex mt-2 xs:mt-0">
                                    <!-- Buttons -->
                                    <button
                                        class="previous table_nav_btn flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        data-value="previous">
                                        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                        </svg>

                                        <span>Prev</span>
                                    </button>
                                    <button
                                        class="next table_nav_btn flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                                        data-value="next">
                                        <span>Next</span>
                                        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                        </svg>
                                    </button>
                                </div>
                            </div> --}}
            </div>
        </div>
        <!-- end of staff members -->
        <!-- department table-->
        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="member_preview" role="tabpanel"
            aria-labelledby="member_preview-tab">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div
                    class="flex items-center justify-between flex-column md:flex-row flex-wrap space-y-4 md:space-y-0 py-4 bg-white dark:bg-gray-900">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative mr-4">
                        <div
                            class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input type="text" id="table-search-users"
                            class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Find Department" />
                    </div>
                </div>
                <!-- table -->

                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Head of Department</th>
                        </tr>
                    </thead>
                    <tbody id="department_table"></tbody>
                </table>
            </div>
        </div>
        <!-- end of department table-->
        <!-- add department -->







        {{-- <div class="p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="department" role="tabpanel"
            aria-labelledby="department-tab">
            <p class="error text-red-600 py-3">Error Adding Department</p>
            <p class="success text-blue-500 py-3 mb-3">
                Department Added Successfully
            </p>
            <form id="add_department">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="department_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department
                            Name</label>
                        <input type="text" id="department_name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Department Name" />
                    </div>
                    <div>
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea id="description" name="description"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="A Brief sentence on what the department does..." rows="3"></textarea>
                    </div>
                    <div>
                        <label for="department_head"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Head Of
                            Department</label>
                        <input type="text" id="department_head" id="department_head"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Staff Number..." />
                    </div>
                    <div>
                        <button type="submit"
                            class="text-green-700 mt-6 hover:text-white w-full border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-900">
                            Create Department
                        </button>
                    </div>
                </div>
            </form>
        </div> --}}
        <!-- end of add department -->




        <!-- add member -->

        {{-- <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="add_member" role="tabpanel"
            aria-labelledby="add_member-tab">
            <form class="p-4" id="add_member_form">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="image"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Fullname" />
                    </div>
                    <div>
                        <label for="fullname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                            name</label>
                        <input type="text" name="name" id="fullname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Fullname" />
                    </div>
                    <div>
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" id="title" name="title"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Duty title" />
                    </div>
                    <div>
                        <label for="dob"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of
                            Birth</label>

                        <input type="date" id="dob" name="dob"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Date of birth" />
                    </div>
                    <div>
                        <label for="current_appointment"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                            Appointment</label>
                        <input type="text" id="current_appointment" name="current_appointment"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Curret appointment" />
                    </div>

                    <div>
                        <label for="appointment_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of
                            Appointment</label>
                        <input type="date" id="appointment_date" name="appointment_date"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Date of appointment" />
                    </div>
                    <div>
                        <label for="nin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIN</label>
                        <input type="text" id="nin" name="nin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="NIN" />
                    </div>
                    <div>
                        <label for="tin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN</label>
                        <input type="text" id="tin" name="tin"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="TIN" />
                    </div>
                    <div>
                        <label for="staff_number"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Staff
                            Number</label>
                        <input type="text" id="staff_number" name="staff_number"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Staff number" />
                    </div>
                    <div>
                        <label for="contact"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                        <input type="text" id="contact" name="phone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Phone number" />
                    </div>
                    <div>
                        <label for="Salary_scale"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary
                            Scale</label>
                        <input type="text" id="Salary_scale" name="Salary_scale"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Salary scale" />
                    </div>
                    <div>
                        <label for="Salary_amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary
                            Amount</label>
                        <input type="text" id="Salary_amount" name="Salary_amount"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Salary amount" />
                    </div>
                    <div>
                        <label for="allowances"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Allowances</label>
                        <input type="number" id="allowances" name="allowances"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Allowances" />
                    </div>
                    <div>
                        <label for="gross_pay"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gross
                            Pay</label>
                        <input type="text" id="gross_pay" name="gross_pay"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Gross pay" />
                    </div>
                    <div>
                        <label for="education"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Education</label>
                        <input type="text" id="education" name="education"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Education" />
                    </div>
                    <div>
                        <label for="net_pay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Net
                            Pay</label>
                        <input type="text" id="net_pay" name="net_pay"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Net Pay" />
                    </div>
                    <div>
                        <label for="duty"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duty</label>
                        <input type="text" id="duty" name="duty"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Duty" />
                    </div>

                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Eg example@gmail.com" />
                    </div>
                    <div class="mb-6">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="text" id="password" name="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            value="123456" />
                    </div>
                    <div class="mb-6">
                        <label for="department"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Department</label>
                        <select name="department_id" id="department_id"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></select>
                    </div>
                </div>

                <button type="submit" id="add_member_btn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Member
                </button>
            </form>

            <p class="addition-error text-red-600 py-3 pl-3">
                Error Adding Member
            </p>
            <p class="addition-success text-blue-500 py-3 mb-3 pl-3">
                Member Added Successfully
            </p>
        </div> --}}
        <!-- ens of add member -->
    </div>
    </div>
    </div>

</x-layout_hr>
