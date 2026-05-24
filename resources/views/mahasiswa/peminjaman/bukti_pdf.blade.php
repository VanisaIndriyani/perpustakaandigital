<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman</title>
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
        .rule-2 { margin-top: 2px; border-top: 1px solid #111827; }
        .doc-title { margin-top: 6px; text-align: center; font-size: 11px; font-weight: 800; letter-spacing: .06em; }
        .filters { margin-top: 6px; font-size: 9px; color: #475569; }
        .meta { text-align: right; color: #475569; font-size: 10px; }
        .card { border: 1px solid #e2e8f0; border-radius: 14px; padding: 14px 16px; background: #ffffff; }
        .grid { width: 100%; border-collapse: collapse; }
        .grid td { padding: 8px 0; vertical-align: top; }
        .label { width: 140px; color: #64748b; font-size: 10px; text-transform: uppercase; letter-spacing: .04em; }
        .value { font-weight: 700; }
        .muted { color: #475569; font-weight: 400; }
        .badge { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 10px; border: 1px solid #a7f3d0; background: #ecfdf5; color: #065f46; font-weight: 700; }
        .divider { height: 1px; background: #e2e8f0; margin: 14px 0; }
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
    <div class="doc-title">BUKTI PEMINJAMAN KOLEKSI</div>
    <div class="filters">
        Dicetak: {{ $generatedAt->format('d/m/Y H:i') }}&nbsp;WIB | No. Bukti: {{ $peminjaman->id }}
    </div>
</div>

<div class="card">
    <table class="grid">
        <tr>
            <td class="label">Status</td>
            <td class="value"><span class="badge">{{ $statusOptions[$peminjaman->status] ?? $peminjaman->status }}</span></td>
        </tr>
        <tr>
            <td class="label">Mahasiswa</td>
            <td class="value">
                {{ $peminjaman->user?->name }}
                <span class="muted">({{ $peminjaman->user?->nim }})</span>
            </td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="value"><span class="muted">{{ $peminjaman->user?->email }}</span></td>
        </tr>
        <tr>
            <td class="label">Koleksi</td>
            <td class="value">{{ $peminjaman->koleksi?->judul }}</td>
        </tr>
        <tr>
            <td class="label">Pengarang</td>
            <td class="value"><span class="muted">{{ $peminjaman->koleksi?->pengarang }}</span></td>
        </tr>
        <tr>
            <td class="label">Tanggal Pinjam</td>
            <td class="value">{{ $peminjaman->tanggal_pinjam ? $peminjaman->tanggal_pinjam->format('d/m/Y') : '—' }}</td>
        </tr>
        <tr>
            <td class="label">Batas Waktu</td>
            <td class="value">{{ $peminjaman->tanggal_jatuh_tempo ? $peminjaman->tanggal_jatuh_tempo->format('d/m/Y') : '—' }}</td>
        </tr>
        @if($peminjaman->tanggal_kembali)
            <tr>
                <td class="label">Tanggal Kembali</td>
                <td class="value">{{ $peminjaman->tanggal_kembali->format('d/m/Y') }}</td>
            </tr>
        @endif
    </table>

    @if($peminjaman->catatan_admin)
        <div class="divider"></div>
        <div class="label">Catatan Admin</div>
        <div style="margin-top:6px;" class="muted">{{ $peminjaman->catatan_admin }}</div>
    @endif
</div>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>© 2026 Perpustakaan Digital</td>
            <td>
                <script type="text/php">
                    if (isset($pdf)) {
                        $pdf->page_text(500, 26, "Hal {PAGE_NUM} / {PAGE_COUNT}", null, 9, array(100,116,139));
                    }
                </script>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
