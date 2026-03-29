@extends('backend.app')

@section('title', 'All photos — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Photo library',
            'subtitle' => 'All uploads across albums',
            'backRoute' => route('admin.galleries.index'),
        ])

        <div class="row g-3">
            @forelse ($photos as $photo)
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card cms-card border-0 shadow-sm h-100">
                    <div class="ratio ratio-1x1 bg-light">
                        <img src="{{ asset('storage/'.$photo->image_path) }}" alt="" class="w-100 h-100 rounded-top" style="object-fit:cover">
                    </div>
                    <div class="card-body p-2">
                        <div class="small fw-bold text-truncate">{{ $photo->gallery?->title ?? '—' }}</div>
                        <div class="d-flex gap-1 mt-2">
                            @if($photo->gallery)
                                <a href="{{ route('admin.galleries.photos.edit', [$photo->gallery, $photo]) }}" class="btn btn-sm btn-outline-primary rounded-pill flex-grow-1">Edit</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5 text-muted">No photos yet.</div>
            @endforelse
        </div>
        <div class="mt-4">{{ $photos->links() }}</div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
