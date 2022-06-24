<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Money;
use App\Models\ShopConfig;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class ChargeManageController extends Controller
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


        if ($request->ajax()) {
            $monies = Money::where('mo_type', $type)
                ->orderBy('mo_id', 'DESC');

            return DataTables::eloquent($monies)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->mo_id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->mo_id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">확인</button>';
                    if ($row->mo_state == 0)
                        $element .= '&nbsp;&nbsp;<button type="button" data-id="' . $row->mo_id . '" style="font-size:10px !important;" class="btn btn-xs btn-danger btnDel">삭제</button>';
                    return $element;
                })
                ->editColumn('mo_datetime', function ($row) {
                    return date('Y-m-d', strtotime($row->mo_datetime));
                })
                ->editColumn('mo_state', function ($row) {
                    if ($row->mo_state == 0) {
                        return "대기";
                    } else if ($row->mo_state == 1) {
                        return "승인";
                    } else if ($row->mo_state == 2) {
                        return "부결";
                    }
                })
                ->rawColumns(['check', 'action'])
                ->make(true);
        }
        return view('admin.user.ChargeManage', compact('title', 'type'));
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
        $user = User::where('mb_id', $money->mb_id)->first();

        if ($money->mo_type == 1) {
            $user->update(['mb_money' => $user->mb_money + $money->mo_money]);
        }
        $money->delete();
        return response()->json(["status" => "success", "data" => '성과적으로 삭제되었습니다.']);
    }
}
