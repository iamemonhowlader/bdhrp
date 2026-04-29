<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: Arial, sans-serif;
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
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}
table td, table th {
    border: 1px solid #000;
    padding: 5px;
    text-align: left;
}
table th {
    background: #f0f0f0;
    font-weight: bold;
}
</style>
</head>
<body>

<div class="header">
    <div class="title">বাংলাদেশ মানবাধিকার পরিষদ</div>
    <div>{{ $application->committee_type ?? 'কমিটি সদস্য ফরম' }}</div>
</div>

<table>
    <tr>
        <th>কমিটির ধরন</th>
        <td>{{ $application->committee_type ?? '' }}</td>
        <th>বিভাগ</th>
        <td>{{ $application->division ?? '' }}</td>
    </tr>
    <tr>
        <th>জেলা</th>
        <td>{{ $application->district ?? '' }}</td>
        <th>উপজেলা</th>
        <td>{{ $application->thana ?? '' }}</td>
    </tr>
    <tr>
        <th>ইউনিয়ন</th>
        <td>{{ $application->union ?? '' }}</td>
        <th>এলাকা</th>
        <td>{{ $application->area ?? '' }}</td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>ক্রমিক</th>
            <th>নাম</th>
            <th>পিতা</th>
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
