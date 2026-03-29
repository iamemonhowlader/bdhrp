@extends('backend.app')

@section('title', 'New menu link — ' . config('app.name'))

@section('content')
@include('backend.partials.cms-shell-start')
<div class="row">
    <div class="col-lg-7">
        @include('backend.partials.cms-header', [
            'title' => 'New menu link',
            'subtitle' => ucfirst(str_replace('_', ' ', $zone)),
            'backRoute' => route('admin.menu-items.index', ['zone' => $zone], false),
        ])
        <div class="card cms-card border-0 p-4">
            <form action="{{ route('admin.menu-items.store') }}" method="POST">
                @csrf
                <input type="hidden" name="zone" value="{{ $zone }}">
                <div class="mb-3">
                    <label class="form-label fw-bold">Label <span class="text-danger">*</span></label>
                    <input type="text" name="label" class="form-control" value="{{ old('label') }}" required>
                    @error('label')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Path</label>
                    <input type="text" name="href" class="form-control" value="{{ old('href') }}" placeholder="/about-us">
                    <div class="form-text small">Internal path starting with <code>/</code>. Leave empty if using action below.</div>
                    @error('href')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label class="form-label fw-bold">Special action</label>
                    <select name="action" class="form-select">
                        <option value="">— None —</option>
                        <option value="openModal" @selected(old('action') === 'openModal')>Open modal (e.g. lifetime member)</option>
                    </select>
                    @error('action')<div class="text-danger small">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active" @checked(old('is_active', true))>
                    <label class="form-check-label" for="is_active">Active</label>
                </div>
                <button type="submit" class="btn btn-primary rounded-pill">Save</button>
            </form>
        </div>
    </div>
</div>
@include('backend.partials.cms-shell-end')
@endsection
