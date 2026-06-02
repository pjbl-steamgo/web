<h1>Laporan Pendapatan SteamGo</h1>
<table border="1" width="100%" cellpadding="5">
    <thead>
        <tr>
            <th>ID Pesanan</th>
            <th>Pelanggan</th>
            <th>Layanan</th>
            <th>Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pesanans as $p)
        <tr>
            <td>{{ $p->kode_pesanan }}</td>
            <td>{{ $p->nama_pelanggan }}</td>
            <td>{{ $p->layanan->nama_layanan ?? '-' }}</td>
            <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h3>Total Pendapatan: Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>