<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QNA;
use App\Models\User;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class QNAController extends Controller
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
        $title = "1대1문의";


        if ($request->ajax()) {
            $qnas = QNA::where('bIsDel', 0)
                ->orderBy('nIdx', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->nIdx . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->nIdx . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDel">삭제</button>';
                    return $element;
                })
                ->addColumn('questionInfo', function ($row) {
                    $question = '<span data-id="' . $row->nIdx . '" style="cursor:pointer" class="btnEdit">' . $row->strQuestionTitle . '</span>';
                    return $question;
                })
                ->addColumn('writer', function ($row) {
                    $user = User::where('mb_no', $row->nUserId)->first();
                    return $user->name;
                })
                ->editColumn('dtQuestion', function ($row) {
                    return date('Y-m-d', strtotime($row->dtQuestion));
                })
                ->editColumn('dtAnswered', function ($row) {
                    if ($row->bIsAnswered)
                        return date('Y-m-d', strtotime($row->dtAnswered));
                    else
                        return "";
                })
                ->rawColumns(['check', 'writer', 'questionInfo', 'action'])
                ->make(true);
        }
        return view('admin.contact.QNAManage', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $qnaInfo = QNA::firstOrNew(['nIdx' => $id]);

        return view('admin.contact.QNADetail', compact('qnaInfo', 'id'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        QNA::updateOrCreate(
            ['nIdx' => $id],
            [
                'strAnswer' => $request->post('summernote'),
                'dtAnswered' => Carbon::now(),
                'bIsAnswered' => '1'
            ]
        );
        $data = '<script>alert("답변이 성과적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        return view('test', compact('data'));
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $qna = QNA::destroy($id);
        return response()->json(["status" => "success", "data" => '문의가 성과적으로 삭제되었습니다.']);
    }
}
