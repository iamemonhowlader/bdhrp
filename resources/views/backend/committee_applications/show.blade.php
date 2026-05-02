@extends('backend.app')

@section('title', 'Application Details')

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid px-4 pt-4 pb-5">

            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ route('admin.committee-applications.index') }}" class="btn btn-sm btn-light mb-2"><i class="bi bi-arrow-left"></i> Back to List</a>
                    <h1 class="fw-bold">Application Details</h1>
                </div>
                <div class="d-flex gap-2 align-items-center">
                    <a href="{{ route('admin.committee-applications.pdf', $application) }}"
                       target="_blank"
                       class="btn btn-success rounded-pill px-4">
                        <i class="bi bi-file-earmark-pdf"></i> PDF ডাউনলোড
                    </a>
                    <form action="{{ route('admin.committee-applications.update-status', $application) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="approved">
                        <button type="submit" class="btn btn-primary rounded-pill px-4" {{ $application->status === 'approved' ? 'disabled' : '' }}>Approve</button>
                    </form>
                    <form action="{{ route('admin.committee-applications.update-status', $application) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger rounded-pill px-4" {{ $application->status === 'rejected' ? 'disabled' : '' }}>Reject</button>
                    </form>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">Committee Information</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="small text-muted d-block">Committee Type</label>
                                    <span class="fw-bold fs-5">{{ $application->committee_type }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted d-block">Status</label>
                                    <span class="badge bg-{{ $application->status === 'approved' ? 'success' : ($application->status === 'rejected' ? 'danger' : 'warning') }}">{{ strtoupper($application->status) }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted d-block">Location</label>
                                    <span>{{ $application->division }} > {{ $application->district }} > {{ $application->thana }}</span>
                                </div>
                                <div class="col-md-6">
                                    <label class="small text-muted d-block">Area / Village</label>
                                    <span>{{ $application->area ?: 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted d-block">Union</label>
                                    <span>{{ $application->union ?: 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted d-block">Ward</label>
                                    <span>{{ $application->ward ?: 'N/A' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted d-block">Pouroshova</label>
                                    <span>{{ $application->pouroshova ?: 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-2">Committee Members</h5>
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>NID / Phone</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($application->applicationMembers->count() > 0)
                                            @foreach($application->applicationMembers as $member)
                                                <tr>
                                                    <td class="fw-bold">{{ $member->name ?? 'N/A' }}</td>
                                                    <td>{{ $member->role ?? 'N/A' }}</td>
                                                    <td>
                                                        <small class="d-block">NID: {{ $member->nid ?? 'N/A' }}</small>
                                                        <small class="d-block">Phone: {{ $member->phone ?? 'N/A' }}</small>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="3" class="text-center text-muted">
                                                    <em>No committee members found</em>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 bg-primary text-white mb-4">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-3">Fee Summary</h5>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Total Application Fee</span>
                                <span class="fw-bold fs-4">{{ number_format($application->total_fee, 2) }} BDT</span>
                            </div>
                            <hr class="bg-white opacity-25">
                            <small class="opacity-75">Submitted on: {{ $application->created_at->format('F d, Y H:i') }}</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
