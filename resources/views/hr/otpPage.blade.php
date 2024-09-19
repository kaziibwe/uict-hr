<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workplan - Verify login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-50 flex items-center justify-center h-screen">
    <!-- OTP Screen -->
    <div id="otp-screen" class="w-full max-w-sm bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-center mb-4">
            <img src="https://workplan.uict.ac.ug/logo.jpg" alt="Logo">
        </div>
        <x-flush-message  />

        <form class="space-y-4" method="POST" action="{{ route('otpverifying',$email) }}">
            @csrf
            <div>
                <label for="otp" class="block text-sm font-medium text-gray-700">Enter OTP from Email</label>
                <input type="text" name="otp" value="{{ old('otp') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div>
                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Verify OTP</button>
            </div>
        </form>
    </div>
</body>
</html>
