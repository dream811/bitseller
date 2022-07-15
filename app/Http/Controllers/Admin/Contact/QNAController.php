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
            $qnas = QNA::where('is_del', 0)
                ->orderBy('id', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->id . '">';
                    return $check;
                })
                ->addColumn('action', function ($row) {
                    $element = '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-success btnEdit">수정</button>';
                    $element .= '&nbsp;&nbsp;<button type="button" data-id="' . $row->id . '" style="font-size:10px !important;" class="btn btn-xs btn-secondary btnDelete">삭제</button>';
                    return $element;
                })
                ->editColumn('type', function ($row) {
                    $type = $row->type == 1 ? "계좌문의" : "일반문의";
                    return $type;
                })
                ->editColumn('requested_date', function ($row) {
                    return date('Y-m-d', strtotime($row->requested_date));
                })
                ->editColumn('answered_date', function ($row) {
                    if ($row->is_answer)
                        return date('Y-m-d', strtotime($row->answered_date));
                    else
                        return "";
                })
                ->rawColumns(['check', 'action'])
                ->make(true);
        }
        return view('admin.contact.qna_list', compact('title'));
    }

    /**
     * 문의 현시
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $qnaInfo = QNA::firstOrNew(['id' => $id]);
        $title = "작성";
        if($id == 0){
            $title = "수정";
        }
        return view('admin.contact.qna_detail', compact('qnaInfo', 'id', 'title'));
    }
    //답변 저장
    public function save($id, Request $request)
    {
        QNA::updateOrCreate(
            ['id' => $id],
            [
                'answer' => $request->post('answer'),
                'answered_date' => Carbon::now(),
                'is_answer' => '1'
            ]
        );
        // $data = '<script>alert("답변이 성과적으로 등록되었습니다.");window.opener.location.reload();window.close();</script>';
        // return view('test', compact('data'));
        return response()->json(["status" => "success", "data" => '답변이 성과적으로 등록되었습니다.']);
    }
    //문의내용 삭제
    public function delete($id, Request $request)
    {
        $qna = QNA::destroy($id);
        return response()->json(["status" => "success", "data" => '답변이 성과적으로 삭제되었습니다.']);
    }
}
