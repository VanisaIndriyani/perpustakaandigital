<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export Peminjaman</title>
    <style>
        @page {
            margin: 210px 34px 70px 34px;
        }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #0f172a;
        }
        .header {
            position: fixed;
            top: -190px;
            left: 0;
            right: 0;
            height: 190px;
        }
        .brand {
            width: 100%;
        }
        .brand td {
            vertical-align: middle;
        }
        .logo {
            width: 72px;
            height: 72px;
            overflow: hidden;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        .kop {
            text-align: center;
            line-height: 1.2;
        }
        .kop-1 {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
        }
        .kop-2 {
            font-size: 14px;
            font-weight: 800;
            letter-spacing: .04em;
        }
        .kop-3 {
            margin-top: 3px;
            font-size: 10px;
            font-weight: 700;
        }
        .kop-4 {
            margin-top: 3px;
            font-size: 9px;
            color: #334155;
        }
        .rule {
            margin-top: 6px;
        }
        .rule-1 {
            border-top: 2px solid #111827;
        }
        .rule-2 {
            margin-top: 2px;
            border-top: 1px solid #111827;
        }
        .doc-title {
            margin-top: 6px;
            text-align: center;
            font-size: 11px;
            font-weight: 800;
            letter-spacing: .06em;
        }
        .filters {
            margin-top: 6px;
            font-size: 9px;
            color: #475569;
        }
        .title {
            font-size: 16px;
            font-weight: 700;
            margin: 0;
        }
        .subtitle {
            font-size: 11px;
            color: #475569;
            margin: 2px 0 0 0;
        }
        .meta {
            text-align: right;
            color: #475569;
            font-size: 10px;
        }
        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            table-layout: fixed;
        }
        table.data th {
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #475569;
            padding: 10px 8px;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            background: #f1f5f9;
        }
        table.data td {
            padding: 10px 8px;
            border-bottom: 1px solid #eef2f7;
            vertical-align: top;
        }
        table.data tr:nth-child(even) td {
            background: #fafcff;
        }
        .muted {
            color: #64748b;
            font-size: 10px;
            margin-top: 2px;
        }
        .wrap {
            word-break: normal;
            overflow-wrap: break-word;
            word-wrap: break-word;
            line-height: 1.35;
            white-space: normal;
        }
        .pre {
            white-space: pre-line;
        }
        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 10px;
            border: 1px solid #e2e8f0;
            background: #ffffff;
            color: #0f172a;
            font-weight: 700;
        }
        .badge-requested {
            border-color: #fcd34d;
            background: #fffbeb;
            color: #92400e;
        }
        .badge-approved {
            border-color: #93c5fd;
            background: #eff6ff;
            color: #1e40af;
        }
        .badge-rejected {
            border-color: #fda4af;
            background: #fff1f2;
            color: #9f1239;
        }
        .badge-borrowed {
            border-color: #c7d2fe;
            background: #eef2ff;
            color: #3730a3;
        }
        .badge-returned {
            border-color: #a7f3d0;
            background: #ecfdf5;
            color: #065f46;
        }
        .footer {
            position: fixed;
            bottom: -50px;
            left: 0;
            right: 0;
            height: 50px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            color: #64748b;
            font-size: 10px;
        }
        .footer-table {
            width: 100%;
        }
        .footer-table td:last-child {
            text-align: right;
        }
    </style>
</head>
<body>
<div class="header">
    <table class="brand">
        <tr>
            <td style="width:86px;">
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
            <td style="width:86px;"></td>
        </tr>
    </table>
    <div class="rule">
        <div class="rule-1"></div>
        <div class="rule-2"></div>
    </div>
    <div class="doc-title">LAPORAN PEMINJAMAN</div>
    <div class="filters">
        Filter: Status: {{ $status !== '' ? ($statusOptions[$status] ?? $status) : 'Semua' }} | Pencarian: {{ $q !== '' ? $q : '—' }}<br>
        Dicetak: {{ $generatedAt->format('d/m/Y H:i') }}&nbsp;WIB | Total data: {{ $items->count() }}
    </div>
</div>

<table class="data">
    <colgroup>
        <col style="width:3%">
        <col style="width:22%">
        <col style="width:26%">
        <col style="width:10%">
        <col style="width:17%">
        <col style="width:22%">
    </colgroup>
    <thead>
    <tr>
        <th>No</th>
        <th>Mahasiswa</th>
        <th>Koleksi</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Catatan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $i => $item)
        @php
            $statusKey = (string) $item->status;
            $badgeClass = $statusKey === 'requested'
                ? 'badge-requested'
                : ($statusKey === 'approved'
                    ? 'badge-approved'
                    : ($statusKey === 'rejected'
                        ? 'badge-rejected'
                        : ($statusKey === 'borrowed'
                            ? 'badge-borrowed'
                            : ($statusKey === 'returned' ? 'badge-returned' : ''))));
        @endphp
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>
                <div style="font-weight:700;">{{ $item->user?->name }}</div>
                <div class="muted">{{ $item->user?->nim }} • {{ $item->user?->email }}</div>
            </td>
            <td>
                <div style="font-weight:700;" class="wrap">{{ $item->koleksi?->judul }}</div>
                <div class="muted wrap">{{ $item->koleksi?->pengarang }}</div>
            </td>
            <td>
                <span class="badge {{ $badgeClass }}">{{ $statusOptions[$item->status] ?? $item->status }}</span>
            </td>
            <td>
                <div><span class="muted">Diajukan:</span> {{ $item->created_at?->format('d/m/Y H:i') }}&nbsp;WIB</div>
                @if($item->tanggal_pinjam)
                    <div><span class="muted">Pinjam:</span> {{ $item->tanggal_pinjam->format('d/m/Y') }}</div>
                @endif
                @if($item->tanggal_jatuh_tempo)
                    <div><span class="muted">Jatuh tempo:</span> {{ $item->tanggal_jatuh_tempo->format('d/m/Y') }}</div>
                @endif
                @if($item->tanggal_kembali)
                    <div><span class="muted">Kembali:</span> {{ $item->tanggal_kembali->format('d/m/Y') }}</div>
                @endif
            </td>
            <td>
                <span class="wrap pre">{!! nl2br(e($item->catatan_admin ?: '—')) !!}</span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>© {{ $generatedAt->format('Y') }} Perpustakaan Digital</td>
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
