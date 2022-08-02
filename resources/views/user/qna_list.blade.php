@extends('user.layouts.app')
<span class="uisheet screen-darken"></span>
@section('script')
<script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script>
<script src="{{asset('user_assets/js/exchange/exchange.js')}}"></script>
@endsection
@section('content')  
<div class="container content-inner pb-0 mt-3">
    <div class="row">
        <div class=" body-class-1 container">
            <aside class="mobile-offcanvas bd-aside card iq-document-card sticky-xl-top text-muted align-self-start mt-3" style="width:200px;" id="left-side-bar">
                <div class="offcanvas-header p-0">  
                    <button class="btn-close float-end"></button>
                </div>
                <h2 class="h6 pb-2 border-bottom">문의하기</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <!-- <li class="mt-2">
                            <a href="{{ route('user.qna.edit', 0) }}" class=" btn d-inline-flex align-items-center collapsed " >문의하기</a>
                            
                        </li> -->
                        <li class="mt-2">
                            <a href="{{ route('user.qna') }}" class="active btn d-inline-flex align-items-center collapsed" >1:1문의내역</a>
                        </li>                        
                    </ul>
                </nav>
            </aside>
            <div class="container-fluid bg-trasprent mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="auth-form">
                                <div class="navbar-brand dis-none align-items-center justify-content-center mb-3">
                                    <h4 style="color:#fff" class="logo-title pt-2 text-center">{{$title}}</h4>
                                </div>
                                <div>
                                    <button class="btn btn-xs btn-success btnNew">문의하기</button>
                                    <button class="btn btn-xs btn-success btnReqAcc">계좌문의</button>
                                </div>
                                <hr>
                                <div class="" style="font-size:12px; color:#fff !important;">
                                <style>
                                    .dataTables_length {
                                        color: white !important;
                                    }

                                    .dataTables_filter {
                                        color: white !important;
                                    }

                                    .dataTables_info {
                                        color: white !important;
                                    }
                                </style>
                                <table id="qnaListTable" class="display nowrap table-dark table-bordered" style="width:100%">
                                    
                                </table>
                        </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });	
        var table = $('#qnaListTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "100%",
            orderable: false,
            info: false,
            sDom: "ltipr",
            ajax: {
                url: "{{ route('user.qna') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false},
                {title: "제목", data: 'title', name: 'title', orderable  : false , className:"text-center"},
                {title: "작성날짜", data: 'requested_date', name: 'requested_date', orderable  : false, className:"text-center"},
                {title: "구분", data: 'type', name: 'type', orderable  : false, className:"text-center"},
                {title: "답변날짜", data: 'answered_date', name: 'answered_date', orderable  : false, className:"text-center"},
                {title: "상태", data: 'action', name: 'action', orderable  : false, className:"text-center"},
            ],
            responsive: true, lengthChange: true,
            
        });
        $('body').on('click', '.btnEdit', function () {
            var id = $(this).attr('data-id');
            window.open('/qna/' + id, '수정', 'scrollbars=1, resizable=1, width=1000, height=620');
        });
        $('body').on('click', '.btnDetail', function () {
            var id = $(this).attr('data-id');
            window.open('/qna/' + id, '상세', 'scrollbars=1, resizable=1, width=1000, height=620');
        });
        $('body').on('click', '.btnNew', function () {
            window.open('/qna/0', '추가', 'scrollbars=1, resizable=1, width=800, height=620');
        });
        $('body').on('click', '.btnReqAcc', function () {

            var action = '/qna/0';
            //var data = $('#divProductForm').serialize();
            var data = { id: 0, type: 1, subject: "계좌문의", content: "계좌번호를 문의합니다."}
            $.ajax({
                url: action,
                data: data,
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        alert('계좌문의되었습니다.');
                        $('#qnaListTable').DataTable().ajax.reload();
                    }else{
                        alert(data.message);
                    }
                },
                error: function (data) {
                }
            });
        });
    </script>
@endpush