@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Ringkasan Penjualan')

@section('content')
    <div style="background: white; padding: 20px; border-radius: 15px; margin-bottom: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h3 style="margin: 0 0 10px 0; color: #2d3748; font-size: 1.25rem;">Halo, Admin! 👋</h3>
        <p style="margin: 0; color: #718096;">Ini adalah ringkasan aktivitas katering hari ini.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 30px;">
        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #48bb78;">
            <div style="font-size: 0.875rem; color: #718096; margin-bottom: 5px;">Total Pendapatan</div>
            <div style="font-size: 1.5rem; font-weight: bold; color: #2d3748;">
                Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #ecc94b;">
            <div style="font-size: 0.875rem; color: #718096; margin-bottom: 5px;">Pesanan Pending</div>
            <div style="font-size: 1.5rem; font-weight: bold; color: #2d3748;">
                {{ $pesananBaru ?? 0 }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #4299e1;">
            <div style="font-size: 0.875rem; color: #718096; margin-bottom: 5px;">Sedang Dimasak/Diantar</div>
            <div style="font-size: 1.5rem; font-weight: bold; color: #2d3748;">
                {{ $pesananAktif ?? 0 }}
            </div>
        </div>

        <div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-left: 5px solid #9f7aea;">
            <div style="font-size: 0.875rem; color: #718096; margin-bottom: 5px;">Total Menu</div>
            <div style="font-size: 1.5rem; font-weight: bold; color: #2d3748;">
                {{ $totalMenu ?? 0 }}
            </div>
        </div>
    </div>

    <div style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <div style="padding: 15px; border-bottom: 1px solid #eee; background-color: #f8fafc; font-weight: bold; color: #4a5568;">
            5 Pesanan Terbaru
        </div>
        
        @if(isset($orders) && count($orders) > 0)
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background-color: #f1f5f9; text-align: left;">
                        <th style="padding: 12px 15px; font-size: 0.85rem; color: #64748b;">ID</th>
                        <th style="padding: 12px 15px; font-size: 0.85rem; color: #64748b;">Pelanggan</th>
                        <th style="padding: 12px 15px; font-size: 0.85rem; color: #64748b;">Total</th>
                        <th style="padding: 12px 15px; font-size: 0.85rem; color: #64748b;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 12px 15px;">#{{ $order->order_number }}</td>
                        <td style="padding: 12px 15px;">
                            <div style="font-weight: 500;">{{ $order->user->name }}</div>
                            <div style="font-size: 0.75rem; color: #94a3b8;">{{ $order->created_at->diffForHumans() }}</div>
                        </td>
                        <td style="padding: 12px 15px;">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</td>
                        <td style="padding: 12px 15px;">
                            <span style="padding: 4px 8px; border-radius: 20px; font-size: 0.75rem; font-weight: 600; 
                                background-color: {{ $order->status == 'pending' ? '#fee2e2' : ($order->status == 'paid' ? '#dbeafe' : '#dcfce7') }}; 
                                color: {{ $order->status == 'pending' ? '#991b1b' : ($order->status == 'paid' ? '#1e40af' : '#166534') }};">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div style="padding: 15px; text-align: center; border-top: 1px solid #eee;">
                <a href="{{ route('admin.orders') }}" style="color: #4A572A; text-decoration: none; font-weight: 600; font-size: 0.9rem;">
                    Lihat Semua Pesanan &rarr;
                </a>
            </div>
        @else
            <div style="padding: 30px; text-align: center; color: #a0aec0;">
                Belum ada pesanan masuk.
            </div>
        @endif
    </div>
    
    {{-- PERHATIAN: JANGAN GUNAKAN $orders->links() DI SINI KARENA KITA HANYA MENGAMBIL 5 DATA --}}
@endsection