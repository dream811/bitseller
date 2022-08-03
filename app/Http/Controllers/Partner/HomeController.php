<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exchange;
use App\Models\Trading;
use App\Models\QNA;
use DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $deposit = Cash::where
        return view('admin.home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function realtime_info()
    {
        
        // $new_users = count(User::where('is_use', 2)->get());
        // $levelup_users = count(User::where('type', 'USER')->where('users.is_use', 1)->leftJoin('user_level', function($join) {
        //     $join->on('user_level.level', '=', 'users.level');
        // })->where('users.buy_sum', '>', DB::raw('user_level.levelup_amount'))->where('users.levelup_flag', 0)->get());
        $new_deposits = count(Exchange::where('type', 0)->where('state', 0)->where('is_check', 0)->get());
        $new_withdraws = count(Exchange::where('type', 1)->where('state', 0)->where('is_check', 0)->get());
        
        $new_tradings = count(Trading::where('state', 0)->where('is_check', 0)->get());
        $member_code = Auth::user()->member_code;
        $exchanges = [];
        $new_tradings = [];
        if($member_code == NULL || $member_code == ""){
            $exchanges[0] = 0;
            $exchanges[1] = 0;
            $new_tradings[1] = 0;
        }else{
            $exchanges = DB::select("SELECT count(exchange_list.id) as cnt, exchange_list.type as exchange_type FROM exchange_list LEFT JOIN users ON exchange_list.user_id = users.id WHERE users.referer = '$member_code' AND exchange_list.state=0 GROUP BY exchange_list.type");
            $new_tradings = DB::select("SELECT count(coin_trade_list.id) as cnt FROM coin_trade_list LEFT JOIN users ON coin_trade_list.user_id = users.id WHERE users.referer = '$member_code' AND coin_trade_list.state=0");
        }
        
        return response()->json(["status" => "success", "data" => compact('exchanges', 'new_tradings')]);
    }

    public function alarm_state($userId, Request $request)
    {
        $user = User::find($userId);
        $alarm_id = $request->post('alarm_id');
        if(strpos($user->add_feature, "($alarm_id)") !== false){
            $add_feature = str_replace("($alarm_id)","", $user->add_feature);
        }else{
            if(strpos($user->add_feature, ")\"") !== false){
                $add_feature = str_replace(")\"",")($alarm_id)\"", $user->add_feature);
            }else{
                $add_feature = str_replace("\"\"","\"($alarm_id)\"", $user->add_feature);
            }
        }
        $add_feature = str_replace("alarm","\"alarm\"", $add_feature);
        $user->update(            
            ['add_feature' => $add_feature]
        );

        return response()->json(["status" => "success", "data" => compact('add_feature')]);
    }
}
