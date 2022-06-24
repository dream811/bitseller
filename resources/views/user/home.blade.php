@extends('user.layouts.app')
@section('script')
<script src="https://cdn.datatables.net/colreorder/1.5.6/js/dataTables.colReorder.min.js"></script>
<script src="{{asset('user_assets/js/home/home.js')}}"></script>
@endsection
@section('content')  
<div class="container content-inner pb-0">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        {{-- <div class="card-header d-flex justify-content-between flex-wrap">
                            <div class="header-title">
                                <h5 class="card-title mb-2" style="font-size: 14px;"></h5>
                            </div>
                            <div class="d-flex align-items-center align-self-center">
                                <div class="d-flex align-items-center">
                                    <div class="form-check active" >
                                    <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                    <label class="form-check-label" for="flexRadioDefault1">ETH
                                    </label>
                                    </div>
                                </div>
                                
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                                <div id="tradingview_ea4a3"></div>
                                
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                new TradingView.widget(
                                {
                                    "width": '100%',
                                    "height": 300,
                                    "symbol": "BINANCE:BTCUSDT",
                                    "interval": "D",
                                    "timezone": "Etc/UTC",
                                    "theme": "dark",
                                    "style": "1",
                                    "locale": "kr",
                                    "toolbar_bg": "#f1f3f6",
                                    "enable_publishing": false,
                                    "allow_symbol_change": true,
                                    "container_id": "tradingview_ea4a3"
                                }
                                );
                                </script>
                            </div>
                            <!-- TradingView Widget END -->
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12">
                    <div class="card card-block card-stretch custom-scroll">
                        <div class="card-header d-flex flex-wrap justify-content-between align-items-center">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive" style="font-size:12px; color:#fff !important;">
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
                            <table id="example" class="display nowrap table-dark table-bordered" style="width:100%">
                                <thead style="background-color: #19191A;">
                                    <tr>
                                        <th>이름</th>
                                        <th>현재가</th>
                                        <th>마켓가</th>
                                        <th>전일대비</th>
                                        <th class="min-phone-l">고가대비(52주)</th>
                                        <th class="min-phone-l">저가대비(52주)</th>
                                        <th>거래액(일)</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align:right">
                                    <tr ng-repeat="info in lstCoinData" >
                                        <td style="text-align:left;">
                                            <img style="vertical-align: baseline; display: inline-block;" src="!%info.img_coin%!" class="img-fluid avatar avatar-30 avatar-rounded" alt="">
                                            <span  style="display: inline-block;">
                                                <div>!%info.name_kor%!</div>
                                                <div>!%info.name_eng%!</div>
                                            </span>
                                        </td>
                                        <td>
                                            <div>!%info.cur_price1%!</div>
                                            <div>!%info.cur_price2%!</div>
                                        </td>
                                        <td>
                                            <div>
                                                <svg ng-show="info.kimp_per_1 < 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"></path>
                                                </svg>
                                                <svg ng-show="info.kimp_per_1 > 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"></path>
                                                </svg>
                                                <span ng-class="{'text-danger' : info.kimp_per_1 < 0, 'text-success' : info.kimp_per_1 > 0}">!%(Math.abs(info.kimp_per_1))%!%</span>
                                            </div>
                                            <div>
                                                <span class="text-gray">!%(info.kimp_amt)%!</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <svg ng-show="info.comp_yesterday_per < 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"></path>
                                                </svg>
                                                <svg ng-show="info.comp_yesterday_per > 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"></path>
                                                </svg>
                                                <span ng-class="{'text-danger' : info.comp_yesterday_per < 0, 'text-success' : info.comp_yesterday_per > 0}">!%(Math.abs(info.comp_yesterday_per))%!%</span>
                                            </div>
                                            <div>
                                                <span class="text-gray">!%(info.comp_yesterday_amt)%!</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <svg ng-show="info.comp_highest_per < 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"></path>
                                                </svg>
                                                <svg ng-show="info.comp_highest_per > 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"></path>
                                                </svg>
                                                <span ng-class="{'text-danger' : info.comp_highest_per < 0, 'text-success' : info.comp_highest_per > 0}">!%(Math.abs(info.comp_highest_per))%!%</span>
                                            </div>
                                            <div>
                                                <span class="text-gray">!%(info.comp_highest_amt)%!</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <svg ng-show="info.comp_lowest_per < 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"></path>
                                                </svg>
                                                <svg ng-show="info.comp_lowest_per > 0" width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"></path>
                                                </svg>
                                                <span ng-class="{'text-danger' : info.comp_lowest_per < 0, 'text-success' : info.comp_lowest_per > 0}">!%(Math.abs(info.comp_lowest_per))%!%</span>
                                            </div>
                                            <div>
                                                <span class="text-gray">!%(info.comp_lowest_amt)%!</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="text-gray">!%(info.trade_amt1)%!</span>
                                            </div>
                                            <div>
                                                <span class="text-gray">!%(info.trade_amt2)%!</span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    $('#example').DataTable(
                                        {
                                            paging: false,
                                            info: false,
                                            sDom: "ltipr",
                                            colReorder: {
                                                realtime: false
                                            }
                                        }
                                    );
                                });
                            </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @if(Auth::check())
            {{--  --}}
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="position: fixed; z-index: 99;">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div class="auth-form">
                                <div class="navbar-brand dis-none align-items-center justify-content-center">
                                    <h4 style="color:#fff" class="logo-title pt-2 text-center">코인주문</h4>
                                </div>
                                {{-- <div>
                                    <h6 class="card-title">입금계좌</h6>
                                    <p class="card-text">하나은행</p>
                                </div>
                                    <div>
                                    <h6 class="card-title">본인계좌</h6>
                                    <p class="card-text">농협은행</p>
                                </div>
                                <br> --}}
                                <form>
                                    <div class="input-group input-group-sm mb-3">
                                        <span class="input-group-text input-group-text-sm" id="basic-addon1">구입코인</span>
                                        <!-- <input type="text" class="form-control form-control-sm" placeholder="" aria-label="Username" aria-describedby="basic-addon1"> -->
                                        <select id="coin_type" ng-change="ChangeCoinType()" name="coin_type" ng-model="filterCondition.value" class="form-select form-select-sm">
                                            <option
                                                ng-selected="info.name_eng == filterCondition.value"
                                                ng-repeat="info in lstCoinData"
                                                value="!%info.name_eng%!" 
                                            >!%info.name_kor%!</option>
                                            
                                        </select>
                                    </div>
                                    
                                    <!-- <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3" >
                                        <input id="amount" value="1000" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example" disabled>
                                        <label for="amount" style="z-index:-10000">보유머니</label>
                                    </div> -->
                                    <div class="input-group input-group-sm mb-3">
                                        <span id="amount" class="form-control form-control-sm" type="text" placeholder="" aria-label="">
                                        !% orderAmount / lstCoinData[filterCondition.key].cur_price1_1 %!
                                        </span>
                                        <span class="input-group-text input-group-text-sm" id="coin-type">!%filterCondition.value%!</span>
                                    </div>
                                    <!-- <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                        <input id="amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                        <label for="amount">주문코인</label>
                                    </div> -->
                                    
                                    <div class="input-group input-group-sm mb-3">
                                        <span id="amount" class="form-control form-control-sm" type="text"  placeholder="" aria-label="">
                                        !% lstCoinData[filterCondition.key].cur_price1_1 %!
                                        </span>
                                        <span class="input-group-text input-group-text-sm" id="coin-type">매수가격</span>
                                    </div>
                                    <div class="text-center">                                            
                                        <button type="button" class="btn btn-primary btn-xs mr-2" onclick="moneyPlus('50000');">50,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2" onclick="moneyPlus('100000');">100,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2" onclick="moneyPlus('500000');">500,000</button>
                                        <button type="button" class="btn btn-primary btn-xs mr-2" onclick="moneyPlus('1000000');">1000,000</button>
                                        <button type="button" class="btn btn-warning btn-xs mr-2" onclick="moneyPlus('reset');">정정</button>
                                    </div> 
                                    <div class="form-floating custom-form-floating custom-form-floating-sm form-group mt-4 mb-3">
                                        <input id="order_amount" name="order_amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                        <label for="order_amount" style="font-size:12px;">주문금액</label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-success btn-sm" type="button" ng-click="BuyCoin();">
                                            <span>구매</span>
                                            <svg class="rotate-45" width="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                        </button>
                                    </div>
                                </form>                                    
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @else
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div class="auth-form">
                                <div class="navbar-brand dis-none align-items-center justify-content-center">
                                    <svg width="36" class="text-primary" style="margin-left: 2rem; float:left;" viewBox="0 0 128 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g>
                                            <path d="M117.348 105.33C117.594 105.476 117.669 105.799 117.508 106.036C110.26 116.759 99.5876 125.042 87.0232 129.687C74.2883 134.395 60.2849 135.117 47.0817 131.745C33.8785 128.372 22.1759 121.086 13.7027 110.961C5.22957 100.836 0.43531 88.4101 0.0282348 75.5189C-0.37884 62.6276 3.62286 49.9548 11.4421 39.3726C19.2614 28.7905 30.4835 20.8602 43.4505 16.7536C56.4176 12.6469 70.4417 12.5815 83.4512 16.5672C96.2865 20.4995 107.462 28.1693 115.375 38.4663C115.55 38.6939 115.495 39.0214 115.256 39.1813L97.3742 51.176C97.1539 51.3238 96.8567 51.2735 96.6942 51.0637C91.6372 44.53 84.5205 39.6627 76.3537 37.1606C68.031 34.6109 59.0591 34.6527 50.7636 37.2799C42.468 39.9071 35.2888 44.9804 30.2865 51.7502C25.2842 58.5201 22.7241 66.6274 22.9846 74.8745C23.245 83.1215 26.3121 91.0709 31.7327 97.5482C37.1533 104.025 44.64 108.687 53.0866 110.844C61.5332 113.002 70.4918 112.54 78.6389 109.528C86.6324 106.573 93.4288 101.316 98.0645 94.5111C98.2142 94.2913 98.5086 94.2233 98.7376 94.3583L117.348 105.33Z" fill="#FF971D"></path>
                                            <path d="M53.2837 0.5C53.2837 0.223858 53.5075 0 53.7837 0H75.6195C75.8957 0 76.1195 0.223858 76.1195 0.5V26.25H53.2837V0.5Z" fill="#FF971D"></path>
                                            <path d="M53.2837 123.75H76.1195V149.5C76.1195 149.776 75.8957 150 75.6195 150H53.7837C53.5075 150 53.2837 149.776 53.2837 149.5V123.75Z" fill="#FF971D"></path>
                                        </g>
                                    </svg>
                                    <h4 style="color:#fff" style="float:left;" class="logo-title pt-2">OINEX 로그인</h4>
                                    
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <p></p>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
                                        <label for="email">메일</label>
                                    </div>
                                        <div class="form-floating mb-2">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        <label for="password">비번</label>
                                    </div>
                                    <div class="d-flex justify-content-between  align-items-center flex-wrap">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"   name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">Remember me?</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">로그인</button>
                                        <button type="button" class="btn btn-danger">회원가입</button>
                                    </div>
                                    
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            @endif
            
        </div>
    </div>
</div>
@endsection