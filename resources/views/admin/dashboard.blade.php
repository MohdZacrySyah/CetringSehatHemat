<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin - Dapur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-gray-500 text-sm">Total Pendapatan (Paid)</div>
                    <div class="text-2xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="text-gray-500 text-sm">Pesanan Baru (Pending)</div>
                    <div class="text-2xl font-bold">{{ $pesananBaru }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-gray-500 text-sm">Sedang Proses</div>
                    <div class="text-2xl font-bold">{{ $pesananAktif }}</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-500">
                    <div class="text-gray-500 text-sm">Total Menu Makanan</div>
                    <div class="text-2xl font-bold">{{ $totalMenu }}</div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('admin.orders') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">📦 Kelola Pesanan</h5>
                    <p class="font-normal text-gray-700">Lihat pesanan masuk, ubah status masakan, dan pengiriman.</p>
                </a>
                <a href="{{ route('admin.menus') }}" class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100">
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">🍽️ Kelola Menu</h5>
                    <p class="font-normal text-gray-700">Tambah menu baru, ubah harga, atau hapus menu.</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>