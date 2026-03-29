@extends('backend.app')

@section('title', 'Categories — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Categories',
            'subtitle' => 'Organize news & blog posts',
            'actionRoute' => route('admin.categories.create'),
            'actionLabel' => 'New Category',
        ])

        <div class="card cms-card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Parent</th>
                            <th>Active</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td class="fw-semibold">{{ $cat->name }}</td>
                            <td><span class="text-muted small">{{ $cat->slug }}</span></td>
                            <td>{{ $cat->parent?->name ?? '—' }}</td>
                            <td>
                                @if($cat->is_active)
                                    <span class="badge bg-light-success text-success rounded-pill px-3">Yes</span>
                                @else
                                    <span class="badge bg-light-secondary text-secondary rounded-pill px-3">No</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-sm btn-outline-primary rounded-pill"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center py-5 text-muted">No categories yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0">{{ $categories->links() }}</div>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
