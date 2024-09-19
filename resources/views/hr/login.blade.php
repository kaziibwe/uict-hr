



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Institute Workplan</title>
    <link
      href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"
      rel="stylesheet"
    />

    <style>
      .login-error {
        display: none;
        color: salmon;
        margin-bottom: 10px;
      }
      .login-error.show-error {
        display: block;
      }
    </style>
  </head>
  <body class="bg-gray-50 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
      <div class="flex justify-center mb-4">
        <img src="https://workplan.uict.ac.ug/logo.jpg" />
      </div>
      <x-flush-message/>
      <form method="POST" class="space-y-4" action="{{ route('authenticate') }}" >
        @csrf

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700"
            >Email</label
          >
          <input
            type="email"
            id="email"
            name="email"
           value="{{old('email')}}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
          />
          @error('email')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
       @enderror
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700"
            >Password</label
          >
          <input
            type="password"
            id="password"
            name="password"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            required
          />
          @error('password')
          <p class="text-red-500 text-xs mt-1">{{$message}}</p>
       @enderror
        </div>
        <div>
          <p class="login-error">Wrong Email or Password</p>
          <button
            type="submit"
            id="login-button"
            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
          >
            Login
          </button>
        </div>
      </form>
    </div>
    <script type="module" src="/js/login.js"></script>
  </body>
</html>
