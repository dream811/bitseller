<?php

namespace App\Http\Controllers\Admin\Cash;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Money;
use App\Models\Exchange;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class CashController extends Controller
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
    public function index($type = 0, Request $request)
    {
        $title = "입금";
        if ($type == 1)
            $title = "출금";
        Exchange::where('type', $type)->where('is_check', 0)->update(['is_check' => 1]);

        if ($request->ajax()) {
            $monies = Exchange::where('type', $type)
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($monies)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '';
                    if ($row->state == 0){
                        $element .= '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="m-1 btn btn-xs btn-primary btnCheck">대기</button>';
                    }else if($row->state == 3){
                        $element .= '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="m-1 btn btn-xs btn-success btnConfirm">승인</button>';
                        $element .= '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="m-1 btn btn-xs btn-danger btnCancel">취소</button>';
                    }
                    return $element;
                })
                ->editColumn('requested_date', function ($row) {
                    return date('Y-m-d', strtotime($row->requested_date));
                })
                ->editColumn('accepted_date', function ($row) {
                    if($row->state == 0){
                        return "";
                    }else{
                        return date('Y-m-d', strtotime($row->accepted_date));
                    }
                })
                ->addColumn('bank_user', function ($row) {
                    return $row->user->bank_user;
                })
                ->addColumn('user_name', function ($row) {
                    $name = User::find($row->user_id)->name;
                    $tags = '<li style="list-style: none;" class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge" style="padding:0px; right:unset; top:3px; font-size:12px;">'.$name.'</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="javascript:void(0)" class="dropdown-item btnEditMember" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted">'.$name.' 정보수정</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoDeposit" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm ">입금내역</span>
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
                ->editColumn('accepted_date', function ($row) {
                    if($row->state == 0){
                        return "";
                    }else{
                        return date('Y-m-d', strtotime($row->accepted_date));
                    }
                })
                ->editColumn('state', function ($row) {
                    if ($row->state == 0) {
                        return "신청";
                    } else if ($row->state == 1) {
                        return "승인";
                    } else if ($row->state == 2) {
                        return "부결";
                    } else if ($row->state == 3) {
                        return "대기";
                    }
                })
                ->rawColumns(['check', 'action', 'user_name'])
                ->make(true);
        }
        return view('admin.cash.cash_list', compact('title', 'type'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user_index($type = 0, $user_id, Request $request)
    {
        $title = "입금";
        if ($type == 1)
            $title = "출금";


        if ($request->ajax()) {
            $monies = Exchange::where('type', $type)->where('user_id', $user_id)
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($monies)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '';
                    if ($row->state == 0){
                        $element = '<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnConfirm">승인</button>';
                        $element .= '&nbsp;&nbsp;<button type="button" data-type="'.$row->type.'" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-danger btnCancel">취소</button>';
                    }
                    return $element;
                })
                ->editColumn('requested_date', function ($row) {
                    return date('Y-m-d', strtotime($row->requested_date));
                })
                ->editColumn('accepted_date', function ($row) {
                    if($row->state == 0){
                        return "";
                    }else{
                        return date('Y-m-d', strtotime($row->accepted_date));
                    }
                })
                ->addColumn('bank_user', function ($row) {
                    return $row->user->bank_user;
                })
                ->addColumn('user_name', function ($row) {
                    $name = User::find($row->user_id)->name;
                    $tags = '<li style="list-style: none;" class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
                        <span class="badge" style="padding:0px; right:unset; top:3px; font-size:12px;">'.$name.'</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                        <a href="javascript:void(0)" class="dropdown-item btnEditMember" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted">'.$name.' 정보수정</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0)" class="dropdown-item btnGotoDeposit" data-id="'.$row->user_id.'">
                            <span class="float-center text-muted text-sm ">입금내역</span>
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
                ->editColumn('accepted_date', function ($row) {
                    if($row->state == 0){
                        return "";
                    }else{
                        return date('Y-m-d', strtotime($row->accepted_date));
                    }
                })
                ->editColumn('state', function ($row) {
                    if ($row->state == 0) {
                        return "대기";
                    } else if ($row->state == 1) {
                        return "승인";
                    } else if ($row->state == 2) {
                        return "부결";
                    }
                })
                ->rawColumns(['check', 'action', 'user_name'])
                ->make(true);
        }
        return view('admin.cash.cash_user_list', compact('title', 'type', 'user_id'));
    }

    /**
     * 상품등록선택후 마켓상품등록버튼
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($type = 0, $id)
    {
        $bank_account = ShopConfig::first()->pluck('de_bank_account');
        $moneyInfo = Money::firstOrNew(['mo_id' => $id]);

        return view('admin.user.ChargeDetail', compact('moneyInfo', 'type', 'id', 'bank_account'));
    }
    // 저장
    public function save($type = 0, $id, Request $request)
    {

        $submoney = Money::find($id);
        $user = User::where('mb_id', $submoney->mb_id)->first();
        $money = $user->mb_money;
        $confirm = $request->post('confirmType');
        if ($type == 0 && $confirm == 1) {
            $money += $submoney->mo_money;
            $user->update(['mb_money' => $money]);
        } else if ($type == 1 && $confirm == 2) {
            $money += $submoney->mo_money;
            $user->update(['mb_money' => $money]);
        }
        $content = $confirm == 1 ? "승인" : "취소";
        Money::where('mo_id', $id)->update(
            [
                'mo_state' => $confirm
            ]
        );


        $data = '<script>alert("' . $content . '되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    // 삭제
    public function delete($type, $id, Request $request)
    {
        $money = Money::find($id);
        $user = User::where('id', $money->id)->first();

        if ($money->mo_type == 1) {
            $user->update(['mb_money' => $user->mb_money + $money->mo_money]);
        }
        $money->delete();
        return response()->json(["status" => "success", "data" => '성과적으로 삭제되었습니다.']);
    }

    // 승인상태 변경
    public function state($type, $id, Request $request)
    {
        $money = Exchange::find($id);
        $user = User::find($money->user_id);

        if ($money->type == 0) {//입금
            if($request->post('state') == 1){//승인
                $user->update(['money' => $user->money + $money->amount]);
                $money->update([
                    'state' => 1,
                    'accepted_date' => Carbon::now(),
                ]);
            }else if($request->post('state') == 2){//취소
                $money->update([
                    'state' => 0,                    
                ]);
            }
            
        }else{//출금
            if($request->post('state') == 1){//승인
                
                $money->update([
                    'state' => 1,
                    'accepted_date' => Carbon::now(),
                ]);
            }else if($request->post('state') == 2){//취소
                $user->update(['money' => $user->money - $money->amount]);
                $money->update([
                    'state' => 0,
                ]);
            }
            $user->update(['money' => $user->money + $money->mo_money]);
        }
        //$money->delete();
        return response()->json(["status" => "success", "data" => '성과적으로 삭제되었습니다.']);
    }
}
