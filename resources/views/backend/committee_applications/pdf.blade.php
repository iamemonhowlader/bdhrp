<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'notobengali', 'dejavusans', sans-serif;
    font-size: 9pt;
    color: #111;
    line-height: 1.5;
}

/* ======= HEADER ======= */
.header-wrap {
    text-align: center;
    border-bottom: 3px double #006039;
    padding-bottom: 8px;
    margin-bottom: 10px;
}
.org-logo {
    font-size: 15pt;
    font-weight: bold;
    color: #006039;
}
.org-sub {
    font-size: 8.5pt;
    color: #444;
    margin-top: 2px;
}
.doc-title {
    font-size: 12pt;
    font-weight: bold;
    color: #111;
    margin-top: 6px;
    text-decoration: underline;
    letter-spacing: 0.5px;
}
.doc-date {
    font-size: 8pt;
    color: #555;
    margin-top: 2px;
}

/* ======= INFO TABLE ======= */
table.info-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}
table.info-table td {
    padding: 4px 7px;
    font-size: 8.5pt;
    border: 1px solid #ccc;
}
table.info-table td.label {
    background: #f0faf4;
    font-weight: bold;
    width: 20%;
    color: #006039;
}
table.info-table td.value {
    width: 30%;
}

/* ======= SECTION HEADER ======= */
.section-bar {
    background: #006039;
    color: #fff;
    font-weight: bold;
    font-size: 9.5pt;
    padding: 5px 10px;
    margin-bottom: 0;
}

/* ======= MEMBERS TABLE ======= */
table.members {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 12px;
}
table.members thead tr {
    background: #006039;
    color: #fff;
}
table.members thead th {
    padding: 5px 5px;
    font-size: 8pt;
    text-align: center;
    border: 1px solid #004d2e;
    font-weight: bold;
}
table.members tbody tr:nth-child(even) { background: #f0faf4; }
table.members tbody tr:nth-child(odd)  { background: #ffffff; }
table.members tbody td {
    padding: 4px 5px;
    font-size: 8pt;
    border: 1px solid #c8e6d6;
    vertical-align: middle;
    text-align: center;
}
table.members tbody td.left { text-align: left; }
table.members tbody td.role { color: #006039; font-weight: bold; text-align: left; }
table.members tbody td.name { font-weight: bold; text-align: left; }
table.members .photo-box {
    width: 32px;
    height: 38px;
    border: 1px solid #ccc;
    background: #f3f4f6;
    display: inline-block;
    overflow: hidden;
}
table.members .photo-box img {
    width: 32px;
    height: 38px;
    object-fit: cover;
}
table.members .sig-box {
    width: 50px;
    height: 22px;
    border-bottom: 1px solid #555;
    display: inline-block;
    overflow: hidden;
}
table.members .sig-box img {
    width: 50px;
    height: 22px;
    object-fit: contain;
}

/* ======= BOTTOM SECTION ======= */
table.bottom-wrap {
    width: 100%;
    border-collapse: collapse;
    margin-top: 12px;
}

/* --- Fee Box --- */
table.fee-table {
    width: 100%;
    border-collapse: collapse;
    border: 2px solid #006039;
    border-radius: 4px;
}
table.fee-table thead th {
    background: #006039;
    color: #fff;
    padding: 5px 8px;
    font-size: 9pt;
    font-weight: bold;
}
table.fee-table tbody td {
    padding: 4px 8px;
    font-size: 8.5pt;
    border-bottom: 1px solid #d1fae5;
}
table.fee-table tbody td.amount {
    text-align: right;
    font-weight: bold;
}
table.fee-table tfoot td {
    padding: 6px 8px;
    font-size: 10pt;
    font-weight: bold;
    color: #006039;
    border-top: 2px solid #006039;
}
table.fee-table tfoot td.amount {
    text-align: right;
}

/* --- Signature Area --- */
table.sig-area {
    width: 100%;
    border-collapse: collapse;
}
table.sig-area td {
    width: 33%;
    text-align: center;
    padding: 4px 10px;
    vertical-align: bottom;
}
.sig-line {
    border-top: 1px solid #333;
    padding-top: 3px;
    font-size: 8pt;
    color: #444;
}

/* ======= STATUS BADGE ======= */
.badge-pending  { background: #f59e0b; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; font-weight: bold; }
.badge-approved { background: #22c55e; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; font-weight: bold; }
.badge-rejected { background: #ef4444; color: #fff; padding: 2px 8px; border-radius: 10px; font-size: 7.5pt; font-weight: bold; }

/* ======= FOOTER ======= */
.footer {
    margin-top: 14px;
    border-top: 1px solid #ccc;
    padding-top: 4px;
    text-align: center;
    font-size: 7pt;
    color: #999;
}
</style>
</head>
<body>

{{-- ===== HEADER ===== --}}
<div class="header-wrap">
    <div class="org-logo">Bangladesh Human Rights Protection Council (BDHRP)</div>
    <div class="org-sub">বাংলাদেশ মানবাধিকার সুরক্ষা পরিষদ &bull; নিবন্ধন নং: ——</div>
    <div class="doc-title">কমিটির পদ বিন্যাস ও সদস্য তালিকা</div>
    <div class="doc-date">তারিখ: {{ $application->created_at->format('d F, Y') }}</div>
</div>

{{-- ===== COMMITTEE INFO ===== --}}
<table class="info-table">
    <tr>
        <td class="label">কমিটির ধরন</td>
        <td class="value">{{ $application->committee_type }}</td>
        <td class="label">বিভাগ</td>
        <td class="value">{{ $application->division ?? '—' }}</td>
    </tr>
    <tr>
        <td class="label">জেলা</td>
        <td class="value">{{ $application->district ?? '—' }}</td>
        <td class="label">উপজেলা / থানা</td>
        <td class="value">{{ $application->thana ?? '—' }}</td>
    </tr>
    <tr>
        <td class="label">ইউনিয়ন</td>
        <td class="value">{{ $application->union ?? '—' }}</td>
        <td class="label">ওয়ার্ড</td>
        <td class="value">{{ $application->ward ?? '—' }}</td>
    </tr>
    <tr>
        <td class="label">পৌরসভা</td>
        <td class="value">{{ $application->pouroshova ?? '—' }}</td>
        <td class="label">গ্রাম / এলাকা</td>
        <td class="value">{{ $application->area ?? '—' }}</td>
    </tr>
    <tr>
        <td class="label">মোট সদস্য</td>
        <td class="value">{{ count($application->members ?? []) }} জন</td>
        <td class="label">আবেদনের স্থিতি</td>
        <td class="value">
            <span class="badge-{{ $application->status }}">{{ strtoupper($application->status) }}</span>
        </td>
    </tr>
</table>

{{-- ===== MEMBERS TABLE ===== --}}
<div class="section-bar">কমিটির সদস্য তালিকা</div>
<table class="members">
    <thead>
        <tr>
            <th style="width:4%">#</th>
            <th style="width:5%">ছবি</th>
            <th style="width:15%">পদবি</th>
            <th style="width:16%">পূর্ণ নাম</th>
            <th style="width:13%">পিতার নাম</th>
            <th style="width:11%">NID নং</th>
            <th style="width:10%">ফোন</th>
            <th style="width:7%">রক্তের গ্রুপ</th>
            <th style="width:11%">সদস্য আইডি</th>
            <th style="width:8%">স্বাক্ষর</th>
        </tr>
    </thead>
    <tbody>
        @php $serial = 1; @endphp
        @foreach ($application->members ?? [] as $member)
        <tr>
            <td>{{ $serial++ }}</td>
            <td>
                @if (!empty($member['photo']))
                    <div class="photo-box"><img src="{{ $member['photo'] }}" /></div>
                @else
                    <div class="photo-box" style="font-size:6pt;line-height:38px;color:#aaa;">N/A</div>
                @endif
            </td>
            <td class="role">{{ $member['role'] ?? '—' }}</td>
            <td class="name">{{ $member['name'] ?? '—' }}</td>
            <td class="left">{{ $member['father'] ?? '—' }}</td>
            <td>{{ $member['nid'] ?? '—' }}</td>
            <td>{{ $member['phone'] ?? '—' }}</td>
            <td>{{ $member['bloodGroup'] ?? '—' }}</td>
            <td style="font-size:7pt;">{{ $member['memberId'] ?? '—' }}</td>
            <td>
                @if (!empty($member['signatureImage']))
                    <div class="sig-box"><img src="{{ $member['signatureImage'] }}" /></div>
                @elseif (!empty($member['digitalSignature']))
                    <div class="sig-box"><img src="{{ $member['digitalSignature'] }}" /></div>
                @else
                    <div class="sig-box"></div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- ===== BOTTOM: SIGNATURE + FEE ===== --}}
<table class="bottom-wrap">
<tr>
    <td style="width:60%;vertical-align:bottom;padding-right:12px;">
        <table class="sig-area">
            <tr>
                <td>
                    <div style="height:40px;"></div>
                    <div class="sig-line">আবেদনকারীর স্বাক্ষর</div>
                </td>
                <td>
                    <div style="height:40px;"></div>
                    <div class="sig-line">যাচাইকারীর স্বাক্ষর</div>
                </td>
                <td>
                    <div style="height:40px;"></div>
                    <div class="sig-line">অনুমোদনকারীর স্বাক্ষর ও সিল</div>
                </td>
            </tr>
        </table>
    </td>
    <td style="width:40%;vertical-align:top;">
        @php
            $roleCount = collect($application->members ?? [])->groupBy('role');
            $fees = [
                'সভাপতি'       => 20000,
                'সেক্রেটারি'   => 15000,
                'সহ-সভাপতি'    => 10000,
                'সহ-সেক্রেটারি'=> 8000,
                'সদস্য'        => 5000,
            ];
        @endphp
        <table class="fee-table">
            <thead>
                <tr><th colspan="2">ফি সারসংক্ষেপ</th></tr>
            </thead>
            <tbody>
                @foreach($roleCount as $role => $members)
                <tr>
                    <td>{{ $role }} ({{ count($members) }}জন)</td>
                    <td class="amount">৳ {{ number_format(($fees[$role] ?? 3000) * count($members)) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>সর্বমোট</td>
                    <td class="amount">৳ {{ number_format($application->total_fee, 0) }}</td>
                </tr>
            </tfoot>
        </table>
    </td>
</tr>
</table>

{{-- ===== FOOTER ===== --}}
<div class="footer">
    এই নথিটি BDHRP অফিসিয়াল সিস্টেম কর্তৃক স্বয়ংক্রিয়ভাবে তৈরি &bull; আবেদন আইডি: #{{ $application->id }} &bull; {{ now()->format('d/m/Y H:i') }}
</div>

</body>
</html>
