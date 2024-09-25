<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\TodaysOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    function index(TodaysOrderDataTable $dataTable): View|JsonResponse
    {
        $todaysOrders = Order::whereDate('created_at', now()->format('Y-m-d'))->count();
        $todaysEarning = Order::whereDate('created_at', now()->format('Y-m-d'))->where('order_status', 'delivered')->sum('grand_total');

        $thisMonthOrders = Order::whereMonth('created_at', now()->month)->count();
        $thisMonthEarning = Order::whereMonth('created_at', now()->month)->where('order_status', 'delivered')->sum('grand_total');

        $thisYearOrders = Order::whereYear('created_at', now()->year)->count();
        $thisYearEarning = Order::whereYear('created_at', now()->year)->where('order_status', 'delivered')->sum('grand_total');

        $totalOrders = Order::count();
        $totalEarning = Order::where('order_status', 'delivered')->sum('grand_total');

        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        $totalProducts = Product::count();
        $totalBlogs = Blog::count();



        return $dataTable->render('admin.dashboard.index', compact(
            'todaysOrders',
            'todaysEarning',
            'thisMonthOrders',
            'thisMonthEarning',
            'thisYearOrders',
            'thisYearEarning',
            'totalOrders',
            'totalEarning',
            'totalUsers',
            'totalAdmins',
            'totalProducts',
            'totalBlogs',
        ));
    }
}
