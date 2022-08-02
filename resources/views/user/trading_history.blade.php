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
                <h2 class="h6 pb-2 border-bottom">거래내역</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-2">
                            <a href="{{ route('user.trading_history') }}" class=" btn d-inline-flex align-items-center collapsed " >구매내역</a>
                        </li>
                        <li class="mt-2">
                            <a href="{{ route('user.result_history') }}" class="btn d-inline-flex align-items-center collapsed" >배당금지급내역</a>
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
                                <table id="tradingHistoryTable" class="display nowrap table-dark table-bordered" style="width:100%">
                                    
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
        var table = $('#tradingHistoryTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: "100%",
            orderable: false,
            info: false,
            sDom: "ltipr",
            ajax: {
                url: "{{ route('user.trading_history') }}"
            },
            columns: [
                {title: "No", data: 'DT_RowIndex', name: 'DT_RowIndex', 'render' : null, orderable  : false, 'searchable' : false},
                {title: "신청일시", data: 'created_at', name: 'created_at', orderable  : false ,className:"text-center"},
                {title: "코인명", data: 'coin_type', name: 'coin_type', orderable  : false,className:"text-center"},
                {title: "매수가격", data: 'cur_price', name: 'cur_price', orderable  : false, className:"text-end"},
                {title: "수량", data: 'coin_quantity', name: 'coin_quantity', orderable  : false, className:"text-end"},
                {title: "총구매액", data: 'order_amount', name: 'order_amount', orderable  : false,className:"text-center"},
            ],
            responsive: true, lengthChange: true,
            
        });
        $('body').on('click', '.btnEdit', function () {
            var userId = $(this).attr('data-id');
            window.open('/admin/user/userManage/edit/' + userId, '정보 수정', 'scrollbars=1, resizable=1, width=1000, height=620');
            return false;
        });
        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush