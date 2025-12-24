<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pesanan Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">Order ID</th>
                                <th class="px-6 py-3">Pelanggan</th>
                                <th class="px-6 py-3">Total</th>
                                <th class="px-6 py-3">Metode Bayar</th>
                                <th class="px-6 py-3">Status Saat Ini</th>
                                <th class="px-6 py-3">Aksi (Update Status)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 font-bold">#{{ $order->order_number }}</td>
                                <td class="px-6 py-4">
                                    {{ $order->user->name }}<br>
                                    <span class="text-xs text-gray-400">{{ $order->created_at->diffForHumans() }}</span>
                                </td>
                                <td class="px-6 py-4">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 uppercase">{{ $order->payment_method }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 font-semibold leading-tight rounded-full 
                                        {{ $order->status == 'pending' ? 'text-red-700 bg-red-100' : '' }}
                                        {{ $order->status == 'paid' ? 'text-blue-700 bg-blue-100' : '' }}
                                        {{ $order->status == 'finished' ? 'text-green-700 bg-green-100' : '' }}
                                    ">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="text-sm border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="paid" {{ $order->status == 'paid' ? 'selected' : '' }}>Sudah Bayar</option>
                                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Sedang Dimasak</option>
                                            <option value="delivering" {{ $order->status == 'delivering' ? 'selected' : '' }}>Sedang Diantar</option>
                                            <option value="finished" {{ $order->status == 'finished' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="px-3 py-1 text-white bg-indigo-600 rounded hover:bg-indigo-700">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>