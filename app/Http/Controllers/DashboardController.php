<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Service;
use App\Models\User;

class DashboardController extends Controller
{
    public function home()
    {
        return view('/content/dashboard');
    }
}
