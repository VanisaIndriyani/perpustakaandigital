<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export Mahasiswa</title>
    <style>
        @page { margin: 210px 34px 70px 34px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #0f172a; }
        .header { position: fixed; top: -190px; left: 0; right: 0; height: 190px; }
        .brand { width: 100%; }
        .brand td { vertical-align: middle; }
        .logo { width: 86px; height: 86px; overflow: hidden; }
        .logo img { width: 100%; height: 100%; object-fit: contain; }
        .kop { text-align: center; line-height: 1.15; }
        .kop-1 { font-size: 13px; font-weight: 800; letter-spacing: .04em; }
        .kop-2 { font-size: 16px; font-weight: 900; letter-spacing: .04em; }
        .kop-3 { margin-top: 3px; font-size: 11px; font-weight: 800; }
        .kop-4 { margin-top: 3px; font-size: 9px; color: #334155; }
        .rule { margin-top: 6px; }
        .rule-1 { border-top: 2px solid #111827; }
        .rule-2 { border-top: 1px solid #94a3b8; margin-top: 2px; }
        .doc-title { margin-top: 10px; text-align: center; font-size: 12px; font-weight: 900; letter-spacing: .08em; }
        .filters { margin-top: 6px; font-size: 9px; color: #475569; }
        .data { width: 100%; border-collapse: collapse; table-layout: fixed; }
        .data th { background: #f1f5f9; color: #334155; font-size: 9px; text-transform: uppercase; letter-spacing: .06em; padding: 8px 8px; border: 1px solid #e2e8f0; text-align: left; }
        .data td { padding: 8px 8px; border: 1px solid #e2e8f0; vertical-align: top; }
        .muted { color: #64748b; font-size: 9px; }
        .wrap { overflow-wrap: break-word; word-wrap: break-word; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 9px; font-weight: 800; border: 1px solid #e2e8f0; background: #fff; color: #0f172a; }
        .badge-active { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; }
        .badge-never { background: #fffbeb; border-color: #fde68a; color: #92400e; }
        .badge-ever { background: #f1f5f9; border-color: #e2e8f0; color: #334155; }
        .zebra tbody tr:nth-child(even) td { background: #fafafa; }
        .footer { position: fixed; bottom: -50px; left: 0; right: 0; height: 50px; border-top: 1px solid #e2e8f0; padding-top: 10px; color: #64748b; font-size: 10px; }
        .footer-table { width: 100%; }
        .footer-table td:last-child { text-align: right; }
    </style>
</head>
<body>
<div class="header">
    <table class="brand">
        <tr>
            <td style="width:100px;">
                <div class="logo">
                    @if($logoDataUri)
                        <img src="{{ $logoDataUri }}" alt="Logo">
                    @endif
                </div>
            </td>
            <td class="kop">
                <div class="kop-1">INSTITUT AGAMA ISLAM</div>
                <div class="kop-2">DARUD DA'WAH WAL IRSYAD</div>
                <div class="kop-3">SIDERENG RAPPANG</div>
                <div class="kop-4">TERAKREDITASI INSTITUSI : SK : 576/SK/BAN-PT/Akred/PT/IV/2021</div>
                <div class="kop-4">Alamat : Jl. Tugu Tani Kel. Majelling Watang Sidenreng Rappang</div>
                <div class="kop-4">E-mail : iaiddisidrap@gmail.com Website : www.ypdisrappang.ac.id</div>
            </td>
            <td style="width:100px;"></td>
        </tr>
    </table>
    <div class="rule">
        <div class="rule-1"></div>
        <div class="rule-2"></div>
    </div>
    <div class="doc-title">REKAP DATA MAHASISWA</div>
    <div class="filters">
        Filter: Pencarian: {{ $q !== '' ? $q : '—' }}<br>
        Ringkasan: Total {{ $summary['total'] ?? 0 }} | Pernah login {{ $summary['logged_in'] ?? 0 }} | Belum login {{ $summary['never_login'] ?? 0 }} | Aktif 7 hari {{ $summary['active_7d'] ?? 0 }}<br>
        Dicetak: {{ $generatedAt->format('d/m/Y H:i') }}&nbsp;WIB | Total data: {{ $items->count() }}
    </div>
</div>

<table class="data zebra">
    <colgroup>
        <col style="width:4%">
        <col style="width:18%">
        <col style="width:12%">
        <col style="width:20%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:10%">
    </colgroup>
    <thead>
    <tr>
        <th>No</th>
        <th>Mahasiswa</th>
        <th>NIM</th>
        <th>Email</th>
        <th>No HP</th>
        <th>Daftar</th>
        <th>Login</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $i => $mhs)
        @php
            $never = is_null($mhs->last_login_at);
            $recent = $mhs->last_login_at && $mhs->last_login_at->greaterThanOrEqualTo(now()->subDays(7));
            $badgeClass = $never ? 'badge-never' : ($recent ? 'badge-active' : 'badge-ever');
            $statusLabel = $never ? 'Belum Login' : ($recent ? 'Aktif' : 'Pernah Login');
        @endphp
        <tr>
            <td>{{ $i + 1 }}</td>
            <td class="wrap">
                <div style="font-weight:800;">{{ $mhs->name }}</div>
            </td>
            <td class="wrap">{{ $mhs->nim ?: '—' }}</td>
            <td class="wrap">{{ $mhs->email }}</td>
            <td class="wrap">{{ $mhs->phone ?: '—' }}</td>
            <td class="wrap">
                {{ $mhs->created_at?->format('d/m/Y H:i') }}&nbsp;WIB
            </td>
            <td class="wrap">
                {{ $mhs->last_login_at ? $mhs->last_login_at->format('d/m/Y H:i') . ' WIB' : '—' }}
            </td>
            <td>
                <span class="badge {{ $badgeClass }}">{{ $statusLabel }}</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>© {{ $generatedAt->format('Y') }} Repository IAI DDI Sidenreng Rappang</td>
            <td>
                <script type="text/php">
                    if (isset($pdf)) {
                        $pdf->page_text(520, 26, "Hal {PAGE_NUM} / {PAGE_COUNT}", null, 9, array(100,116,139));
                    }
                </script>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
