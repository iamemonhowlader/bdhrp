@extends('backend.app')

@section('title', 'Edit Team Member')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --team-primary: #006039;
        --team-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .team-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--team-gradient);
        border-radius: 2rem;
        padding: 3rem;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .form-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .form-label { font-weight: 700; color: #374151; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 12px; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; }
    .form-control:focus, .form-select:focus { border-color: var(--team-primary); box-shadow: 0 0 0 4px rgba(0, 96, 57, 0.1); }
    .btn-submit { background: var(--team-primary); color: white; font-weight: 800; border-radius: 12px; padding: 0.75rem 2rem; border: none; transition: all 0.3s ease; }
    .btn-submit:hover { background: #004d2e; transform: translateY(-2px); box-shadow: 0 10px 20px rgba(0, 96, 57, 0.2); }
    .current-image { width: 100px; height: 120px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area team-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="display-6 fw-800 mb-2">Edit Team Member</h1>
                        <p class="fs-6 opacity-90 mb-0">Update the details for {{ $teamMember->name }}.</p>
                    </div>
                    <a href="{{ route('admin.team-members.index') }}" class="btn btn-light rounded-pill px-4 fw-bold">
                        <i class="bi bi-arrow-left me-2"></i> Back to List
                    </a>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card form-card">
                        <div class="card-body p-5">
                            <form action="{{ route('admin.team-members.update', $teamMember) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $teamMember->name) }}" required>
                                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="designation" class="form-label">Designation</label>
                                        <input type="text" name="designation" id="designation" class="form-control @error('designation') is-invalid @enderror" value="{{ old('designation', $teamMember->designation) }}" required>
                                        @error('designation') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="category" class="form-label">Category</label>
                                        <select name="category" id="category" class="form-select @error('category') is-invalid @enderror" required>
                                            <option value="leadership" {{ old('category', $teamMember->category) == 'leadership' ? 'selected' : '' }}>Leadership</option>
                                            <option value="coordinator" {{ old('category', $teamMember->category) == 'coordinator' ? 'selected' : '' }}>Coordinator</option>
                                        </select>
                                        @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <label for="order" class="form-label">Display Order</label>
                                        <input type="number" name="order" id="order" class="form-control @error('order') is-invalid @enderror" value="{{ old('order', $teamMember->order) }}" required>
                                        @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-md-12">
                                        <label for="image_file" class="form-label">Profile Image</label>
                                        @if($teamMember->image)
                                            <div class="d-block">
                                                <img src="{{ asset('storage/' . $teamMember->image) }}" alt="Current image" class="current-image">
                                            </div>
                                        @endif
                                        <input type="file" name="image_file" id="image_file" class="form-control @error('image_file') is-invalid @enderror" accept="image/*">
                                        <small class="text-muted">Leave empty to keep current image. Recommended size: 500x600px. Max size: 2MB.</small>
                                        @error('image_file') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>

                                    <div class="col-12 mt-5">
                                        <button type="submit" class="btn btn-submit w-100">
                                            <i class="bi bi-check-circle-fill me-2"></i> Update Team Member
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
