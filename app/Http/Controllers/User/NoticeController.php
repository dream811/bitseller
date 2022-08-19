<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Notice;
use Yajra\DataTables\DataTables;

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
            $notice = Notice::where('is_del', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($notice)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('writer', function ($row) {
                    $element = '관리자';
                    return $element;
                })
                ->addColumn('title', function ($row) {
                    $title = '<span data-id="' . $row->id . '" style="cursor:pointer" class="btnDetail">' . $row->subject . '</span>';
                    return $title;
                })
                ->rawColumns(['check', 'writer', 'title'])
                ->make(true);
        }
        return view('user.notice_list', compact('title'));
    }

    /**
     * 상품등록선택후 마켓상품등록버튼
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $noticeInfo = Notice::firstOrNew(['id' => $id]);
        return view('user.notice_detail', compact('noticeInfo', 'id'));
    }
    //문의내용 저장
    public function save($id, Request $request)
    {
        // FAQ::updateOrCreate(
        //     ['nIdx' => $id],
        //     [
        //         'strQuestion' => $request->post('txtQuestionTitle'),
        //         'strQuestionContent' => $request->post('summernote'),
        //         'dtQuestion' => Carbon::now()
        //     ]
        // );
        // $data = '<script>alert("문의가 성공적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        // return view('test', compact('data'));
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        // $qna = FAQ::destroy($id);
        // return response()->json(["status" => "success", "data" => '문의가 성과적으로 삭제되었습니다.']);
    }
}
