@extends('backend.app')

@section('title', 'Create Committee')

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
    .form-control:focus { border-color: var(--comm-primary); box-shadow: 0 0 0 4px rgba(0, 96, 57, 0.1); }
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
                        <li class="breadcrumb-item active text-white" aria-current="page">Create New</li>
                    </ol>
                </nav>
                <h1 class="display-6 fw-800 mb-0">Create New Committee</h1>
            </div>

            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="premium-card bg-white p-4 p-md-5">
                        <form action="{{ route('admin.committees.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label">Committee Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Barishal Committee" required value="{{ old('name') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">URL Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="e.g. barishal" required value="{{ old('slug') }}">
                                    <small class="text-muted">Unique identifier for the URL.</small>
                                </div>

                                <div class="col-12">
                                    <label class="form-label">About the Committee</label>
                                    <textarea name="about" class="form-control" rows="5" placeholder="Description of the committee's work and mission...">{{ old('about') }}</textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Landscape Image</label>
                                    <input type="file" name="image_file" class="form-control">
                                    <small class="text-muted">Recommended: 1200x800px. High quality.</small>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Image Caption</label>
                                    <input type="text" name="image_caption" class="form-control" placeholder="e.g. Landscape of Barishal" value="{{ old('image_caption') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Contact Email</label>
                                    <input type="email" name="contact_email" class="form-control" placeholder="e.g. barishal@bdhrp.org" value="{{ old('contact_email') }}">
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Leadership PDF (Optional)</label>
                                    <input type="file" name="pdf_file" class="form-control" accept=".pdf">
                                    <small class="text-muted">Upload the Parishad Leadership List PDF.</small>
                                </div>

                                <div class="col-12 mt-4 pt-3 border-top">
                                    <h5 class="fw-bold mb-3">Social Media Links</h5>
                                    <div class="row g-3">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-facebook"></i></span>
                                                <input type="url" name="facebook_url" class="form-control border-start-0" placeholder="Facebook URL" value="{{ old('facebook_url') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-instagram"></i></span>
                                                <input type="url" name="instagram_url" class="form-control border-start-0" placeholder="Instagram URL" value="{{ old('instagram_url') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-twitter-x"></i></span>
                                                <input type="url" name="twitter_url" class="form-control border-start-0" placeholder="Twitter/X URL" value="{{ old('twitter_url') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-5 text-end">
                                    <a href="{{ route('admin.committees.index') }}" class="btn btn-light rounded-pill px-4 me-2">Cancel</a>
                                    <button type="submit" class="btn btn-success rounded-pill px-5 fw-bold">Create Committee</button>
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
