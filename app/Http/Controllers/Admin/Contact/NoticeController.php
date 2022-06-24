<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Notice;
use App\MyLibs\CoupangConnector;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class NoticeController extends Controller
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
        $title = "공지사항";


        if ($request->ajax()) {
            $qnas = Notice::where('bIsDel', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->nIdx . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '<button type="button" data-id="' . $row->nIdx . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDel">삭제</button>';
                    return $element;
                })
                ->addColumn('titleInfo', function ($row) {
                    $popup = '<span data-id="' . $row->nIdx . '" style="cursor:pointer" class="btnEdit">' . $row->strTitle . '</span>';
                    return $popup;
                })
                ->addColumn('popupInfo', function ($row) {
                    $popup = $row->bIsPopup == 1 ? "팝업공지" : "일반공지";
                    return $popup;
                })
                ->addColumn('writer', function ($row) {
                    $content = '관리자';
                    return $content;
                })
                ->rawColumns(['check', 'popupInfo', 'writer', 'titleInfo', 'action'])
                ->make(true);
        }
        return view('admin.contact.NoticeManage', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $noticeInfo = Notice::firstOrNew(['nIdx' => $id]);

        return view('admin.contact.NoticeDetail', compact('noticeInfo', 'id'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        Notice::updateOrCreate(
            ['nIdx' => $id],
            [
                'strContent' => $request->post('summernote'),
                'strTitle' => $request->post('txtTitle'),
                'bIsPopup' => $request->has('chkIsPopup') ? "1" : "0",
            ]
        );
        $data = '<script>alert("공지내용이 성과적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $qna = Notice::destroy($id);
        return response()->json(["status" => "success", "data" => '성과적으로 삭제되었습니다.']);
    }
}
