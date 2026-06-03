<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export User</title>
    <style>
        @page { margin: 210px 34px 70px 34px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #0f172a; }
        .header { position: fixed; top: -190px; left: 0; right: 0; height: 190px; }
        .brand { width: 100%; }
        .brand td { vertical-align: middle; }
        .logo { width: 100px; height: 100px; overflow: hidden; }
        .logo img { width: 100%; height: 100%; object-fit: contain; }
        .kop { text-align: center; line-height: 1.15; padding-right: 40px; }
        .kop-1 { font-size: 15px; font-weight: 800; letter-spacing: .04em; }
        .kop-2 { font-size: 19px; font-weight: 900; letter-spacing: .04em; }
        .kop-3 { margin-top: 4px; font-size: 13px; font-weight: 800; }
        .kop-4 { margin-top: 4px; font-size: 10px; color: #334155; }
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
        .badge-admin { background: #fef2f2; border-color: #fecaca; color: #991b1b; }
        .badge-staff { background: #f0f9ff; border-color: #bae6fd; color: #075985; }
        .badge-mahasiswa { background: #ecfdf5; border-color: #a7f3d0; color: #065f46; }
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
    <div class="doc-title">REKAP DATA USER</div>
    <div class="filters">
        Filter: Pencarian: {{ $q !== '' ? $q : '—' }} | Role: {{ $role !== '' ? ucfirst($role) : 'Semua Role' }}<br>
        Dicetak: {{ $generatedAt->format('d/m/Y H:i') }}&nbsp;WIB | Total data: {{ $items->count() }}
    </div>
</div>

<table class="data zebra">
    <colgroup>
        <col style="width:4%">
        <col style="width:18%">
        <col style="width:20%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:12%">
        <col style="width:10%">
    </colgroup>
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Password</th>
        <th>Role</th>
        <th>NIM / Phone</th>
        <th>Login Terakhir</th>
        <th>Daftar</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $i => $user)
        @php
            $badgeClass = match($user->role) {
                'admin' => 'badge-admin',
                'staf' => 'badge-staff',
                default => 'badge-mahasiswa',
            };
        @endphp
        <tr>
            <td>{{ $i + 1 }}</td>
            <td class="wrap">
                <div style="font-weight:800;">{{ $user->name }}</div>
            </td>
            <td class="wrap">{{ $user->email }}</td>
            <td class="wrap" style="font-family: monospace; font-size: 9px;">
                @if($user->password_plain)
                    <span style="font-weight: bold; color: #047857;">{{ $user->password_plain }}</span>
                @else
                    <span style="color: #94a3b8;">—</span>
                @endif
            </td>
            <td>
                <span class="badge {{ $badgeClass }}">{{ ucfirst($user->role) }}</span>
            </td>
            <td class="wrap">
                <div class="muted">NIM: {{ $user->nim ?: '-' }}</div>
                <div class="muted">Telp: {{ $user->phone ?: '-' }}</div>
            </td>
            <td class="wrap">
                {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') . ' WIB' : '—' }}
            </td>
            <td class="wrap">
                {{ $user->created_at?->format('d/m/Y') }}
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
