<?php

namespace App\Http\Controllers\Partner\Calculate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trading;
use App\Models\Coin;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use DB;

class HistoryController extends Controller
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

        $title = "일/월 입출금";
        $fromDate = date("Y-m-d", strtotime("-1 months"));
        $toDate = date("Y-m-d");
        
        if ($request->ajax()) {
            $fromDate = $request->get('txtFrom');
            $toDate = $request->get('txtTo');
            $referer = Auth::user()->member_code;

            $lists = DB::select("SELECT
                users.id,
                users.name,
                users.nickname,
                users.money,
                IFNULL(SUM(cl.`order_amount`),0) AS ord_amt,
                IFNULL(SUM(cl.`payout_amount`),0) AS pay_amt,
                IFNULL(SUM(cl.`add_amount`),0) AS add_amt,
                SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) AS deposit_amt,
                SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) AS withdraw_amt,
                SUM(CASE WHEN el.type = 0 THEN amount ELSE 0 END) - SUM(CASE WHEN el.type=1 THEN amount ELSE 0 END) as profit_amt
            FROM
                users
                LEFT JOIN (SELECT * FROM  coin_trade_list WHERE created_at >= '${fromDate}' AND created_at <= '${toDate}' GROUP BY user_id) AS cl
                ON users.id = cl.`user_id`
                LEFT JOIN (SELECT * FROM  exchange_list WHERE requested_date >= '${fromDate}' AND requested_date <= '${toDate}' GROUP BY user_id) AS el
                ON users.id = el.`user_id` 
            WHERE users.type='USER' AND users.is_use=1 AND users.is_del=0 AND users.referer='${referer}'
            GROUP BY users.id");

            return DataTables::of($lists)
            ->make(true);
        }
        return view('partner.calculate.history_list', compact('title', 'fromDate', 'toDate'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_index($userId, Request $request)
    {

        $title = "배당금내역";

        if ($request->ajax()) {
            
            $schedules = Trading::where('is_del', 0)->where('user_id', $userId)->orderBy('created_at', 'DESC');

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
                    $name = $row->user->nickname;
                    $tags = '<li style="list-style: none;" class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge" style="padding:0px; right:unset; top:3px; font-size:12px">'.$name.'('.$row->user->name.')</span>
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
                // ->addColumn('action', function ($row) {                    
                //     $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                //     $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                //     $btn .= '<button type="button" data-state="1" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-info btnState">정산</button>';
                //     $btn .= '<button type="button" data-state="2" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-warning btnState">적특</button>';
                //     return $btn;
                // })
                ->addColumn('state_info', function ($row) {
                    $state = "미지급";
                    if($row->state == 0){
                        $state = "미지급";
                    }else if($row->state == 1){
                        $state = "지급";
                    }else{
                        $state = "실격";
                    }
                    return $state;
                })
                ->rawColumns(['action','user_info', 'level'])
                ->make(true);
        }
        return view('partner.calculate.user_result_list', compact('title', 'userId'));
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
        return view('partner.calculate.result_detail', compact('title', 'id', 'trading', 'users', 'coins'));
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
