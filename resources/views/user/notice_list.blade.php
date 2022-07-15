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
                <h2 class="h6 pb-2 border-bottom">공지사항</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-2">
                            <a href="{{ route('user.notice') }}" class="active btn d-inline-flex align-items-center collapsed " >공지</a>
                            <!-- <ul class="list-unstyled ps-3 collapse" id="components-collapse" href="#components" style="">
                                <li><a class="nav-link d-inline-flex align-items-center rounded" href="#accordion">입금신청</a></li>
                                <li><a class="nav-link d-inline-flex align-items-center rounded" href="#alerts">출금신청</a></li>
                                
                            </ul> -->
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
                                <table id="noticeListTable" class="display nowrap table-dark table-bordered" style="width:100%">
                                    
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
        var table = $('#noticeListTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "100%",
            orderable: false,
            info: false,
            sDom: "ltipr",
            ajax: {
                url: "{{ route('user.notice') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false},
                {title: "제목", data: 'title', name: 'title', orderable  : false ,className:"text-center"},
                {title: "작성일", data: 'updated_at', name: 'updated_at', orderable  : false,className:"text-center"},
                {title: "작성자", data: 'writer', name: 'writer', orderable  : false,className:"text-center"},
            ],
            responsive: true, lengthChange: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
        });
        $('body').on('click', '.btnDetail', function () {
            var id = $(this).attr('data-id');
            window.open('notice/' + id, '공지내용', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush