@extends('backend.app')

@section('title', 'Tags — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Tags',
            'subtitle' => 'Labels for articles',
            'actionRoute' => route('admin.tags.create'),
            'actionLabel' => 'New Tag',
        ])

        <div class="card cms-card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Articles</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tags as $tag)
                        <tr>
                            <td>{{ $tag->id }}</td>
                            <td class="fw-semibold">{{ $tag->name }}</td>
                            <td><span class="text-muted small">{{ $tag->slug }}</span></td>
                            <td>{{ $tag->articles_count }}</td>
                            <td class="text-end">
                                <a href="{{ route('admin.tags.edit', $tag) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this tag?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted">No tags yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0">{{ $tags->links() }}</div>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
