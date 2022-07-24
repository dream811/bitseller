@extends('admin.layouts.app')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0" style="">{{$title}}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">관리자</a></li>
                    <li class="breadcrumb-item"><a href="#">고객센터</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <!-- <ul class="nav float-right">
                            <li class="pull-right float-right pr-1 pt-1" style="">
                                <a href="javascript:void(0)" class="btn btn-success btn-sm btnAdd" >새로 작성</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="card-body" >
                        <form id="divForm">
                            <table id="Table" class="table  table-hover table-bordered table-striped projects text-xs" cellspacing="0" width="100%">
                                
                            </table>
                        </form>
                    </div>
                        
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
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
        var table = $('#Table').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "640px",
            pageLength: 100,
            // fixedHeader: true,
            ajax: {
                url: "{{ route('admin.qna.list') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false},
                {title: "제목", data: 'subject', name: 'subject', orderable  : false , className:"text-center"},
                {title: "작성날짜", data: 'requested_date', name: 'requested_date', orderable  : false, className:"text-center"},
                {title: "구분", data: 'type', name: 'type', orderable  : false, className:"text-center"},
                {title: "작성자", data: 'user_name', name: 'user_name', orderable  : false, className:"text-center"},
                {title: "답변날짜", data: 'answered_date', name: 'answered_date', orderable  : false, className:"text-center"},
                {title: "조작", data: 'action', name: 'action', orderable  : false, width:"80px", className:"text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#Table_wrapper .col-md-6:eq(0)');
        $('body').on('click', '.btnEdit', function () {
            var qnaId = $(this).attr('data-id');
            window.open('/admin/contact/qna/' + qnaId, '문의 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnAdd', function () {
            //var coinId = $(this).attr('data-id');
            window.open('/admin/contact/qna/0', '문의 작성', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnDelete', function () {
            if(!confirm('한번 삭제한 자료는 되살릴수 없습니다. 정말삭제하시겠습니까?')){return}
            var qnaId = $(this).attr('data-id');
            var action = '/admin/contact/qna/' + qnaId;
            
            $.ajax({
                url: action,
                data: {status},
                type: "DELETE",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        refreshTable();
                        alert('문의가 삭제되었습니다.');
                    }else{
                        alert('문의삭제에 실패하였습니다.');
                    }
                },
                error: function (data) {
                }
            });
        });
        // $('body').on('change', '.chk-is-use', function () {
        //     var status = $(this).is(':checked') ? 1 : 0;
        //     if(!confirm('사용상태를 변경하시겠습니까?')){$(this).prop('checked', status == 1 ? false : true);return}
        //     var coinId = $(this).attr('data-id');
        //     var action = '/admin/contact/state/' + coinId;
            
        //     $.ajax({
        //         url: action,
        //         data: {status},
        //         type: "POST",
        //         dataType: 'json',
        //         success: function ({status, data}) {
        //             if(status == "success"){
        //                 alert('사용상태가 변경되었습니다.');
        //             }else{
        //                 alert('사용상태 변경에 실패하였습니다.');
        //             }
        //         },
        //         error: function (data) {
        //         }
        //     });
        // });
        function refreshTable() {
            $('#Table').DataTable().ajax.reload();
        }
        
    </script>
@endpush