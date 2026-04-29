<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
@page {
    size: A4;
    margin: 20px;
}

body {
    font-family: 'notobengali', 'SolaimanLipi', Arial, sans-serif;
    font-size: 12pt;
    color: #000;
    line-height: 1.4;
    margin: 0;
    padding: 0;
    background: white;
    position: relative;
}

/* Watermark */
.watermark {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    opacity: 0.1;
    font-size: 72pt;
    font-weight: bold;
    color: #006039;
    z-index: -1;
    pointer-events: none;
}

/* Header */
.header {
    text-align: center;
    margin-bottom: 30px;
    position: relative;
}

.logo {
    width: 80px;
    height: 80px;
    margin: 0 auto 10px;
    display: block;
}

.org-name {
    font-size: 18pt;
    font-weight: bold;
    color: #006039;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.org-subtitle {
    font-size: 10pt;
    color: #333;
    margin-bottom: 5px;
}

.reg-number {
    font-size: 9pt;
    color: #666;
    font-weight: bold;
    margin-bottom: 15px;
}

.form-title {
    font-size: 16pt;
    font-weight: bold;
    color: #000;
    padding: 10px;
    border: 2px solid #006039;
    background: #f8f8f8;
    text-align: center;
    text-decoration: underline;
    margin-top: 15px;
}

/* Location Section */
.location-section {
    border: 2px solid #006039;
    padding: 15px;
    margin-bottom: 25px;
    background: #fafafa;
}

.location-row {
    display: flex;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 8px;
}

.location-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.location-col {
    flex: 1;
    display: flex;
    align-items: center;
}

.location-label {
    font-weight: bold;
    color: #006039;
    min-width: 80px;
    font-size: 10pt;
}

.location-value {
    color: #000;
    border-bottom: 1px dotted #666;
    flex: 1;
    margin-left: 10px;
    min-height: 16px;
    font-size: 10pt;
}

/* Members Table */
.members-section {
    margin-bottom: 25px;
}

.table-title {
    font-size: 14pt;
    font-weight: bold;
    color: #006039;
    text-align: center;
    margin-bottom: 10px;
    text-decoration: underline;
}

.members-table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #006039;
}

.members-table th {
    background: #006039;
    color: white;
    padding: 8px 6px;
    font-size: 9pt;
    text-align: center;
    border: 1px solid #004d2e;
    font-weight: bold;
}

.members-table td {
    padding: 6px 4px;
    font-size: 8pt;
    border: 1px solid #ccc;
    vertical-align: top;
    text-align: center;
}

.members-table tr:nth-child(even) {
    background: #f8f8f8;
}

.member-details {
    text-align: left;
    line-height: 1.3;
}

.member-field {
    margin-bottom: 2px;
}

.field-label {
    font-weight: bold;
    color: #006039;
    font-size: 7pt;
}

.field-value {
    color: #000;
    font-size: 7pt;
}

.photo-box, .signature-box {
    width: 35px;
    height: 40px;
    border: 1px solid #ccc;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 6pt;
    color: #666;
    margin: 0 auto;
}

.signature-box {
    width: 50px;
    height: 30px;
    border-bottom: 1px solid #666;
    background: transparent;
}

/* Fee Section */
.fee-section {
    border: 2px solid #006039;
    padding: 15px;
    margin-bottom: 25px;
    background: #fafafa;
}

.fee-title {
    font-size: 12pt;
    font-weight: bold;
    color: #006039;
    text-align: center;
    margin-bottom: 10px;
    border-bottom: 1px solid #006039;
    padding-bottom: 5px;
}

.fee-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 5px;
}

.fee-label {
    font-weight: bold;
    color: #333;
}

.fee-amount {
    font-weight: bold;
    color: #006039;
}

/* Signature Section */
.signature-section {
    display: flex;
    justify-content: space-between;
    margin-bottom: 25px;
    padding: 20px;
    border: 2px solid #006039;
    background: #fafafa;
}

.signature-column {
    flex: 1;
    text-align: center;
}

.signature-role {
    font-size: 10pt;
    font-weight: bold;
    color: #333;
    margin-bottom: 30px;
}

.signature-line {
    border-top: 2px solid #000;
    height: 40px;
    margin-bottom: 5px;
}

.signature-org {
    font-size: 9pt;
    color: #666;
}

/* Footer */
.footer {
    text-align: center;
    font-size: 8pt;
    color: #666;
    border-top: 1px solid #ccc;
    padding-top: 10px;
    margin-top: 20px;
}

/* Status Badge */
.status-badge {
    display: inline-block;
    padding: 3px 8px;
    border-radius: 12px;
    font-size: 7pt;
    font-weight: bold;
    text-transform: uppercase;
}

.status-pending { 
    background: #fff3cd; 
    color: #856404; 
    border: 1px solid #ffeaa7; 
}

.status-approved { 
    background: #d4edda; 
    color: #155724; 
    border: 1px solid #c3e6cb; 
}

.status-rejected { 
    background: #f8d7da; 
    color: #721c24; 
    border: 1px solid #f5c6cb; 
}
</style>
</head>
<body>

<!-- Watermark -->
<div class="watermark">বাংলাদেশ মানবাধিকার পরিষদ</div>

<!-- Header -->
<div class="header">
    @if(file_exists(public_path('images/logo.png')))
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
    @endif
    
    <div class="org-name">বাংলাদেশ মানবাধিকার পরিষদ</div>
    <div class="org-subtitle">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কর্তৃক অনুমোদিত ও স্বীকৃতি প্রাপ্ত</div>
    <div class="reg-number">গভঃ রেজিঃ নং-ম-০৮১০২/০৭</div>
    
    <div class="form-title">
        @if(!empty($application->committee_type))
            @switch($application->committee_type)
                @case('union') ইউনিয়ন কমিটি সদস্য ফরম @break
                @case('ward') ওয়ার্ড কমিটি সদস্য ফরম @break
                @case('city') সিটি কমিটি সদস্য ফরম @break
                @case('thana') থানা কমিটি সদস্য ফরম @break
                @case('district') জেলা কমিটি সদস্য ফরম @break
                @default কমিটি সদস্য ফরম
            @endswitch
        @else
            কমিটি সদস্য ফরম
        @endif
    </div>
</div>

<!-- Location Information -->
<div class="location-section">
    <div class="location-row">
        <div class="location-col">
            <span class="location-label">গ্রাম/এলাকা:</span>
            <span class="location-value">{{ $application->area ?? '' }}</span>
        </div>
        <div class="location-col">
            <span class="location-label">ওয়ার্ড:</span>
            <span class="location-value">{{ $application->ward ?? '' }}</span>
        </div>
    </div>
    <div class="location-row">
        <div class="location-col">
            <span class="location-label">ইউনিয়ন:</span>
            <span class="location-value">{{ $application->union ?? '' }}</span>
        </div>
        <div class="location-col">
            <span class="location-label">থানা:</span>
            <span class="location-value">{{ $application->thana ?? '' }}</span>
        </div>
    </div>
    <div class="location-row">
        <div class="location-col">
            <span class="location-label">জেলা:</span>
            <span class="location-value">{{ $application->district ?? '' }}</span>
        </div>
        <div class="location-col">
            <span class="location-label">বিভাগ:</span>
            <span class="location-value">{{ $application->division ?? '' }}</span>
        </div>
    </div>
</div>

<!-- Committee Members -->
<div class="members-section">
    <div class="table-title">কমিটির সদস্য তালিকা</div>
    
    <table class="members-table">
        <thead>
            <tr>
                <th style="width:6%">ক্রমিক</th>
                <th style="width:8%">ছবি</th>
                <th style="width:40%">সদস্যের বিবরণ</th>
                <th style="width:12%">পদবী</th>
                <th style="width:8%">রক্ত</th>
                <th style="width:18%">স্বাক্ষর</th>
            </tr>
        </thead>
        <tbody>
            @php $serial = 1; @endphp
            @foreach ($application->members ?? [] as $member)
            <tr>
                <td>{{ $serial++ }}</td>
                <td>
                    @if (!empty($member['photo']))
                        <div class="photo-box">
                            <img src="{{ $member['photo'] }}" style="width: 35px; height: 40px; object-fit: cover;" />
                        </div>
                    @else
                        <div class="photo-box">ছবি</div>
                    @endif
                </td>
                <td>
                    <div class="member-details">
                        <div class="member-field">
                            <span class="field-label">নাম:</span>
                            <span class="field-value"> {{ $member['name'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">পিতা:</span>
                            <span class="field-value"> {{ $member['father'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">মাতা:</span>
                            <span class="field-value"> {{ $member['mother'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">ঠিকানা:</span>
                            <span class="field-value"> {{ $member['address'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">NID:</span>
                            <span class="field-value"> {{ $member['nid'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">মোবাইল:</span>
                            <span class="field-value"> {{ $member['phone'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">রক্তের গ্রুপ:</span>
                            <span class="field-value"> {{ $member['bloodGroup'] ?? '' }}</span>
                        </div>
                        <div class="member-field">
                            <span class="field-label">সদস্য আইডি:</span>
                            <span class="field-value"> {{ $member['memberId'] ?? '' }}</span>
                        </div>
                    </div>
                </td>
                <td>{{ $member['role'] ?? '' }}</td>
                <td>{{ $member['bloodGroup'] ?? '' }}</td>
                <td>
                    @if (!empty($member['signatureImage']))
                        <div class="signature-box">
                            <img src="{{ $member['signatureImage'] }}" style="width: 50px; height: 30px; object-fit: contain;" />
                        </div>
                    @elseif (!empty($member['digitalSignature']))
                        <div class="signature-box">
                            <img src="{{ $member['digitalSignature'] }}" style="width: 50px; height: 30px; object-fit: contain;" />
                        </div>
                    @else
                        <div class="signature-box">স্বাক্ষর</div>
                    @endif
                </td>
            </tr>
            @endforeach
            
            {{-- Empty rows if no members --}}
            @if(empty($application->members))
                @for($i = 1; $i <= 5; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td><div class="photo-box">ছবি</div></td>
                    <td>
                        <div class="member-details">
                            <div class="member-field">
                                <span class="field-label">নাম:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">পিতা:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">মাতা:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">ঠিকানা:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">NID:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">মোবাইল:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">রক্তের গ্রুপ:</span>
                                <span class="field-value"> ___________________</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">সদস্য আইডি:</span>
                                <span class="field-value"> _________________________</span>
                            </div>
                        </div>
                    </td>
                    <td>_________________</td>
                    <td>_________________</td>
                    <td><div class="signature-box">স্বাক্ষর</div></td>
                </tr>
                @endfor
            @endif
        </tbody>
    </table>
</div>

<!-- Fee Information -->
@if(!empty($application->total_fee))
<div class="fee-section">
    <div class="fee-title">পেমেন্ট তথ্য</div>
    <div class="fee-row">
        <span class="fee-label">মোট ফি:</span>
        <span class="fee-amount">৳{{ number_format($application->total_fee, 2) }}</span>
    </div>
    <div class="fee-row">
        <span class="fee-label">আবেদনের স্থিতি:</span>
        <span class="status-badge status-{{ $application->status ?? 'pending' }}">
            {{ strtoupper($application->status ?? 'pending') }}
        </span>
    </div>
</div>
@endif

<!-- Signature Section -->
<div class="signature-section">
    <div class="signature-column">
        <div class="signature-role">সভাপতি</div>
        <div class="signature-line"></div>
        <div class="signature-org">বাংলাদেশ মানবাধিকার পরিষদ</div>
    </div>
    <div class="signature-column">
        <div class="signature-role">সাধারণ সম্পাদক</div>
        <div class="signature-line"></div>
        <div class="signature-org">বাংলাদেশ মানবাধিকার পরিষদ</div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <div>Serial No: #{{ $application->id ?? 'N/A' }} | তারিখ: {{ $application->created_at?->format('d F, Y') ?? now()->format('d F, Y') }} | পৃষ্ঠা ১</div>
    <div style="margin-top: 5px; font-size: 7pt;">এই নথিটি BDHRP অফিসিয়াল সিস্টেম কর্তৃক স্বয়ংক্রিয়ভাবে তৈরি</div>
</div>

</body>
</html>
