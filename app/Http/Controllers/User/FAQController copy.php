<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exchange;
use Yajra\DataTables\DataTables;

class FAQController extends Controller
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
            $qnas = FAQ::where('bIsDel', 0)
                ->orderBy('updated_at', 'DESC');

            return DataTables::eloquent($qnas)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    $check = '<input type="checkbox" name="chkProduct[]" onclick="" value="' . $row->nIdx . '">';
                    return $check;
                })

                ->addColumn('questionInfo', function ($row) {
                    $question = '<span data-id="' . $row->nIdx . '" style="cursor:pointer" class="btnEdit">' . $row->strQuestion . '</span>';
                    return $question;
                })
                ->addColumn('writer', function ($row) {
                    return '관리자';
                })
                ->rawColumns(['check', 'questionInfo'])
                ->make(true);
        }
        return view('contact.FAQManage', compact('title'));
    }

    /**
     * 상품등록선택후 마켓상품등록버튼
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show($id)
    {
        $faqInfo = FAQ::firstOrNew(['nIdx' => $id]);
        return view('contact.FAQDetail', compact('faqInfo', 'id'));
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
