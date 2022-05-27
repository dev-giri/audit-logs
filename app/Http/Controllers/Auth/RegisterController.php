<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audit;
use Hash;
use Auth;

class RegisterController extends Controller
{
  public function register()
  {
    return view('/content/auth/register');
  }

  public function store(Request $request)
  {
    if($request->agree == 'on'){
      $request->validate([
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6',
      ]);

      $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->password),
      ]);

      $credentials = $request->only('email', 'password');
      if (Auth::attempt($credentials)) {
        $ip = \Request::getClientIp(true);
        $uid = $user->id;
        
        $agent = new Agent();
        $device = $agent->device();
        $deviceName = '';
        if($agent->isDesktop()){
            $deviceName = 'Desktop';
        }else if($agent->isPhone()){
            $deviceName = 'Phone';
        }else if($agent->isMobile()){
            $deviceName = 'Mobile';
        }else if($agent->isTablet()){
            $deviceName = 'Tablet';
        }
        $platform = $agent->platform();
        $plVersion = $agent->version($platform);

        $browser = $agent->browser();
        $brVersion = $agent->version($browser);

        Audit::create([
            'user_id' => $user->id,
            'ip' => $ip,
            'device' => $device,
            'device_name' => $deviceName,
            'platform' => $platform,
            'platform_version' => $plVersion,
            'browser' => $browser,
            'browser_version' => $brVersion,
            'agent' => $request->userAgent()
        ]);
        return redirect()->intended('dashboard');
      }

      return redirect('auth/register')->with('error', 'Oppes! You have entered invalid fields.');
    }
  }

}
