<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: 'notobengali', sans-serif;
    font-size: 11pt;
    color: #000;
    line-height: 1.4;
    padding: 20px;
}

/* Header Styles */
.header {
    text-align: center;
    border-bottom: 2px solid #006039;
    padding-bottom: 15px;
    margin-bottom: 20px;
}

.org-name {
    font-size: 16pt;
    font-weight: bold;
    color: #006039;
    margin-bottom: 5px;
}

.org-sub {
    font-size: 9pt;
    color: #444;
    margin-bottom: 5px;
}

.reg-no {
    font-size: 8pt;
    color: #666;
    font-weight: bold;
}

.title {
    font-size: 14pt;
    font-weight: bold;
    color: #000;
    margin-top: 15px;
    padding: 8px;
    background: #f0faf4;
    border: 2px solid #006039;
    text-align: center;
    text-decoration: underline;
}

/* Info Box Styles */
.info-box {
    border: 2px solid #006039;
    padding: 10px;
    margin-bottom: 20px;
    background: #fafafa;
}

.info-row {
    display: flex;
    margin-bottom: 8px;
    border-bottom: 1px solid #e0e0e0;
    padding-bottom: 5px;
}

.info-row:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.info-col {
    flex: 1;
    display: flex;
}

.info-label {
    font-weight: bold;
    color: #006039;
    min-width: 80px;
    font-size: 9pt;
}

.info-value {
    color: #000;
    border-bottom: 1px dotted #666;
    flex: 1;
    margin-left: 8px;
    min-height: 14px;
}

/* Table Styles */
.members-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
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

.member-info {
    text-align: left;
    margin-bottom: 2px;
    line-height: 1.2;
}

.member-label {
    font-weight: bold;
    color: #006039;
    font-size: 7.5pt;
}

.member-value {
    color: #000;
    font-size: 7.5pt;
}

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

/* Payment Section */
.payment-section {
    border: 2px solid #006039;
    padding: 10px;
    margin-bottom: 20px;
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

/* Signature Section */
.signature-section {
    display: flex;
    gap: 20px;
    margin-bottom: 20px;
    border: 2px solid #006039;
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

/* Footer */
.footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 2px solid #006039;
    padding-top: 10px;
    font-size: 8pt;
    color: #666;
}

/* Status Badge */
.status-badge {
    padding: 2px 6px;
    border-radius: 10px;
    font-size: 7pt;
    font-weight: bold;
    text-transform: uppercase;
}

.status-pending { background: #fef3c7; color: #92400e; border: 1px solid #f59e0b; }
.status-approved { background: #d1fae5; color: #065f46; border: 1px solid #22c55e; }
.status-rejected { background: #fee2e2; color: #991b1b; border: 1px solid #ef4444; }
</style>
</head>
<body>

<!-- Header -->
<div class="header">
    <div class="org-name">বাংলাদেশ মানবাধিকার পরিষদ</div>
    <div class="org-sub">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কর্তৃক অনুমোদিত ও স্বীকৃতি প্রাপ্ত</div>
    <div class="reg-no">গভঃ রেজিঃ নং-ম-০৮১০২/০৭</div>
    <div class="title">
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

<!-- Committee Members Table -->
<table class="members-table">
    <thead>
        <tr>
            <th style="width:6%">ক্রমিক</th>
            <th style="width:8%">ছবি</th>
            <th style="width:42%">সদস্যের বিবরণ</th>
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
                    <div class="photo-placeholder">
                        <img src="{{ $member['photo'] }}" style="width: 30px; height: 35px; object-fit: cover;" />
                    </div>
                @else
                    <div class="photo-placeholder">ছবি</div>
                @endif
            </td>
            <td>
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
            </td>
            <td>{{ $member['role'] ?? '' }}</td>
            <td>{{ $member['bloodGroup'] ?? '' }}</td>
            <td>
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
            </td>
        </tr>
        @endforeach
        
        {{-- Empty rows if no members --}}
        @if(empty($application->members))
            @for($i = 1; $i <= 5; $i++)
            <tr>
                <td>{{ $i }}</td>
                <td><div class="photo-placeholder">ছবি</div></td>
                <td>
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
                        <span class="member-label">সদস্য আইডি:</span>
                        <span class="member-value"> _________________________</span>
                    </div>
                </td>
                <td>_________________</td>
                <td>_________________</td>
                <td><div class="sign-placeholder">স্বাক্ষর</div></td>
            </tr>
            @endfor
        @endif
    </tbody>
</table>

<!-- Payment Information -->
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

<!-- Signature Section -->
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

<!-- Footer -->
<div class="footer">
    <div>Serial No: #{{ $application->id ?? 'N/A' }}</div>
    <div>Page 1</div>
    <div>তারিখ: {{ $application->created_at?->format('d F, Y') ?? now()->format('d F, Y') }}</div>
</div>

</body>
</html>
