<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
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

        $title = "사용자관리";

        if ($request->ajax()) {
            $users = User::where('type', 'USER')
                ->where('level', '<', 9)
                ->orderBy('name');

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('level', function ($row) {
                    $level = "신규";
                    switch ($row->level) {
                        case 0:
                            $level = "신규";
                            break;
                        case 1:
                            $level = "1급";
                            break;
                        case 2:
                            $level = "2급";
                            break;
                        default:
                            $level = "";
                            break;
                    }
                    return $level;
                })
                ->editColumn('is_use', function ($row) {
                    $checked = $row->is_use == 1 ? "checked" : "";
                    $btn='<div>
                        <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" '.$checked.' id="chkUse_'.$row->id.'">
                        <label class="custom-control-label" for="chkUse_'.$row->id.'"></label>
                        </div>
                    </div>';
                    return $btn;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    $btn .= '<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'level', 'is_use'])
                ->make(true);
        }
        return view('admin.user.list', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function guide(Request $request)
    {
        $title = "거래방법";
        $guide = Setting::first()->guide;
        return view('admin.setting.guide', compact('title', 'guide'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveGuide(Request $request)
    {
        
        $guide = $request->post('guide');
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'guide' => $guide,
            ]
        );
        
        return redirect()->route('admin.setting.guide');
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function bank(Request $request)
    {
        $title = "은행업무설정";
        $setting = Setting::first();
        return view('admin.setting.bank', compact('title', 'setting'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveBank(Request $request)
    {
        
        $bank_info = $request->post('bank_info');
        $deposit_from = $request->post('deposit_from');
        $deposit_to = $request->post('deposit_to');
        $withdraw_from = $request->post('withdraw_from');
        $withdraw_to = $request->post('withdraw_to');
        Setting::updateOrCreate(
            ['id' => 1],
            [
                'bank_info' => $bank_info,
                'deposit_from' => $deposit_from,
                'deposit_to' => $deposit_to,
                'withdraw_from' => $withdraw_from,
                'withdraw_to' => $withdraw_to,
            ]
        );
        
        return redirect()->route('admin.setting.bank');
        
    }
}
