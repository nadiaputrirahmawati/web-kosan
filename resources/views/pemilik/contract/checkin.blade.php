<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SimKos-Pemilik</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')


    <style>
        * {
            font-family: "Nunito", sans-serif;
        }
    </style>
</head>

<body>
    <div class="flex items-center justify-center h-screen bg-white">
        <div class="bg-white w-96 p-6 rounded-xl shadow-lg">
            <h2 class="text-xl font-bold mb-4 text-center">{{ $contract->room->name }}</h2>
            <table>
                <tr>
                    <td class="">Nama Penghuni</td>
                    <td>:</td>
                    <td class="text-gray-600">{{ $contract->user->name }}</td>
                </tr>
                <tr>
                    <td class="">Pekerjaan</td>
                    <td>:</td>
                    <td class="text-gray-600 capitalize">{{ $contract->user->work }}</td>
                </tr>
                <tr>
                    <td class="">Masuk Kost</td>
                    <td>:</td>
                    <td class="text-gray-600">{{ $contract->start_date }}</td>
                </tr>
                <tr>
                    <td class="">Sewa Berakhir</td>
                    <td>:</td>
                    <td class="text-gray-600">{{ $contract->end_date }}</td>
                </tr>
                <tr>
                    <td class="">Status</td>
                    <td>:</td>
                    <td class="text-gray-600">
                        @if ($contract->status == 'completed')
                            <span class="bg-red-100 px-3 py-1 text-xs text-red-600 rounded-lg font-medium">Belum
                                Checkin</span>
                        @elseif ($contract->status == 'active')
                            <span class="bg-green-100 px-3 py-1 text-xs text-green-600 rounded-lg font-medium">Sudah Checkin</span>
                        @endif
                    </td>
                </tr>
            </table>
            <div class="w-full mt-4">
                <form action="{{ route('contract.checkin.save') }}" method="post">
                    @csrf
                    <input type="hidden" name="contract_id" value="{{ $contract->contract_id }}" id="">
                    <button class="bg-primary  text-white font-bold py-1 px-2 rounded w-full">
                        Checkin
                    </button>
                </form>
            </div>
        </div>
</body>


</html>
