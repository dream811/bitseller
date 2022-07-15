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
            <aside class="mobile-offcanvas bd-aside card iq-document-card sticky-xl-top text-muted align-self-start mt-3"  style="width:200px;" id="left-side-bar">
                <div class="offcanvas-header p-0">  
                    <button class="btn-close float-end"></button>
                </div>
                <h2 class="h6 pb-2 border-bottom">거래방법</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-2">
                            <a href="{{ route('user.deposit') }}" class="active btn d-inline-flex align-items-center collapsed " >거래방법</a>
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
                            <div class="card-body d-flex align-items-center justify-content-center">
                                <div class="auth-form">
                                    <div class="navbar-brand dis-none align-items-center justify-content-center mb-3">
                                        <h4 style="color:#fff" class="logo-title pt-2 text-center">{{$title}}</h4>
                                    </div>
                                    <form>
                                        {!!$guide!!}
                                    </form>                                    
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