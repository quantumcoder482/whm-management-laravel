<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Organizations;
use App\ViewSettings;

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
        $users = User::all()->count();
        $organizations = Organizations::all()->count();
        // $columnList = collect(ViewSettings::first())->except(['id', 'created_at', 'updated_at'])->toArray();
        // $columns = 0;
        // foreach ($columnList as  $value) {
        //     $columns += $value;
        // }
        return view('dashboard');
    }
}
