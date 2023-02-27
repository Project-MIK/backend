<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnlyThoseWhoDontHaveRecordMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('pattient')->check()){
            $check = DB::table('record')->where('medical_record_id' , Auth::guard('pattient')->user()->medical_record_id)->first();
            if($check!=null){
                if($check->status == "consultation-complete"){
                    return $next($request);
                }else{
                    return redirect('/dashboard')->with('message' , "harap selesaikan konsultasi yang masih tersedia");
                }
            }
        }else{
            return redirect()->back()->with('message' , "Silahkan login terlebih dahulu");
        }
   
       
    }
}
