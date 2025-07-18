<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Perjanjian Sewa Kost</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 20px;
        }

        h1,
        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            margin-bottom: 15px;
        }

        td {
            vertical-align: top;
            padding: 4px 6px;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 14px;
        }

        .signature {
            margin-top: 10px;
            text-align: right;
        }

        .signature img {
            height: 80px;
        }
    </style>
</head>

<body>

    <h2>Surat Perjanjian Sewa Kost</h2>

    <p>Pada hari ini, <strong>{{ now()->translatedFormat('l, d F Y') }}</strong>, telah terjadi perjanjian sewa antara:
    </p>

    <table>
        <tr>
            <td width="35%">Nama Penyewa</td>
            <td width="5%">:</td>
            <td>{{ $contract->user->name }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $contract->user->email }}</td>
        </tr>
        <tr>
            <td>No KTP</td>
            <td>:</td>
            <td>{{ $contract->user->no_ktp }}</td>
        </tr>
        <tr>
            <td>Nomor Telepon</td>
            <td>:</td>
            <td>{{ $contract->user->phone_number }}</td>
        </tr>
        <tr>
            <td>Status</td>
            <td>:</td>
            <td>{{ $contract->user->status }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($contract->user->tgl_lahir)->age }} tahun</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $contract->user->gender === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
        </tr>
    </table>

    <p><strong>Dengan pemilik kost atas kamar berikut:</strong></p>

    <table>
        <tr>
            <td width="35%">Nama Kamar</td>
            <td width="5%">:</td>
            <td>{{ $contract->room->name }}</td>
        </tr>
        <tr>
            <td>Alamat Kost</td>
            <td>:</td>
            <td>{{ $contract->room->address }}</td>
        </tr>
        <tr>
            <td>Harga Sewa per Bulan</td>
            <td>:</td>
            <td>Rp {{ number_format($contract->room->price, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Jumlah Deposit</td>
            <td>:</td>
            <td>Rp {{ number_format($contract->deposit_amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td>Total Dibayarkan Awal</td>
            <td>:</td>
            <td>Rp {{ number_format($contract->room->price + $contract->deposit_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="section-title">Aturan Kost:</div>
    <ul>
        @foreach ($contract->room->regulation as $rule)
            <li>{{ $rule }}</li>
        @endforeach
    </ul>

    <div class="section-title">Ketentuan Deposit:</div>
    <ul>
        <li>Deposit digunakan sebagai jaminan apabila terjadi kerusakan fasilitas kost oleh penyewa.</li>
        <li>Deposit akan dikembalikan saat masa sewa berakhir apabila tidak ada pelanggaran atau kerusakan.</li>
        <li>Deposit tidak dapat dianggap sebagai pengganti pembayaran bulanan.</li>
        <li>Pengembalian dilakukan maksimal 7 hari kerja setelah masa sewa berakhir.</li>
    </ul>

    <p class="mt-4">Penyewa setuju untuk membayar sewa secara bulanan dan mematuhi seluruh peraturan yang telah
        ditetapkan oleh pemilik kost.</p>

    <p class="mb-4">Perjanjian ini berlaku sejak
        <strong>{{ \Carbon\Carbon::parse($contract->start_date)->translatedFormat('d F Y') }}</strong> sampai dengan
        <strong>{{ \Carbon\Carbon::parse($contract->end_date)->translatedFormat('d F Y') }}</strong>.
    </p>
    <div style="width: 100%; margin-top: 30px; display: table;">
        <div style="display: table-row;">
            <div style="display: table-cell; width: 60%; text-align: left;">
                <p><strong>QR Code Check-in:</strong></p>
                <img src="{{ $qrCodeBase64 }}" alt="QR Code" style="height: 100px;">
            </div>
            <div style="display: table-cell; width: 40%; text-align: right;">
                <p><strong>Penyewa,</strong></p>
                @if ($contract->signature)
                    <img src="{{ public_path('storage/' . $contract->signature) }}" alt="Tanda Tangan"
                        style="height: 80px;">
                @else
                    <p><em>(Belum ditandatangani)</em></p>
                @endif
                <p style="margin-top: 5px;"><strong>{{ $contract->user->name }}</strong></p>
            </div>
        </div>
    </div>





</body>

</html>