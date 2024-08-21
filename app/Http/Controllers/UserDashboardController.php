<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    /**
     * Show the dashboard based on the user's section.
     */
    public function index()
    {
        $user = Auth::user();

        switch ($user->section) {
            case 0:
                return view('dashboard.admin'); // Admin Dashboard
            case 1:
                return view('dashboard.budget'); // Budget Dashboard
            case 2:
                return view('dashboard.accounting'); // Accounting Dashboard
            case 3:
                return view('dashboard.cash'); // Cash Dashboard
            default:
                return redirect()->route('home')->withErrors(['msg' => 'Unauthorized access']);
        }
    }
}
