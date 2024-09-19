@if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed transform -translate-x-1/2 top-0 left-1/2 bg-green-200 text-green-800 px-48 py-3 shadow-md rounded">
        <p>{{ session('success') }}</p>
    </div>
@endif


@if (session()->has('danger'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed transform -translate-x-1/2 top-0 left-1/2 bg-red-200 text-red-800 px-48 py-3 shadow-md rounded">
        <p>{{ session('danger') }}</p>

    </div>
@endif

{{-- @if (session()->has('danger'))
    @php
        $dangerMessage = session('danger');
        if (is_array($dangerMessage)) {
            $dangerMessage = implode(', ', $dangerMessage); // Convert array to a comma-separated string
        }
    @endphp

    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
         class="fixed transform -translate-x-1/2 top-0 left-1/2 bg-red-200 text-red-800 px-48 py-3 shadow-md rounded">
        <p>{{ $dangerMessage }}</p>
    </div>
@endif --}}
