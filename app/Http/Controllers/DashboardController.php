<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ShipmentOrder;
class DashboardController extends Controller
{
    public function index()
    {
        $users = User::all();
        $totalUsers = $users->count();
        $totalShipmentOrders = ShipmentOrder::all();
        $totalShipmentOrdersCount = $totalShipmentOrders->count();
        return view('dashboard', compact('users', 'totalUsers', 'totalShipmentOrders', 'totalShipmentOrdersCount'));
    }
}
