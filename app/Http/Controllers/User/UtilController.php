<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Bank;
use App\Models\User;
use Yajra\DataTables\DataTables;

class UtilController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bank_info()
    {
        $bank_list = Bank::where('is_use', 1)->get();
        return response()->json(["status" => "success", "data" => compact('bank_list')]);
    }    
    
    public function referer_check(Request $request)
    {
        $cnt = count(User::whereIn('type', ['PARTNER', 'ADMIN'])->where('str_id', $request->get('referer'))->get());
        if ($cnt > 0){
            return response()->json(["status" => "success", "data" => '']);
        }else{
            return response()->json(["status" => "failed", "data" => '추천인이 유효하지 않습니다.']);
        }
    }  
}
