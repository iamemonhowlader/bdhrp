<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'notobengali', 'dejavusans', sans-serif;
    font-size: 10pt;
    color: #111;
    line-height: 1.4;
    background: white;
}

/* ======= PAGE LAYOUT ======= */
.page {
    padding: 20px;
    max-width: 210mm;
    margin: 0 auto;
}

/* ======= HEADER ======= */
.header {
    text-align: center;
    border-bottom: 2px solid #006039;
    padding-bottom: 15px;
    margin-bottom: 20px;
    position: relative;
}
.org {
    font-size: 16pt;
    font-weight: bold;
    color: #006039;
    margin-bottom: 5px;
}
.sub {
    font-size: 9pt;
    color: #444;
    margin-bottom: 5px;
}
.reg-no {
    font-size: 8.5pt;
    color: #666;
    font-weight: bold;
}
.title {
    font-size: 14pt;
    font-weight: bold;
    color: #111;
    margin-top: 15px;
    padding: 8px;
    background: #f0faf4;
    border: 2px solid #006039;
    text-align: center;
    text-decoration: underline;
    letter-spacing: 0.5px;
}

/* ======= INFO BOX ======= */
.info-box {
    border: 2px solid #006039;
    border-radius: 5px;
    margin-bottom: 20px;
    background: #fafafa;
}
.info-row {
    display: flex;
    border-bottom: 1px solid #e0e0e0;
}
.info-row:last-child {
    border-bottom: none;
}
.info-col {
    flex: 1;
    padding: 8px 12px;
    display: flex;
    border-right: 1px solid #e0e0e0;
}
.info-col:last-child {
    border-right: none;
}
.info-label {
    font-weight: bold;
    color: #006039;
    min-width: 80px;
    font-size: 9pt;
}
.info-value {
    color: #111;
    border-bottom: 1px dotted #666;
    flex: 1;
    margin-left: 8px;
    min-height: 14px;
}

/* ======= TABLE CONTAINER ======= */
.table-container {
    border: 2px solid #006039;
    border-radius: 5px;
    margin-bottom: 20px;
    overflow: hidden;
}

/* ======= TABLE HEADER ======= */
.table-header {
    background: #006039;
    color: white;
    display: flex;
    font-weight: bold;
    font-size: 9pt;
}
.col-id { width: 6%; padding: 8px 4px; text-align: center; border-right: 1px solid #004d2e; }
.col-photo { width: 8%; padding: 8px 4px; text-align: center; border-right: 1px solid #004d2e; }
.col-info { width: 40%; padding: 8px 6px; text-align: center; border-right: 1px solid #004d2e; }
.col-role { width: 12%; padding: 8px 4px; text-align: center; border-right: 1px solid #004d2e; }
.col-blood { width: 8%; padding: 8px 4px; text-align: center; border-right: 1px solid #004d2e; }
.col-sign { width: 18%; padding: 8px 4px; text-align: center; }

/* ======= TABLE ROWS ======= */
.row {
    display: flex;
    border-bottom: 1px solid #e0e0e0;
    background: white;
}
.row:last-child {
    border-bottom: none;
}
.row:nth-child(even) {
    background: #f8f8f8;
}
.row td {
    font-size: 8pt;
    padding: 6px 4px;
    border-right: 1px solid #e0e0e0;
    vertical-align: top;
}
.row td:last-child {
    border-right: none;
}

/* ======= MEMBER INFO ======= */
.member-info {
    display: flex;
    margin-bottom: 2px;
    line-height: 1.2;
}
.member-label {
    font-weight: bold;
    color: #006039;
    min-width: 50px;
    font-size: 7.5pt;
}
.member-value {
    color: #111;
    flex: 1;
    font-size: 7.5pt;
}

/* ======= PHOTO & SIGNATURE ======= */
.photo-placeholder, .sign-placeholder {
    width: 30px;
    height: 35px;
    border: 1px solid #ccc;
    background: #f3f4f6;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 6pt;
    color: #666;
    margin: 0 auto;
}
.sign-placeholder {
    width: 45px;
    height: 25px;
    border-bottom: 1px solid #666;
    background: transparent;
}

/* ======= PAYMENT SECTION ======= */
.payment-section {
    border: 2px solid #006039;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 10px;
    background: #fafafa;
}
.payment-title {
    font-weight: bold;
    color: #006039;
    font-size: 10pt;
    margin-bottom: 8px;
    text-align: center;
    border-bottom: 1px solid #006039;
    padding-bottom: 5px;
}
.payment-row {
    display: flex;
    margin-bottom: 5px;
}
.payment-row:last-child {
    margin-bottom: 0;
}

/* ======= SIGNATURE SECTION ======= */
.signature-section {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    border: 2px solid #006039;
    border-radius: 5px;
    padding: 15px;
    background: #fafafa;
}
.signature-box {
    flex: 1;
    text-align: center;
}
.signature-text {
    font-size: 9pt;
    color: #444;
    margin-bottom: 20px;
}
.signature-line {
    border-top: 1px solid #333;
    height: 30px;
    margin-bottom: 5px;
}

/* ======= FOOTER ======= */
.footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 2px solid #006039;
    padding-top: 10px;
    font-size: 8pt;
    color: #666;
}
.footer-left { text-align: left; }
.footer-center { text-align: center; font-weight: bold; }
.footer-right { text-align: right; }

/* ======= STATUS BADGE ======= */
.status-badge {
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 7.5pt;
    font-weight: bold;
    text-transform: uppercase;
}
.status-pending { background: #fef3c7; color: #92400e; border: 1px solid #f59e0b; }
.status-approved { background: #d1fae5; color: #065f46; border: 1px solid #22c55e; }
.status-rejected { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
</style>
</head>
<body>

<div class="page">

{{-- ===== DEBUG INFO (REMOVE IN PRODUCTION) ===== --}}
{{-- @dump($application) --}}

{{-- ===== HEADER ===== --}}
<div class="header">
    <div class="org">বাংলাদেশ মানবাধিকার পরিষদ</div>
    <div class="sub">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কর্তৃক অনুমোদিত ও স্বীকৃতি প্রাপ্ত</div>
    <div class="reg-no">গভঃ রেজিঃ নং-ম-০৮১০২/০৭</div>
    <div class="title">
        @if(!empty($application->committee_type))
            @switch($application->committee_type)
                @case('union')
                    ইউনিয়ন কমিটি সদস্য ফরম
                    @break
                @case('ward')
                    ওয়ার্ড কমিটি সদস্য ফরম
                    @break
                @case('city')
                    সিটি কমিটি সদস্য ফরম
                    @break
                @case('thana')
                    থানা কমিটি সদস্য ফরম
                    @break
                @case('district')
                    জেলা কমিটি সদস্য ফরম
                    @break
                @default
                    কমিটি সদস্য ফরম
            @endswitch
        @else
            কমিটি সদস্য ফরম
        @endif
    </div>
</div>

{{-- ===== LOCATION INFORMATION ===== --}}
<div class="info-box">
    <div class="info-row">
        <div class="info-col">
            <span class="info-label">গ্রাম/এলাকা:</span>
            <span class="info-value">{{ $application->area ?? '' }}</span>
        </div>
        <div class="info-col">
            <span class="info-label">ওয়ার্ড:</span>
            <span class="info-value">{{ $application->ward ?? '' }}</span>
        </div>
    </div>
    <div class="info-row">
        <div class="info-col">
            <span class="info-label">ইউনিয়ন:</span>
            <span class="info-value">{{ $application->union ?? '' }}</span>
        </div>
        <div class="info-col">
            <span class="info-label">থানা:</span>
            <span class="info-value">{{ $application->thana ?? '' }}</span>
        </div>
    </div>
    <div class="info-row">
        <div class="info-col">
            <span class="info-label">জেলা:</span>
            <span class="info-value">{{ $application->district ?? '' }}</span>
        </div>
        <div class="info-col">
            <span class="info-label">বিভাগ:</span>
            <span class="info-value">{{ $application->division ?? '' }}</span>
        </div>
    </div>
</div>

{{-- ===== COMMITTEE MEMBERS TABLE ===== --}}
<div class="table-container">
    <div class="table-header">
        <div class="col-id">ক্রমিক</div>
        <div class="col-photo">ছবি</div>
        <div class="col-info">সদস্যের বিবরণ</div>
        <div class="col-role">পদবী</div>
        <div class="col-blood">রক্ত</div>
        <div class="col-sign">স্বাক্ষর</div>
    </div>

    {{-- Member Rows --}}
    @php $serial = 1; @endphp
    @foreach ($application->members ?? [] as $member)
        <div class="row">
            <div class="col-id">{{ $serial++ }}</div>

            <div class="col-photo">
                @if (!empty($member['photo']))
                    <div class="photo-placeholder">
                        <img src="{{ $member['photo'] }}" style="width: 30px; height: 35px; object-fit: cover;" />
                    </div>
                @else
                    <div class="photo-placeholder">ছবি</div>
                @endif
            </div>

            <div class="col-info">
                <div class="member-info">
                    <span class="member-label">নাম:</span>
                    <span class="member-value"> {{ $member['name'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">পিতা:</span>
                    <span class="member-value"> {{ $member['father'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">মাতা:</span>
                    <span class="member-value"> {{ $member['mother'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">ঠিকানা:</span>
                    <span class="member-value"> {{ $member['address'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">NID:</span>
                    <span class="member-value"> {{ $member['nid'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">মোবাইল:</span>
                    <span class="member-value"> {{ $member['phone'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">রক্তের গ্রুপ:</span>
                    <span class="member-value"> {{ $member['bloodGroup'] ?? '' }}</span>
                </div>
                <div class="member-info">
                    <span class="member-label">সদস্য আইডি:</span>
                    <span class="member-value"> {{ $member['memberId'] ?? '' }}</span>
                </div>
            </div>

            <div class="col-role">{{ $member['role'] ?? '' }}</div>
            <div class="col-blood">{{ $member['bloodGroup'] ?? '' }}</div>

            <div class="col-sign">
                @if (!empty($member['signatureImage']))
                    <div class="sign-placeholder">
                        <img src="{{ $member['signatureImage'] }}" style="width: 45px; height: 25px; object-fit: contain;" />
                    </div>
                @elseif (!empty($member['digitalSignature']))
                    <div class="sign-placeholder">
                        <img src="{{ $member['digitalSignature'] }}" style="width: 45px; height: 25px; object-fit: contain;" />
                    </div>
                @else
                    <div class="sign-placeholder">স্বাক্ষর</div>
                @endif
            </div>
        </div>
    @endforeach

    {{-- Empty rows if no members --}}
    @if(empty($application->members))
        @for($i = 1; $i <= 5; $i++)
            <div class="row">
                <div class="col-id">{{ $i }}</div>
                <div class="col-photo">
                    <div class="photo-placeholder">ছবি</div>
                </div>
                <div class="col-info">
                    <div class="member-info">
                        <span class="member-label">নাম:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">পিতা:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">মাতা:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">ঠিকানা:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">NID:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">মোবাইল:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">রক্তের গ্রুপ:</span>
                        <span class="member-value"> ___________________</span>
                    </div>
                    <div class="member-info">
                        <span class="member-label">পেশা:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                </div>
                <div class="col-role">_________________</div>
                <div class="col-blood">_________________</div>
                <div class="col-sign">
                    <div class="sign-placeholder">স্বাক্ষর</div>
                </div>
            </div>
        @endfor
    @endif
</div>

{{-- ===== PAYMENT INFORMATION ===== --}}
@if(!empty($application->total_fee))
<div class="payment-section">
    <div class="payment-title">পেমেন্ট তথ্য</div>
    <div class="payment-row">
        <div class="info-col">
            <span class="info-label">মোট ফি:</span>
            <span class="info-value">৳{{ number_format($application->total_fee, 2) }}</span>
        </div>
        <div class="info-col">
            <span class="info-label">আবেদনের স্থিতি:</span>
            <span class="info-value">
                <span class="status-badge status-{{ $application->status ?? 'pending' }}">{{ strtoupper($application->status ?? 'pending') }}</span>
            </span>
        </div>
    </div>
</div>
@endif

{{-- ===== SIGNATURE SECTION ===== --}}
<div class="signature-section">
    <div class="signature-box">
        <div class="signature-text">সভাপতি</div>
        <div class="signature-line"></div>
        <div class="signature-text">বাংলাদেশ মানবাধিকার পরিষদ</div>
    </div>
    <div class="signature-box">
        <div class="signature-text">সাধারণ সম্পাদক</div>
        <div class="signature-line"></div>
        <div class="signature-text">বাংলাদেশ মানবাধিকার পরিষদ</div>
    </div>
</div>

{{-- ===== FOOTER ===== --}}
<div class="footer">
    <div class="footer-left">Serial No: #{{ $application->id ?? 'N/A' }}</div>
    <div class="footer-center">Page 1</div>
    <div class="footer-right">তারিখ: {{ $application->created_at ? $application->created_at->format('d F, Y') : now()->format('d F, Y') }}</div>
</div>

</div>

</body>
</html>
