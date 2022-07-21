<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exchange;
use App\Models\Trading;
use App\Models\Setting;
use Yajra\DataTables\DataTables;

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
    public function deposit()
    {
        $title="입금신청";
        $setting = Setting::find(1);
        $deposit_from = $setting->deposit_from;
        $deposit_to = $setting->deposit_to;
        $withdraw_from = $setting->withdraw_from;
        $withdraw_to = $setting->withdraw_to;
        return view('user.deposit', compact('title', 'deposit_from', 'deposit_to', 'withdraw_from', 'withdraw_to'));
    }    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function deposit_history()
    {
        $title="입금내역";
        
        return view('user.deposit', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function withdraw()
    {   
        $title="출금신청";
        $setting = Setting::find(1);
        $deposit_from = $setting->deposit_from;
        $deposit_to = $setting->deposit_to;
        $withdraw_from = $setting->withdraw_from;
        $withdraw_to = $setting->withdraw_to;
        return view('user.withdraw', compact('title', 'deposit_from', 'deposit_to', 'withdraw_from', 'withdraw_to'));
    }

        /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function withdraw_history()
    {
        $title="출금내역";
        return view('user.withdraw_history');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function exchange_history(Request $request)
    {
        $title="입출금내역";
        if ($request->ajax()) {
            $exchanges = Exchange::where('user_id', Auth::id())->orderBy('requested_date', 'DESC');

            return DataTables::of($exchanges)
                ->addIndexColumn()
                ->editColumn('type', function ($row) {
                    return $row->type == 1 ? "출금" : "입금";
                })
                ->editColumn('state', function ($row) {
                    return $row->state == 0 ? "대기" : ($row->state == 1 ? "승인" : "부결");
                })

                ->make(true);
        }
        return view('user.exchange_history', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function trading_history(Request $request)
    {
        $title="구매내역";
        if ($request->ajax()) {
            $exchanges = Trading::where('user_id', Auth::id())->orderBy('created_at', 'DESC');

            return DataTables::of($exchanges)
                ->addIndexColumn()
                
                ->editColumn('state', function ($row) {
                    return $row->state == 0 ? "구매" : ($row->state == 1 ? "정산" : "실격");
                })
                ->editColumn('coin_type', function ($row) {
                    return $row->coin->kor_name."($row->coin_type)";
                })
                ->make(true);
        }
        return view('user.trading_history', compact('title'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function result_history(Request $request)
    {
        $title="배당금지급내역";
        if ($request->ajax()) {
            $exchanges = Trading::where('user_id', Auth::id())->where('state', '!=', 0)->orderBy('created_at', 'DESC');

            return DataTables::of($exchanges)
                ->addIndexColumn()
                
                ->editColumn('state', function ($row) {
                    return $row->state == 0 ? "구매" : ($row->state == 1 ? "정산" : "실격");
                })

                ->make(true);
        }
        return view('user.result_history', compact('title'));
    }


}
