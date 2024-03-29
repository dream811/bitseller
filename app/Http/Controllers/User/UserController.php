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
        $nickname = $request->post('nickname');
        $member_code = $request->post('member_code');
        $phone = $request->post('phone');
        if(User::where('member_code', $member_code)->where('id', '!=', Auth::id())->count()>0){
            $message = "동일한 하부회원가입코드가 이미 존재하니 다시 입력해주세요.";
            return response()->json(["status" => "error", "data" => compact('message')]);
        }
        if($request->post('password') != "" && Hash::check($request->post('password'), Auth::user()->password)){
            $new_password = Hash::make($request->post('new_password'));
            
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'password' => $new_password,
                'nickname' => $nickname,
                // 'member_code' => $member_code,
                'phone' => $phone
            ]);
            $message = "정보를 수정하였습니다.";
            return response()->json(["status" => "success", "data" => compact('message')]);
        }else if($request->post('password') == ""){
            
            User::updateOrCreate(['id'=>Auth::id()],
            [
                'nickname' => $nickname,
                'member_code' => $member_code,
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
