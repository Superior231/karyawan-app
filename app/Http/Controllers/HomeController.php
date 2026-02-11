<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees = Employee::all();
        $positions = Position::all();
        $activeEnployees = Employee::where('status', 'active')->get();
        $inactiveEnployees = Employee::where('status', 'inactive')->get();

        return view('pages.home.index', [
            'title' => 'Home - Karyawan App | PT Maju Jaya',
            'active' => 'home',
            'employees' => $employees,
            'positions' => $positions,
            'activeEnployees' => $activeEnployees,
            'inactiveEnployees' => $inactiveEnployees
        ]);
    }
}
