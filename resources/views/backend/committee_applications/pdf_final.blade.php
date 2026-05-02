<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>বাংলাদেশ মানবাধিকার পরিষদ</title>

    <style>
        /* ─── Page / Body ─────────────────────────────────── */
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: 'notobengali', 'solaimanlipi', 'Siyam Rupali', 'Vrinda', Arial, sans-serif;
            font-size: 12pt;
            color: #000;
            line-height: 1.4;
            margin: 20px;
            background: white;
        }

        /* ─── WATERMARK ───────────────────────── */
        .watermark {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: -1000;
            pointer-events: none;
        }

        .watermark img {
            width: 420px;
            height: 420px;
            opacity: 0.08;
            transform: rotate(-35deg);
            object-fit: contain;
        }

        /* ─── Layout ───────────────────────────────────────── */
        .container {
            width: 100%;
            position: relative;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .no-border td { border: none; }

        /* ─── Header ─────────────────────────────────────── */
        .header-bg {
            background-color: rgb(202, 237, 251);
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        /* ─── Committee Table ────────────────────────────── */
        .committee-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        .committee-table thead tr {
            background-color: #333;
            color: #fff;
        }

        .committee-table th {
            padding: 7px 6px;
            border: 1px solid #999;
            text-align: center;
            font-size: 12px;
        }

        .committee-table td {
            border: 1px solid #999;
            vertical-align: top;
            padding: 5px 6px;
        }

        .committee-table .serial {
            text-align: center;
            font-weight: bold;
            vertical-align: middle;
            font-size: 13px;
        }

        .committee-table .name-cell {
            line-height: 1.8;
        }

        .committee-table .name-cell span {
            color: #333;
        }

        .committee-table .designation {
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            font-size: 12px;
        }

        .committee-table .photo-cell,
        .committee-table .sign-cell {
            min-height: 80px;
            height: 100px;
            text-align: center;
            vertical-align: middle;
        }

        .committee-table .id-cell {
            text-align: center;
            vertical-align: middle;
            font-weight: bold;
            font-size: 11px;
            color: #444;
        }

        /* ─── Footer ─────────────────────────────────────── */
        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    @php
        if (!function_exists('local_bangla_number')) {
            function local_bangla_number($number) {
                $eng = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $bng = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                return str_replace($eng, $bng, $number);
            }
        }
    @endphp

    <div class="watermark">
        @if(file_exists(public_path('images/logo.png')))
            <img src="{{ public_path('images/logo.png') }}" alt="watermark logo">
        @endif
    </div>

    <div class="container">

        <!-- ── HEADER ────────────────────────────────── -->
        <table class="header-bg">
            <tr>
                <td style="width:100px; vertical-align:middle;">
                    @if(file_exists(public_path('images/logo.png')))
                        <img src="{{ public_path('images/logo.png') }}"
                             height="80" width="80"
                             style="display:block; object-fit:contain;"
                             alt="logo">
                    @endif
                </td>

                <td style="text-align:center; vertical-align:middle;">
                    <div style="font-size:30px; font-weight:bold; color:rgb(21,96,130);">
                        বাংলাদেশ মানবাধিকার পরিষদ
                    </div>
                    <div style="color:rgb(194,82,82); font-size:13px; margin-top:4px;">
                        গণপ্রজাতন্ত্রী বাংলাদেশ সরকার কর্তৃক অনুমোদিত ও স্বীকৃতি প্রাপ্ত, রেজিঃ নং-X-08102/07
                    </div>
                    <div style="font-size:13px; margin-top:4px;">
                        জেলা কার্যালয়ঃ ------------------------------ বাংলাদেশ
                    </div>
                    <div style="font-size:13px; margin-top:2px;">
                        মোবাইলঃ --------------------------
                    </div>
                </td>
            </tr>
        </table>

        <br>

        <div style="text-align:center; font-size:16px; font-weight:bold; margin: 16px 0 10px 0;">
            ৫১ সদস্য বিশিষ্ট পূর্ণাঙ্গ
            @if(!empty($application->committee_type))
                @switch($application->committee_type)
                    @case('union') ইউনিয়ন @break
                    @case('ward') ওয়ার্ড @break
                    @case('city') সিটি @break
                    @case('thana') থানা @break
                    @case('district') জেলা @break
                    @default
                @endswitch
            @endif
            কমিটির পদ বিন্যাস
        </div>

        <table style="width: 100%; margin-bottom: 20px; font-size: 12px;">
            <tr>
                <td width="50%">
                    <strong>বিভাগ:</strong> {{ $application->division ?? '________________' }}<br>
                    <strong>জেলা:</strong> {{ $application->district ?? '________________' }}<br>
                    <strong>থানা/উপজেলা:</strong> {{ $application->thana ?? '________________' }}
                </td>
                <td width="50%">
                    <strong>ইউনিয়ন:</strong> {{ $application->union ?? '________________' }}<br>
                    <strong>গ্রাম/এলাকা:</strong> {{ $application->area ?? '________________' }}<br>
                    <strong>ওয়ার্ড:</strong> {{ $application->ward ?? '________________' }}
                </td>
            </tr>
        </table>

        <table class="committee-table">
            <thead>
                <tr>
                    <th style="width:7%;">ক্রমিক</th>
                    <th style="width:32%;">নাম</th>
                    <th style="width:14%;">পদবী</th>
                    <th style="width:15%;">ফটো</th>
                    <th style="width:15%;">স্বাক্ষর</th>
                    <th style="width:17%;">ID-No</th>
                </tr>
            </thead>
            <tbody>
                @php $serial = 1; @endphp
                @foreach ($application->applicationMembers as $member)
                <tr>
                    <td>{{ $serial++ }}</td>
                    <td>
                        @if (!empty($member->photo_path))
                            <div class="photo-box">
                                <img src="{{ $member->photo_path }}" style="width: 35px; height: 40px; object-fit: cover;" />
                            </div>
                        @else
                            <div class="photo-box">ছবি</div>
                        @endif
                    </td>
                    <td>
                        <div class="member-details">
                            <div class="member-field">
                                <span class="field-label">নাম:</span>
                                <span class="field-value"> {{ $member->name ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">পিতা:</span>
                                <span class="field-value"> {{ $member->father ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">মাতা:</span>
                                <span class="field-value"> {{ $member->mother ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">ঠিকানা:</span>
                                <span class="field-value"> {{ $member->address ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">NID:</span>
                                <span class="field-value"> {{ $member->nid ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">মোবাইল:</span>
                                <span class="field-value"> {{ $member->phone ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">রক্তের গ্রুপ:</span>
                                <span class="field-value"> {{ $member->blood_group ?? '' }}</span>
                            </div>
                            <div class="member-field">
                                <span class="field-label">সদস্য আইডি:</span>
                                <span class="field-value"> {{ $member->member_id ?? '' }}</span>
                            </div>
                        </div>
                    </td>
                    <td>{{ $member->role ?? '' }}</td>
                    <td>{{ $member->blood_group ?? '' }}</td>
                    <td>
                        @if (!empty($member->signature_path))
                            <div class="signature-box">
                                <img src="{{ $member->signature_path }}" style="width: 50px; height: 30px; object-fit: contain;" />
                            </div>
                        @else
                            <div class="signature-box">স্বাক্ষর</div>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- ── FOOTER ─────────────────────────────────── -->
        <div class="footer">
            <div>Serial No: #{{ $application->id ?? 'N/A' }} | তারিখ: {{ $application->created_at?->format('d F, Y') ?? now()->format('d F, Y') }}</div>
            <div style="margin-top: 5px;">এই নথিটি BDHRP অফিসিয়াল সিস্টেম কর্তৃক স্বয়ংক্রিয়ভাবে তৈরি</div>
        </div>

    </div>

</body>
</html>
