<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\Bank;
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
        $title="입금신청";
        $bank_list = Bank::where('is_use', 1)->get();
        return response()->json(["status" => "success", "data" => compact('bank_list')]);
    }    
    
}
