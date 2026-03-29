@extends('backend.app')

@section('title', 'Edit menu link — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-7">
        @include('backend.partials.cms-header', [
            'title' => 'Edit menu link',
            'subtitle' => ucfirst(str_replace('_', ' ', $item->zone)),
            'backRoute' => route('admin.menu-items.index', ['zone' => $item->zone], false),
        ])
        <div class="card cms-card border-0 p-4">
            <form action="{{ route('admin.menu-items.update', $item) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label class="form-label fw-bold">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control" value="{{ old('label', $item->label) }}" required>
                    @error('label')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Path</label>
                    <input type="text" name="href" class="form-control" value="{{ old('href', $item->href) }}" placeholder="/about-us">
                    @error('href')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Special action</label>
                    <select name="action" class="form-select">
                        <option value="">— None —</option>
                        <option value="openModal" @selected(old('action', $item->action) === 'openModal')>Open modal</option>
                    </select>
                    @error('action')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" @checked(old('is_active', $item->is_active))>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill">Update</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
