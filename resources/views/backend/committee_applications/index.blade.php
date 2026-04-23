@extends('backend.app')

@section('title', 'Committee Applications')

@push('styles')
<style>
    .status-badge { padding: 0.4rem 1rem; border-radius: 2rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
    .status-pending { background: #fff7ed; color: #9a3412; }
    .status-approved { background: #f0fdf4; color: #166534; }
    .status-rejected { background: #fef2f2; color: #991b1b; }
    .action-btn { width: 34px; height: 34px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; border: 1px solid; transition: all 0.2s; }
    .action-btn:hover { transform: translateY(-1px); box-shadow: 0 4px 12px rgba(0,0,0,0.15); }
    #pdfPreviewModal .modal-dialog { max-width: 860px; }
    #pdfPreviewModal iframe { width: 100%; height: 75vh; border: none; border-radius: 8px; }
</style>
@endpush

@section('content')
<div id="app-content">
    <div class="app-content-area">
        <div class="container-fluid px-4 pt-4 pb-5">
            
            <div class="mb-4">
                <h1 class="fw-bold">Committee Applications</h1>
                <p class="text-muted">Manage and review committee formation requests.</p>
            </div>

            @if (session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
            @endif

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Type</th>
                                <th>Location</th>
                                <th>Members</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $app)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-bold">{{ $app->committee_type }}</span>
                                    </td>
                                    <td>
                                        <small class="text-muted d-block">{{ $app->division }} › {{ $app->district }}</small>
                                        <span class="fw-medium">{{ $app->thana }}</span>
                                        @if($app->union) <small class="text-muted">({{ $app->union }})</small> @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ count($app->members ?? []) }} Members</span>
                                    </td>
                                    <td>
                                        <span class="fw-bold text-success">{{ number_format($app->total_fee, 2) }} BDT</span>
                                    </td>
                                    <td>
                                        <span class="status-badge status-{{ $app->status }}">
                                            {{ $app->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <small>{{ $app->created_at->format('M d, Y') }}</small>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-flex gap-2 justify-content-end">
                                            {{-- View --}}
                                            <a href="{{ route('admin.committee-applications.show', $app) }}"
                                               class="action-btn text-primary border-primary"
                                               title="Details দেখুন">
                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- PDF Preview & Download --}}
                                            <button type="button"
                                                class="action-btn text-danger border-danger"
                                                title="PDF দেখুন ও ডাউনলোড করুন"
                                                data-bs-toggle="modal"
                                                data-bs-target="#pdfPreviewModal"
                                                data-pdf-url="{{ route('admin.committee-applications.pdf', $app) }}"
                                                data-pdf-name="{{ $app->committee_type }} - {{ $app->district }}">
                                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                            </button>

                                            {{-- Delete --}}
                                            <form action="{{ route('admin.committee-applications.destroy', $app) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="action-btn text-secondary border-secondary"
                                                    title="মুছে ফেলুন"
                                                    onclick="return confirm('এই আবেদনটি মুছে ফেলবেন?')">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">No applications found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($applications->hasPages())
                    <div class="card-footer bg-white py-3">
                        {{ $applications->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>

{{-- PDF Preview Modal --}}
<div class="modal fade" id="pdfPreviewModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-danger text-white border-0 px-4 py-3">
                <h5 class="modal-title fw-bold" id="pdfModalLabel">
                    <i class="bi bi-file-earmark-pdf-fill me-2"></i>
                    <span id="pdfModalName">PDF প্রিভিউ</span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-3 bg-gray-100" style="background:#f3f4f6;">
                <iframe id="pdfFrame" src="" title="PDF Preview"></iframe>
            </div>
            <div class="modal-footer border-0 px-4 py-3">
                <a id="pdfDownloadBtn"
                   href="#"
                   class="btn btn-danger rounded-pill px-5 fw-bold"
                   download>
                    <i class="bi bi-download me-2"></i> PDF ডাউনলোড করুন
                </a>
                <button type="button" class="btn btn-light rounded-pill px-5" data-bs-dismiss="modal">বন্ধ করুন</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const pdfModal = document.getElementById('pdfPreviewModal');
    pdfModal.addEventListener('show.bs.modal', function (event) {
        const btn = event.relatedTarget;
        const pdfUrl = btn.getAttribute('data-pdf-url');
        const pdfName = btn.getAttribute('data-pdf-name');

        // Set iframe src (stream/view the PDF inline)
        document.getElementById('pdfFrame').src = pdfUrl + '?inline=1';
        document.getElementById('pdfModalName').textContent = pdfName;

        // Set download link
        const downloadBtn = document.getElementById('pdfDownloadBtn');
        downloadBtn.href = pdfUrl;
        downloadBtn.setAttribute('download', pdfName + '.pdf');
    });

    pdfModal.addEventListener('hide.bs.modal', function () {
        // Clear iframe on close to stop loading
        document.getElementById('pdfFrame').src = '';
    });
</script>
@endpush
