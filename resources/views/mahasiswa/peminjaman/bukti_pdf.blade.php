<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Bukti Peminjaman</title>
    <style>
        @page { margin: 120px 34px 70px 34px; }
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 11px; color: #0f172a; }
        .header { position: fixed; top: -100px; left: 0; right: 0; height: 100px; }
        .accent { height: 4px; background: #059669; border-radius: 999px; margin-bottom: 10px; }
        .kop {
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .brand { width: 100%; }
        .brand td { vertical-align: middle; }
        .logo { width: 44px; height: 44px; border-radius: 12px; border: 1px solid #a7f3d0; background: #ffffff; overflow: hidden; }
        .logo img { width: 100%; height: 100%; object-fit: contain; padding: 6px; }
        .title { font-size: 16px; font-weight: 700; margin: 0; }
        .subtitle { font-size: 11px; color: #475569; margin: 2px 0 0 0; }
        .kopline { font-size: 10px; color: #64748b; margin-top: 2px; }
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
        .sig { margin-top: 18px; width: 100%; }
        .sig td { width: 50%; vertical-align: top; }
        .sig-box { border: 1px dashed #cbd5e1; border-radius: 14px; height: 84px; }
    </style>
</head>
<body>
<div class="header">
    <div class="accent"></div>
    <div class="kop">
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
                    <div class="title">KOP SURAT PERPUSTAKAAN DIGITAL</div>
                    <div class="subtitle">{{ config('app.name') }}</div>
                    <div class="kopline">Alamat: Jl. Kampus No. 1, Kota • Email: perpustakaan@kampus.ac.id • Telp: (000) 0000 0000</div>
                </td>
                <td class="meta">
                    <div>Dicetak: {{ $generatedAt->format('d/m/Y H:i') }} WIB</div>
                    <div>No. Bukti: {{ $peminjaman->id }}</div>
                </td>
            </tr>
        </table>
    </div>
    <div class="title" style="font-size:14px;">BUKTI PEMINJAMAN KOLEKSI</div>
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

<table class="sig" cellspacing="0" cellpadding="0">
    <tr>
        <td style="padding-right:10px;">
            <div class="label">Tanda tangan Mahasiswa</div>
            <div class="sig-box"></div>
        </td>
        <td style="padding-left:10px;">
            <div class="label">Tanda tangan Admin</div>
            <div class="sig-box"></div>
        </td>
    </tr>
</table>

<div class="footer">
    <table class="footer-table">
        <tr>
            <td>© 2026 Perpustakaan Digital</td>
            <td>Halaman <span class="page-number"></span></td>
        </tr>
    </table>
</div>
</body>
</html>
