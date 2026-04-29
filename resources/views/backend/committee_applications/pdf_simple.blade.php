<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: 'notobengali', sans-serif;
    font-size: 12pt;
    padding: 20px;
}
.header {
    text-align: center;
    margin-bottom: 20px;
}
.title {
    font-size: 16pt;
    font-weight: bold;
    margin: 10px 0;
}
.info-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.info-table td {
    border: 1px solid #000;
    padding: 5px;
}
.info-table td.label {
    font-weight: bold;
    background: #f0f0f0;
}
.members-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
.members-table th, .members-table td {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
}
.members-table th {
    background: #006039;
    color: white;
}
</style>
</head>
<body>

<div class="header">
    <div class="title">বাংলাদেশ মানবাধিকার পরিষদ</div>
    <div>গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কর্তৃক অনুমোদিত</div>
    <div class="title">{{ $application->committee_type ?? 'কমিটি সদস্য ফরম' }}</div>
</div>

<table class="info-table">
    <tr>
        <td class="label">কমিটির ধরন</td>
        <td>{{ $application->committee_type ?? '' }}</td>
        <td class="label">বিভাগ</td>
        <td>{{ $application->division ?? '' }}</td>
    </tr>
    <tr>
        <td class="label">জেলা</td>
        <td>{{ $application->district ?? '' }}</td>
        <td class="label">উপজেলা</td>
        <td>{{ $application->thana ?? '' }}</td>
    </tr>
    <tr>
        <td class="label">ইউনিয়ন</td>
        <td>{{ $application->union ?? '' }}</td>
        <td class="label">এলাকা</td>
        <td>{{ $application->area ?? '' }}</td>
    </tr>
</table>

<table class="members-table">
    <thead>
        <tr>
            <th>ক্রমিক</th>
            <th>নাম</th>
            <th>পিতা</th>
            <th>মাতা</th>
            <th>ফোন</th>
            <th>NID</th>
            <th>রক্তের গ্রুপ</th>
            <th>পদবী</th>
        </tr>
    </thead>
    <tbody>
        @php $serial = 1; @endphp
        @foreach ($application->members ?? [] as $member)
        <tr>
            <td>{{ $serial++ }}</td>
            <td>{{ $member['name'] ?? '' }}</td>
            <td>{{ $member['father'] ?? '' }}</td>
            <td>{{ $member['mother'] ?? '' }}</td>
            <td>{{ $member['phone'] ?? '' }}</td>
            <td>{{ $member['nid'] ?? '' }}</td>
            <td>{{ $member['bloodGroup'] ?? '' }}</td>
            <td>{{ $member['role'] ?? '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div style="margin-top: 30px; text-align: center;">
    <p><strong>মোট ফি: ৳{{ number_format($application->total_fee ?? 0, 2) }}</strong></p>
    <p>স্থিতি: {{ strtoupper($application->status ?? 'pending') }}</p>
    <p>তারিখ: {{ $application->created_at?->format('d F, Y') ?? now()->format('d F, Y') }}</p>
</div>

</body>
</html>
