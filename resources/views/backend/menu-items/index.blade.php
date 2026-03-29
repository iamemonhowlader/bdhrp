@extends('backend.app')

@section('title', 'Menu links — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-12">
        @include('backend.partials.cms-header', [
            'title' => 'Frontend menu links',
            'subtitle' => 'About, Join Us, and Topics dropdowns on the public site.',
            'backRoute' => route('admin.site-settings.edit', [], false),
            'actionRoute' => route('admin.menu-items.create', ['zone' => $zone], false),
            'actionLabel' => 'Add link',
        ])

        <div class="card cms-card border-0 mb-4">
            <div class="card-body py-3">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-auto">
                        <label class="form-label small mb-0 text-muted">Zone</label>
                        <select name="zone" class="form-select form-select-sm" onchange="this.form.submit()">
                            <option value="about" @selected($zone === 'about')>About</option>
                            <option value="join_us" @selected($zone === 'join_us')>Join Us</option>
                            <option value="topics" @selected($zone === 'topics')>Topics</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-responsive card cms-card border-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr><th>#</th><th>Label</th><th>Path / action</th><th>Active</th><th class="text-end">Actions</th></tr></thead>
                <tbody>
                    @forelse($items as $item)
                    <tr>
                        <td>{{ $item->sort_order }}</td>
                        <td class="fw-semibold">{{ $item->label }}</td>
                        <td><code class="small">{{ $item->action ?: $item->href ?: '—' }}</code></td>
                        <td>{!! $item->is_active ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-secondary">No</span>' !!}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.menu-items.edit', $item, false) }}" class="btn btn-sm btn-outline-primary rounded-pill">Edit</a>
                            <form action="{{ route('admin.menu-items.destroy', $item, false) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this link?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">No links yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">{{ $items->links() }}</div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
