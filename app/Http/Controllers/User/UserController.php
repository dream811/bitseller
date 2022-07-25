<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\Setting;
use App\Models\User;
use App\Models\Message;
use Yajra\DataTables\DataTables;

class UserController extends Controller
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
    public function guide(Request $request)
    {
        $title="거래방법";
        $guide = Setting::first()->guide;
        return view('user.guide', compact('title', 'guide'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function mypage(Request $request)
    {
        $title="나의정보";
        return view('user.mypage', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function check_password(Request $request)
    {
        if(Hash::check($request->post('password'), Auth::user()->password)){
            $message = "비번이 일치합니다.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else{
            $message = "비번이 일치하지 않습니다.";
            return response()->json(["status" => "failed", "data" => compact('message')]);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function change_info(Request $request)
    {
        if($request->post('password') != "" && Hash::check($request->post('password'), Auth::user()->password)){
            $new_password = Hash::make($request->post('new_password'));
            $nickname = $request->post('nickname');
            $phone = $request->post('phone');
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'password' => $new_password,
                'nickname' => $nickname,
                'phone' => $phone
            ]);
            $message = "정보를 수정하였습니다.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else if($request->post('password') == ""){
            $new_password = Hash::make($request->post('new_password'));
            $nickname = $request->post('nickname');
            $phone = $request->post('phone');
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'nickname' => $nickname,
                'phone' => $phone
            ]);
            $message = "정보를 수정하였습니다.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else{
            $message = "비번이 일치하지 않습니다.";
            return response()->json(["status" => "failed", "data" => compact('message')]);
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_info(Request $request)
    {
        //echo Auth::id();
        $user_info = User::find(Auth::id(), ['money', 'deposit_sum']);
        $user_info->msg_cnt = Message::where('receiver_id', Auth::id())->where('is_read', 0)->count();
        return response()->json(["status" => "success", "data" => compact('user_info')]);
        
    }
}
