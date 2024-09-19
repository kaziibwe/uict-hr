<x-layout_hr>
    <div class="mt-10 mb-20 relative overflow-x-auto custom-scrollbar shadow-md sm:rounded-lg z-0">
        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-tab"
                data-tabs-toggle="#default-tab-content" role="tablist">
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="staff_member_preview-tab" data-tabs-target="#staff_member_preview" type="button"
                        role="tab" aria-controls="staff_member_preview" aria-selected="false">
                        Staff Members
                    </button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="member_preview-tab" data-tabs-target="#member_preview" type="button" role="tab"
                        aria-controls="member_preview" aria-selected="false">
                        Departments
                    </button>
                </li>

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





        <!-- add member -->

       <div class="rounded-lg bg-gray-50 dark:bg-gray-800" id="add_member" role="tabpanel"
            aria-labelledby="add_member-tab">
            <form class="p-4" id="add_member_form" action="{{ route('registerUser') }}" method="post" enctype="multipart/form-data" >
                @csrf
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <label for="image"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                        <input type="file" name="image" value="{{ old('image') }}" accept="image/*"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Fullname" />
                            @error('image')
                            <code class="text-red-800">{{ $message }}</code>
                        @enderror
                    </div>
                    <div>
                        <label for="fullname"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Full
                            name</label>
                        <input type="text" name="name"  value="{{ old('name') }}" id="fullname"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Fullname" />
                            @error('name')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="title"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" id="title" name="title"  value="{{ old('title') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Duty title" />
                            @error('title')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="dob"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of
                            Birth</label>

                        <input type="date" id="dob" name="dob"  value="{{ old('dob') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Date of birth" />
                            @error('dob')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="current_appointment"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current
                            Appointment</label>
                        <input type="text" id="current_appointment" name="current_appointment" value="{{ old('current_appointment') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Curret appointment" />
                            @error('current_appointment')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>

                    <div>
                        <label for="appointment_date"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of
                            Appointment</label>
                        <input type="date" id="date_appointed" name="date_appointed"
                         value="{{ old('date_appointed') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Date of appointment" />
                            @error('date_appointed')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="nin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIN</label>
                        <input type="text" id="nin" name="nin" value="{{ old('nin') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="NIN" />
                            @error('nin')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="tin"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">TIN</label>
                        <input type="text" id="tin" name="tin" value="{{ old('tin') }}"
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
                        <input type="text" id="staff_number" name="staff_number"              value="{{ old('staff_number') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Staff number" />
                            @error('staff_number')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="contact"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Contact</label>
                        <input type="text" id="contact" name="phone"  value="{{ old('phone') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Phone number" />
                            @error('phone')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="salary_scale"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary
                            Scale</label>
                        <input type="text" id="salary_scale" name="salary_scale" value="{{ old('salary_scale') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Salary scale" />
                            @error('salary_scale')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="salary_amount"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Salary
                            Amount</label>
                        <input type="text" id="salary_amount" name="salary_amount"   value="{{ old('salary_amount') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Salary amount" />

                            @error('salary_amount')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="allowances"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Allowances</label>
                        <input type="number" id="allowances" name="allowances"  value="{{ old('allowances') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Allowances" />

                            @error('allowances')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror

                    </div>
                    <div>
                        <label for="gross_pay"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gross
                            Pay</label>
                        <input type="text" id="gross_pay" name="gross_pay"   value="{{ old('gross_pay') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Gross pay" />
                            @error('gross_pay')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="education"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Education</label>
                        <input type="text" id="education" name="education" value="{{ old('education') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Education" />
                            @error('education')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="netpay" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Net
                            Pay</label>
                        <input type="text" id="netpay" name="netpay"  value="{{ old('netpay') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Net Pay" />
                            @error('netpay')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
                    </div>
                    <div>
                        <label for="duty"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duty</label>
                        <input type="text" id="duty" name="duty" value="{{ old('duty') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Duty" />
                            @error('duty')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror

                    </div>

                    <div>
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"  value="{{ old('email') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Eg example@gmail.com" />
                            @error('email')
                            <code class="text-red-800">{{ $message }}</code>
                            @enderror
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
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                            <option value="" >Select the department</option>
                            @unless ($departments->isEmpty())
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            @else
                                <option value=""> No Department Found</option>

                            @endunless
                        </select>


                            @error('department')
                                <code>{{ $message }}</code>
                            @enderror


                    </div>
                </div>

                <button type="submit" id="add_member_btn"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Add Member
                </button>
            </form>


        </div>
        <!-- ens of add member -->
    </div>
    </div>
    </div>

</x-layout_hr>
