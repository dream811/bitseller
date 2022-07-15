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
                <h2 class="h6 pb-2 border-bottom">입출금</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-2">
                            <a href="{{ route('user.deposit') }}" class="btn d-inline-flex align-items-center collapsed " >입금신청</a>
                            <!-- <ul class="list-unstyled ps-3 collapse" id="components-collapse" href="#components" style="">
                                <li><a class="nav-link d-inline-flex align-items-center rounded" href="#accordion">입금신청</a></li>
                                <li><a class="nav-link d-inline-flex align-items-center rounded" href="#alerts">출금신청</a></li>
                            </ul> -->
                        </li>
                        <li class="mt-2">
                            <a href="{{ route('user.deposit') }}" class="active btn d-inline-flex align-items-center collapsed" >출금신청</a>
                        </li>
                        <li class="mt-2">
                            <a href="{{ route('user.exchange_history') }}" class="btn d-inline-flex align-items-center collapsed" >입출금내역</a>
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
                                    @csrf
                                    <div class="deposit-info mb-3">
                                        <div class="alert alert-success mb-0" role="alert">
                                            <h4 class="alert-heading">[출금 시 주의 사항] 반드시 읽어주세요!</h4>
                                            <p>출금 신청 후 최대 1시간 이내로 등록하신 계좌로 입금됩니다.</br>
                                            단, 은행 점검시간(매일 23:00~00:30) 또는 서버 작업이 진행 중일 때는 처리가 지체될 수 있습니다.</br>
                                            계좌변경은 고객센터로 문의부탁드립니다.</p>
                                            <hr>
                                            <p class="mb-0"> 입출금거래시간 입금 : {{$deposit_from}} ~ {{$deposit_to}} / 출금 : {{$withdraw_from}} ~ {{$withdraw_to}}</p>
                                        </div>
                                    </div>

                                    
                                    <div class="input-group mb-3">
                                        <span class="input-group-text " >계좌번호</span>
                                        <span class="form-control" type="text"  placeholder="" aria-label="">
                                            {{Auth::user()->bank_account}}
                                        </span>
                                        
                                    </div>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text " >&nbsp;예 금 주&nbsp;</span>
                                        <span class="form-control" type="text"  placeholder="" aria-label="">
                                            {{Auth::user()->bank_user}}
                                        </span>
                                        
                                    </div>
                                    <div class="form-floating custom-form-floating form-group mt-4 mb-3">
                                        <input ng-model="amount"  id="amount" name="amount" class="form-control" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                        <label for="amount" >신청금액</label>
                                    </div>
                                    <div class="text-center">                                            
                                        <button type="button" class="btn btn-primary btn-xs mr-2 mt-1" onclick="moneyPlus('50000');">50,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2 mt-1" onclick="moneyPlus('100000');">100,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2 mt-1" onclick="moneyPlus('500000');">500,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2 mt-1" onclick="moneyPlus('1000000');">1000,000</button>
                                        <button type="button" class="btn btn-warning btn-xs mr-2 mt-1" onclick="moneyPlus('reset');">정정</button>
                                    </div> 
                                    <br>
                                    <div class="text-center">
                                        <button class="btn btn-danger" type="button" ng-click="onWithdraw();">
                                            <span>출금신청</span>
                                            <svg class="rotate-n45" width="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </button>
                                    </div>
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