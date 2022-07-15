<?php

namespace App\Http\Controllers\Admin\Calculate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trading;
use App\Models\Coin;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class TradingController extends Controller
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
    public function index(Request $request)
    {

        $title = "구매목록";

        if ($request->ajax()) {
            $schedules = Trading::where('is_del', 0)->orderBy('created_at', 'DESC');

            return DataTables::of($schedules)
                ->addIndexColumn()
                // ->addColumn('chk-is-use', function ($row) {
                //     $checked = $row->is_use ? "checked" : "";
                //     $btn='<div>
                //         <div class="custom-control custom-switch">
                //         <input type="checkbox" class="custom-control-input chk-is-use" '.$checked.' data-id="'.$row->id.'" id="chkUse_'.$row->id.'">
                //         <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                //         </div>
                //     </div>';
                //     //$btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                //     // $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                //     return $btn;
                // })
                ->addColumn('user_info', function ($row) {
                    $name = User::find($row->user_id)->name;
                    $str_id = User::find($row->user_id)->str_id;
                    $tags = '<li style="list-style: none;" class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge navbar-badge" style="padding:0px; right:unset; top:3px; font-size:14px">'.$name.'('.$str_id.')</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="javascript:void(0)" class="dropdown-item btnEditMember" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">'.$name.' 정보수정</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoDeposit">
                            <span class="float-center text-muted text-sm " data-id="'.$row->user_id.'">입금내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoWithdraw" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">출금내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoTrading" data-id="'.$row->user_id.'" >
                            <span class="float-center text-muted text-sm" >구매내역</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoResult" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm">배당금내역</span>
                        </a>
                        </div>
                    </li>';
                    return $tags;
                })
                ->addColumn('level', function ($row) {
                    $name = User::find($row->user_id)->userLevel->name;
                    
                    return $name;
                })
                ->addColumn('action', function ($row) {
                    
                    $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    $btn .= '<button type="button" data-state="1" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-info btnState">정산</button>';
                    $btn .= '<button type="button" data-state="2" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-warning btnState">적특</button>';
                    return $btn;
                })
                ->rawColumns(['action','user_info', 'level'])
                ->make(true);
        }
        return view('admin.calculate.trading_list', compact('title'));
    }

    //수정하려는 유저 선택(post)
    public function edit($id = 0)
    {
        $title = "수정";
        if ($id == 0) {
            $title = "추가";
        }

        $trading = Trading::where('is_del', 0)
            ->where('id', $id)
            ->firstOrNew();
        $users = User::where('is_del', 0)->where('is_use', 1)->where('type', 'USER')->select('id', 'str_id', 'name', 'nickname')->get();
        $coins = Coin::where('is_use', 1)->get();
        return view('admin.calculate.trading_detail', compact('title', 'id', 'trading', 'users', 'coins'));
    }
    public function save(Request $request)
    {

        $data = [
            'start_time' => $request->post('start_time'),
            'end_time' => $request->post('end_time'),
            'calculate_time' => $request->post('calculate_time'),
            'is_use' => $request->post('is_use'),
            'is_del' => 0,
        ];
        
        
        $schedule = Trading::updateOrCreate(
            ['id' => $request->post('id')],
            $data
        );
        return response()->json(["status" => "success", "data" => $schedule]);
    }

    //사용상태 변경
    public function state($id, Request $request)
    {
        $status = $request->post('status');
        $id = Trading::where('id', $id)
            ->update(            
                ['is_use' => $status]
            );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $status]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
        $schedule = Trading::where('id', $id)->delete();
        return response()->json(["status" => "success", "data" => $schedule]);
    }
}
