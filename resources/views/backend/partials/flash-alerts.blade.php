@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-3 py-2" role="alert">
        <strong class="small">Please fix the following:</strong>
        <ul class="mb-0 mt-1 small">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('t-error'))
    <div class="alert alert-warning alert-dismissible fade show shadow-sm mb-3 py-2" role="alert">
        {{ session('t-error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
