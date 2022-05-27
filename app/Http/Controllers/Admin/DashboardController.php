<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audit;
use Carbon\Carbon;
use Hash;


class DashboardController extends Controller
{
    // index
    public function index()
    {
        $audits = Audit::orderBy('id','desc')->get();
        return view('/content/admin/home',['audits'=>$audits]);
    }

   public function edit_audit(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $audit = Audit::find($request->id);
        $update = [];
        if($request->has('ip')) $update['ip'] = $request->ip;
        if($request->has('device_name')) $update['device_name'] = $request->device_name;
        if($request->has('platform')) $update['platform'] = $request->platform;
        if($request->has('browser')) $update['browser'] = $request->browser;
        $audit->update($update);
        return redirect()->back()->with('success', 'Successfully updated.');
   }

   public function delete_audit(Request $request){
        $request->validate([
            'id' => 'required',
        ]);
        $audit = Audit::find($request->id);
        $audit->delete();
        return redirect()->back()->with('success', 'Successfully deleted.');
   }
}