<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Export Peminjaman</title>
    <style>
        @page {
            margin: 116px 34px 70px 34px;
        }
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 11px;
            color: #0f172a;
        }
        .header {
            position: fixed;
            top: -96px;
            left: 0;
            right: 0;
            height: 96px;
        }
        .header-inner {
            padding-bottom: 12px;
        }
        .accent {
            height: 4px;
            background: #059669;
            border-radius: 999px;
            margin-bottom: 10px;
        }
        .brand {
            width: 100%;
        }
        .brand td {
            vertical-align: middle;
        }
        .logo {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid #a7f3d0;
            background: #ffffff;
            overflow: hidden;
        }
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            padding: 6px;
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
        .chips {
            margin-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
        }
        .chip {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            border: 1px solid #a7f3d0;
            background: #ecfdf5;
            font-size: 10px;
            margin-right: 6px;
            margin-bottom: 6px;
        }
        .chip strong {
            color: #0f172a;
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
    <div class="header-inner">
        <div class="accent"></div>
        <table class="brand">
            <tr>
                <td style="width:56px;">
                    <div class="logo">
                        @if($logoDataUri)
                            <img src="{{ $logoDataUri }}" alt="Logo">
                        @endif
                    </div>
                </td>
                <td>
                    <div class="title">Laporan Peminjaman</div>
                    <div class="subtitle">{{ config('app.name') }} • Perpustakaan Digital</div>
                </td>
                <td class="meta">
                    <div>Dibuat: {{ $generatedAt->format('d/m/Y H:i') }} WIB</div>
                    <div>Total data: {{ $items->count() }}</div>
                </td>
            </tr>
        </table>
        <div class="chips">
            <span class="chip"><strong>Status:</strong> {{ $status !== '' ? ($statusOptions[$status] ?? $status) : 'Semua' }}</span>
            <span class="chip"><strong>Pencarian:</strong> {{ $q !== '' ? $q : '—' }}</span>
        </div>
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
                <div><span class="muted">Diajukan:</span> {{ $item->created_at?->format('d/m/Y H:i') }} WIB</div>
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
