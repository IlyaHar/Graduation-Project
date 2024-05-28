@if ($errors->any())
    <div>
        <strong><p class="text-danger mt-4">{{ $errors->first() }}</p></strong>
    </div>
@endif

@if (session('success'))
    <div>
        <strong><p class="text-success mt-4">{{ session('success') }}</p></strong>
    </div>
@endif
