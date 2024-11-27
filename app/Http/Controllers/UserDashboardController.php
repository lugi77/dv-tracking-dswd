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

        if ($user->section === 0) {
            return view('dashboard.admin'); // Admin Dashboard
        } elseif ($user->section === 1) {
            return view('dashboard.budget'); // Budget Dashboard
        } elseif ($user->section === 2) {
            return view('dashboard.accounting'); // Accounting Dashboard
        } elseif ($user->section === 3) {
            return view('dashboard.cash'); // Cash Dashboard
        } else {
            return abort(401, 'Unauthorized');
        }
    }
    
}
