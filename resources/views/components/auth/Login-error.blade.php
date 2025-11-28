@if ($errors->has('loginError'))
    <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-2 rounded-lg text-center text-sm">
        {{ $errors->first('loginError') }}
    </div>
@endif

@if (session('success'))
    <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-2 rounded-lg text-center text-sm">
        {{ session('success') }}
    </div>
@endif
