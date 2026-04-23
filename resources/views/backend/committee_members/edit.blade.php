@extends('backend.app')

@section('title', 'Edit Committee Member')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    :root {
        --comm-primary: #006039;
        --comm-gradient: linear-gradient(135deg, #006039 0%, #059669 100%);
    }
    .comm-container { font-family: 'Plus Jakarta Sans', sans-serif; }
    .premium-page-header {
        background: var(--comm-gradient);
        border-radius: 2rem;
        padding: 3rem;
        color: white;
        margin-bottom: 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(0, 96, 57, 0.2);
    }
    .premium-card { border-radius: 1.5rem; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .form-label { font-weight: 700; color: #475569; font-size: 0.9rem; margin-bottom: 0.5rem; }
    .form-control, .form-select { border-radius: 12px; padding: 0.75rem 1rem; border: 1.5px solid #e2e8f0; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area comm-container">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="premium-page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="{{ route('admin.committees.index') }}" class="text-white opacity-75">Committees</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.committees.members.index', $committee) }}" class="text-white opacity-75">{{ $committee->name }} Members</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Edit Member</li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-800 mb-0">Edit Team Member</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="premium-card bg-white p-4 p-md-5">
                        <form action="{{ route('admin.committees.members.update', [$committee, $member]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row g-4">
                                <div class="col-md-12">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Jane Doe" required value="{{ old('name', $member->name) }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Designation</label>
                                    <input type="text" name="designation" class="form-control" placeholder="e.g. Co-Chair" required value="{{ old('designation', $member->designation) }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Category</label>
                                    <input type="text" name="category" class="form-control" placeholder="e.g. Division Leadership" value="{{ old('category', $member->category) }}">
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Profile Image</label>
                                    @if($member->image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $member->image) }}" class="img-thumbnail" style="height: 100px;">
                                        </div>
                                    @endif
                                    <input type="file" name="image_file" class="form-control">
                                    <small class="text-muted">Recommended: Square aspect ratio (400x400px).</small>
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Sort Order</label>
                                    <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $member->sort_order) }}">
                                    <small class="text-muted">Lower numbers appear first.</small>
                                </div>

                                <div class="col-12 mt-5 text-end">
                                    <a href="{{ route('admin.committees.members.index', $committee) }}" class="btn btn-light rounded-pill px-4 me-2">Cancel</a>
                                    <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">Update Member</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
