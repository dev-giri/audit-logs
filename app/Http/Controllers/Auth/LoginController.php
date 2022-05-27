<?php

namespace App\Http\Controllers\Auth;

use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Audit;
use Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('/content/auth/login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|string|min:6',
        ]);
        $remember = $request->remember == 'on' ? true : false;

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials,$remember)) {
            
            return $this->authenticated($request,auth()->user());
        }

        return redirect('auth/login')->with('error', 'Oppes! You have entered invalid credentials');
    }

    protected function authenticated(Request $request,$user){
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

        Auth::logoutOtherDevices($request->password);

        if(auth()->user()->is_admin == 1){
            return redirect()->intended('admin');
        }
        return redirect()->intended('dashboard');
    }

    public function logout() {
      $audit = Audit::where('user_id',auth()->user()->id)->orderBy('id','desc')->first();
      if(isset($audit->id)){
        $audit->update(['logout'=>Carbon::now()]);
      }
      Auth::logout();

      return redirect('auth/login');
    }
}
