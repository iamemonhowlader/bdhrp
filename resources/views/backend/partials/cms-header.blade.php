{{-- Expects: $title, $subtitle (optional), $backRoute (optional), $actionLabel (optional), $actionRoute (optional) --}}
<div class="cms-page-hero px-4 py-3 mb-3 shadow-sm">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="mb-0">
            <h3 class="mb-1 text-white fw-bold fs-4">{{ $title }}</h3>
            @isset($subtitle)
                <p class="text-white mb-0 small opacity-90">{{ $subtitle }}</p>
            @endisset
        </div>
        @if(isset($backRoute) || (isset($actionRoute) && isset($actionLabel)))
            <div class="d-flex gap-2 flex-shrink-0">
                @isset($backRoute)
                    <a href="{{ $backRoute }}" class="btn btn-outline-light btn-sm px-3 rounded-pill shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Back
                    </a>
                @endisset
                @isset($actionRoute, $actionLabel)
                    <a href="{{ $actionRoute }}" class="btn btn-light text-primary fw-bold btn-sm px-3 rounded-pill shadow-sm">
                        <i class="bi bi-plus-lg me-1"></i> {{ $actionLabel }}
                    </a>
                @endisset
            </div>
        @endif
    </div>
</div>
