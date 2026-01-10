<?php

namespace App\Http\Controllers\Admin;

use App\Exports\SalesReportExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman laporan penjualan.
     * Fitur: Filter Tanggal, Summary Statistik, Grafik Kategori, & Pagination.
     */
    public function sales(Request $request)
    {
        // 1. Inisialisasi Filter Tanggal (Default: Bulan Ini)
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo   = $request->date_to   ?? now()->toDateString();

        // 2. Query Utama: Detail Transaksi (dengan Pagination)
        $orders = Order::with(['items', 'user'])
            ->whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->where('payment_status', 'paid')
            ->latest()
            ->paginate(20)
            ->withQueryString(); // Menjaga filter tetap ada saat pindah halaman

        // 3. Query Summary: Total Omset & Total Pesanan
        $summary = Order::whereDate('created_at', '>=', $dateFrom)
            ->whereDate('created_at', '<=', $dateTo)
            ->where('payment_status', 'paid')
            ->selectRaw('COUNT(*) as total_orders, SUM(total_amount) as total_revenue')
            ->first();

        // 4. Query Analitik: Penjualan per Kategori (Join 4 Tabel)
        $byCategory = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'products.id', '=', 'order_items.product_id')
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->whereDate('orders.created_at', '>=', $dateFrom)
            ->whereDate('orders.created_at', '<=', $dateTo)
            ->where('orders.payment_status', 'paid')
            ->select('categories.name', DB::raw('SUM(order_items.subtotal) as total'))
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total')
            ->get();

        return view('admin.reports.sales', compact(
            'orders', 
            'summary', 
            'byCategory', 
            'dateFrom', 
            'dateTo'
        ));
    }

    /**
     * Handle export data ke Excel.
     */
    public function exportSales(Request $request)
    {
        $dateFrom = $request->date_from ?? now()->startOfMonth()->toDateString();
        $dateTo   = $request->date_to   ?? now()->toDateString();

        $fileName = "laporan-penjualan-{$dateFrom}-sd-{$dateTo}.xlsx";

        return Excel::download(new SalesReportExport($dateFrom, $dateTo), $fileName);
    }
}