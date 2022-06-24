<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\MyLibs\CoupangConnector;
use App\Mylibs\Pbkdf2;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class UserManageController extends Controller
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
            $users = User::where('mb_is_del', 0)
                ->where('mb_level', '<', 9)
                ->orderBy('mb_name');

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('level', function ($row) {
                    $level = "신규";
                    switch ($row->mb_level) {
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
                ->addColumn('action', function ($row) {
                    $btn = '<button type="button" data-id="' . $row->mb_no . '" style="font-size:10px !important;" class="btn btn-xs btn-primary btnEdit">수정</button>';
                    $btn .= '<button type="button" data-id="' . $row->mb_no . '" style="font-size:10px !important;" class="ml-1 btn btn-xs btn-danger btnDelete">삭제</button>';
                    return $btn;
                })
                ->rawColumns(['action', 'level'])
                ->make(true);
        }
        return view('admin.user.UserManage', compact('title'));
    }

    //수정하려는 유저 선택(post)
    public function edit($userId = 0)
    {
        $title = "수정";
        if ($userId == 0) {
            $title = "추가";
        }

        $user = User::where('mb_is_del', 0)
            ->where('mb_no', $userId)
            ->firstOrNew();

        return view('admin.user.UserDetail', compact('title', 'userId', 'user'));
    }
    public function save(Request $request)
    {
        $path = $request->post('beforeImage');

        if ($request->file('fileImage')) {
            if ($path != "") {
                Storage::delete('public/' . $path);
            }

            $imageFile = $request->file('fileImage');
            $new_name = rand() . '.' . $imageFile->getClientOriginalExtension();
            $old_name = $imageFile->getClientOriginalName();
            $path = url('storage') . '/' . $request->file('fileImage')->storeAs('/uploads/profile_images', $new_name, 'public');
        }
        $data = [
            'mb_name' => $request->post('mb_name'),
            'mb_id' => $request->post('mb_id'),
            'mb_email' => $request->post('mb_email'),
            'mb_hp' => $request->post('mb_hp'),
            'mb_profile' => $path,
            //'bIsAdmin' => $request->post('selRole') == "ADMIN" ? 1 : 0,
            'sc_level' => $request->post('sc_level'),
            'mb_money' => $request->post('mb_money'),
            'mb_nick' => $request->post('mb_nick'),

            // 'business_number' => $request->post('txtBusinessNumber'),
            // 'business_phone' => $request->post('txtBusinessPhone'),
            // 'business_type' => $request->post('txtBusinessType'),
            // 'business_kind' => $request->post('txtBusinessKind'),
            'mb_zip1' => $request->post('mb_zip1'),
            'mb_addr1' => $request->post('mb_addr1'),
            'mb_addr2' => $request->post('mb_addr2'),
            // 'bIsUsed' => $request->post('rdoIsUsed'),
            'mb_is_del' => 0,
        ];
        if ($request->post('mb_no') == 0) {
            $data['zs_password']  = Hash::make($request->post('zs_password1'));
            $data['mb_password'] = Pbkdf2::create_hash($request->post('password'));
            $data['mb_level']  = 2;
        }
        $date = new DateTime;
        if ($request->post('is_use') == 0) {
            $data['mb_intercept_date']  = $date->format('Ymd');
        }
        $user = User::updateOrCreate(
            ['mb_no' => $request->post('mb_no')],
            $data
        );
        //$user->image = asset('storage/'. $user->image);
        return response()->json(["status" => "success", "data" => $user]);
    }

    public function checkIDEmail(Request $request)
    {
        $email = 1;
        $id = 1;
        if ($request->get('userId') == 0) {
            if (User::where('strID', $request->get('txtID'))->count()) {
                $id = 0;
            }
            if (User::where('email', $request->get('txtEmail'))->count()) {
                $email = 0;
            }
        } else {
            $user = User::where('id', '!=', $request->get('userId'));
            if ($user->where('strID', $request->get('txtID'))->count()) {
                $id = 0;
            }
            if ($user->where('email', $request->get('txtEmail'))->count()) {
                $email = 0;
            }
        }
        return response()->json(["status" => "success", "data" => compact('id', 'email')]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(0);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        return view('product.MarketIDList');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveMarketProduct(Request $request)
    {
        //$product  = Product::where('nIdx', $request->post('id'))->first();
        $product  = Product::where('nIdx', 1)->first();
        $coupang = new CoupangConnector();
        //$coupang->getCategoryInfoViaCode(56174);
        $coupang->getCategoryMetaInfo(56174);
        // $coupang->getCategoryListInfo();
        // $coupang->addOutboundShippingCenter();
        // $coupang->addReturnShippingCenter();
        $coupang->addProduct();
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }
    /**
     * Display the specified resource.
     *
     */
    public function accountShow($marketId = 0, $accountId = 0)
    {
        //
        // $marketAccount  = MarketAccount::where('nIdx', $accountId)->first();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    public function accountUpdate($marketId = 0, $accountId = 0, Request $request)
    {
        // $marketAccount = MarketAccount::find($accountId);
        // $marketAccount->strAccountId = $request->post('txtAccountId');
        // $marketAccount->strAccountPwd = $request->post('txtAccountPwd');
        // $marketAccount->strAPIAccessKey = $request->post('txtAPIAccessKey');
        // $marketAccount->update();
        return response()->json(["status" => "success", "data" => $marketAccount]);

        // $tr = new GoogleTranslate(); // Translates to 'en' from auto-detected language by default

        // $title = "오픈마켓계정관리";

        // $marketAccounts = MarketAccount::where('bIsDel', 0)
        //         ->where('nMarketIdx', $id)
        //         ->where('nUserId', Auth::id())
        //         ->orderBy('nIdx')->paginate(15);
        //dd($markets);
        // return view('operation.OpenMarketAccountManage', compact('title', 'markets'))
        //    ->with('i', (request()->input('page', 1) - 1) * 15);
        //return response()->json(["status" => "success", "data" => $marketAccount]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $accountId
     * @return \Illuminate\Http\Response
     */
    public function accountDelete($marketId, $accountId)
    {
        //
        //$marketAccount = MarketAccount::where('nIdx', $accountId)->delete();
        return response()->json(["status" => "success", "data" => $marketAccount]);
    }
}
