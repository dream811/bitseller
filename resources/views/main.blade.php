
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>COINEX | Responsive Bootstrap 5 Admin Dashboard Template</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('user_assets/images/favicon.ico')}}" />
      <link rel="stylesheet" href="{{asset('user_assets/css/libs.min.css')}}">
      <link rel="stylesheet" href="{{asset('user_assets/css/coinex.css?v=1.0.0')}}">  </head>
  <body class=" ">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
   
    <main class="main-content">
      <div class="position-relative">
          
        <!--로고 Start-->
        <div class="container pt-2">
            <a href="../../dashboard/index.html" class="navbar-brand dis-none align-items-center justify-content-center">
                <svg width="36" class="text-primary" style="margin-left: 2rem; float:left;" viewBox="0 0 128 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g>
                        <path d="M117.348 105.33C117.594 105.476 117.669 105.799 117.508 106.036C110.26 116.759 99.5876 125.042 87.0232 129.687C74.2883 134.395 60.2849 135.117 47.0817 131.745C33.8785 128.372 22.1759 121.086 13.7027 110.961C5.22957 100.836 0.43531 88.4101 0.0282348 75.5189C-0.37884 62.6276 3.62286 49.9548 11.4421 39.3726C19.2614 28.7905 30.4835 20.8602 43.4505 16.7536C56.4176 12.6469 70.4417 12.5815 83.4512 16.5672C96.2865 20.4995 107.462 28.1693 115.375 38.4663C115.55 38.6939 115.495 39.0214 115.256 39.1813L97.3742 51.176C97.1539 51.3238 96.8567 51.2735 96.6942 51.0637C91.6372 44.53 84.5205 39.6627 76.3537 37.1606C68.031 34.6109 59.0591 34.6527 50.7636 37.2799C42.468 39.9071 35.2888 44.9804 30.2865 51.7502C25.2842 58.5201 22.7241 66.6274 22.9846 74.8745C23.245 83.1215 26.3121 91.0709 31.7327 97.5482C37.1533 104.025 44.64 108.687 53.0866 110.844C61.5332 113.002 70.4918 112.54 78.6389 109.528C86.6324 106.573 93.4288 101.316 98.0645 94.5111C98.2142 94.2913 98.5086 94.2233 98.7376 94.3583L117.348 105.33Z" fill="#FF971D"></path>
                        <path d="M53.2837 0.5C53.2837 0.223858 53.5075 0 53.7837 0H75.6195C75.8957 0 76.1195 0.223858 76.1195 0.5V26.25H53.2837V0.5Z" fill="#FF971D"></path>
                        <path d="M53.2837 123.75H76.1195V149.5C76.1195 149.776 75.8957 150 75.6195 150H53.7837C53.5075 150 53.2837 149.776 53.2837 149.5V123.75Z" fill="#FF971D"></path>
                    </g>
                </svg>
                <h4 style="color:#fff" style="float:left;" class="logo-title pt-2">OINEX</h4>
            </a>
            
        </div>
        <!--로고 End-->
        <!--Nav Start-->
        <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar border-bottom">
          <div class="container navbar-inner">
            <a href="../dashboard/index.html" class="navbar-brand">
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon">
                  <span class="navbar-toggler-bar bar1 mt-2"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav navbar-list mb-2 mb-lg-0 align-items-center" style="width:100%;">
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        공지사항
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        거래방법
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        거래내역
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        입출금
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        문의하기
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown" style="float: left">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                        내정보
                        <span class="bg-danger dots"></span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" >
                      <svg width="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.3889 20.8572C13.0247 22.3719 10.8967 22.3899 9.51953 20.8572" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>                            
                      <span class="bg-danger dots"></span>
                    </a>
                    <div class="sub-drop dropdown-menu iq-noti dropdown-menu-end p-0" aria-labelledby="notification-drop">
                        <div class="card shadow-none m-0">
                          <div class="card-header d-flex justify-content-between">
                              <div class="header-title">
                                <p class="fs-6 ">New notifications.</p>
                              </div>
                              <div class="header-title">
                                <p class="fs-6">Mark all</p>
                              </div>
                          </div>
                          <div class="card-body p-0">
                              <a href="#" class="iq-sub-card">
                                <div class="d-flex">
                                    <img src="{{asset('user_assets/images/utilities/05.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img51"><div class="ms-3 w-100">
                                      <h6 class="mb-0 ">Successfull transaction og 0.01 BTC</h6>
                                      <div class="d-flex justify-content-between align-items-center">
                                          <p class="mb-0">15 mins ago</p>
                                          </div>
                                    </div>
                                </div>
                              </a>
                              
                          </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item dropdown" >
                  <a href="#" class="nav-link" id="mail-drop" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
                    <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9028 8.85107L13.4596 12.4641C12.6201 13.1301 11.4389 13.1301 10.5994 12.4641L6.11865 8.85107" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                            
                    <span class="bg-primary count-mail"></span>
                  </a>
                  <div class="sub-drop dropdown-menu dropdown-menu-end p-0" aria-labelledby="mail-drop">
                      <div class="card shadow-none m-0">
                        <div class="card-header d-flex justify-content-between py-3">
                            <div class="header-title">
                              <p class="mb-0 text-white">Our Latest News</p>
                            </div>
                        </div>
                        <div class="card-body p-0 ">
                            <a href="#" class="iq-sub-card">
                              <div class="d-flex ">
                                  <div class="">
                                    <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img55">
                                  </div>
                                  <div class=" w-100 ms-3">
                                    <h6 class="mb-0 ">Bitcoin</h6>
                                    <small class="float-left font-size-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </small>
                                  </div>
                              </div>
                            </a>
                            <a href="#" class="iq-sub-card">
                              <div class="d-flex">
                                  <div class="">
                                    <img src="{{asset('user_assets/images/coins/03.png')}}" class="img-fluid avatar avatar-50 avatar-rounded" alt="img56">
                                  </div>
                                  <div class="ms-3">
                                    <h6 class="mb-0 ">Ethereum</h6>
                                    <small class="float-left font-size-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry. </small>
                                  </div>
                              </div>
                            </a>
                            <a href="#" class="iq-sub-card">
                              <div class="d-flex">
                                  <div class="">
                                    <img src="{{asset('user_assets/images/coins/06.png')}}" class="img-fluid avatar avatar-50 avatar-rounded')}}" alt="img57">
                                  </div>
                                  <div class="ms-3">
                                    <h6 class="mb-0 ">Litecoin</h6>
                                    <small class="float-left font-size-12">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                  </div>
                              </div>
                            </a>
                        </div>
                      </div>
                  </div>
                </li>
                @if (Auth::check())
                <li class="nav-item dropdown ms-auto" style="float: right;">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset('user_assets/images/avatars/01.png')}}" alt="User-Profile" class="img-fluid avatar avatar-30 avatar-rounded">
                      <div class="caption ms-3 ">
                          <h6 class="mb-0 caption-title text-xs" style="font-size:12px;">Wade Warren</h6>
                          <p class="mb-0 caption-sub-title text-xs" style="font-size:12px;">Super Admin</p>
                      </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-xs" aria-labelledby="navbarDropdown">
                      <li class="border-0"><a class="dropdown-item" href="../dashboard/app/user-profile.html">마이 페이지</a></li>
                      {{-- <li class="border-0"><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li> --}}
                      <li class="border-0"><hr class="m-0 dropdown-divider"></li>
                      <li class="border-0"><a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</a></li>
                                {{-- {{ __('Logout') }} --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                  </li>
                @else
                    
                @endif
                                
              </ul>
            </div>
          </div>
        </nav>        
        <!--Nav End-->
      </div>
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
                            <div class="caption">
                                <h4 class="font-weight-bold mb-2">Recent Trading Activities</h4>
                                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                <input type="checkbox" class="btn-check" id="btncheck1">
                                <label class="btn btn-sm btn-secondary active rounded-start" for="btncheck1">Monthly</label>

                                <input type="checkbox" class="btn-check" id="btncheck2">
                                <label class="btn btn-sm btn-secondary " for="btncheck2">Weekly</label>

                                <input type="checkbox" class="btn-check" id="btncheck3">
                                <label class="btn btn-sm btn-secondary rounded-end" for="btncheck3">Today</label>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table data-table mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">24h %</th>
                                        <th scope="col">7d %</th>
                                        <th scope="col">Market Cap</th>
                                        <th scope="col">Volume(24th)</th>
                                        <th scope="col">Circulating</th>
                                        <th scope="col">Last 7 Days</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img23" />
                                                Bitcoin BTC<a class="button btn-primary badge ms-2" type="button">Buy</a>
                                            </td>
                                            <td class="pe-2">$40,501.87</td>
                                            <td class="text-danger"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"/>
                                                </svg>
                                                6.93%
                                            </td>
                                            <td class="text-success"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"/>
                                                </svg>
                                                4.58%
                                            </td>
                                            <td>$123,456,789,159</td>
                                            <td>$373,359,580,155<br>
                                                <small class="ms-5">635,237 BTC</small>
                                            </td>
                                            <td class="ms-5">18,777,768 BTC</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                <div id="sparklinechart-1"></div>             
                                                <div class="dropdown ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton10">
                                                        <li><a class="dropdown-item" href="#">View Charts</a></li>
                                                        <li><a class="dropdown-item" href="#">View Markets</a></li>
                                                        <li><a class="dropdown-item" href="#">View Historical Data</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img23" />
                                                Ethereum ETH<a class="button btn-primary badge ms-2" type="button">Buy</a>
                                            </td>
                                            <td class="pe-2">$2,796.60</td>
                                            <td class="text-danger"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"/>
                                                </svg>
                                                3.33%
                                            </td>
                                            <td class="text-success"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"/>
                                                </svg>
                                                15.45%
                                            </td>
                                            <td>$123,456,789,159</td>
                                            <td>$373,359,580,155<br>
                                                <small class="ms-5">635,237 BTC</small>
                                            </td>
                                            <td class="ms-5">18,777,768 BTC</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                <div id="sparklinechart-2"></div>             
                                                <div class="dropdown ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton10">
                                                        <li><a class="dropdown-item" href="#">View Charts</a></li>
                                                        <li><a class="dropdown-item" href="#">View Markets</a></li>
                                                        <li><a class="dropdown-item" href="#">View Historical Data</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img23" />
                                                Monero XMR<a class="button btn-primary badge ms-2" type="button">Buy</a>
                                            </td>
                                            <td class="pe-2">$1.00</td>
                                            <td class="text-success"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"/>
                                                </svg>
                                                0.01%
                                            </td>
                                            <td class="text-danger"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"/>
                                                </svg>
                                                0.02%
                                            </td>
                                            <td>$123,456,789,159</td>
                                            <td>$373,359,580,155<br>
                                                <small class="ms-5">635,237 BTC</small>
                                            </td>
                                            <td class="ms-5">18,777,768 BTC</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                <div id="sparklinechart-3"></div>             
                                                <div class="dropdown ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton10">
                                                        <li><a class="dropdown-item" href="#">View Charts</a></li>
                                                        <li><a class="dropdown-item" href="#">View Markets</a></li>
                                                        <li><a class="dropdown-item" href="#">View Historical Data</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img23" />
                                                Litecoin LTC<a class="button btn-primary badge ms-2" type="button">Buy</a>
                                            </td>
                                            <td class="pe-2">$40,501.87</td>
                                            <td class="text-danger"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"/>
                                                </svg>
                                                6.93%
                                            </td>
                                            <td class="text-success"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"/>
                                                </svg>
                                                4.58%
                                            </td>
                                            <td>$123,456,789,159</td>
                                            <td>$373,359,580,155<br>
                                                <small class="ms-5">635,237 BTC</small>
                                            </td>
                                            <td class="ms-5">18,777,768 BTC</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                <div id="sparklinechart-4"></div>             
                                                <div class="dropdown ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton10">
                                                        <li><a class="dropdown-item" href="#">View Charts</a></li>
                                                        <li><a class="dropdown-item" href="#">View Markets</a></li>
                                                        <li><a class="dropdown-item" href="#">View Historical Data</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="white-space-no-wrap">
                                            <td>
                                                <img src="{{asset('user_assets/images/coins/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img23" />
                                                Bitcoin BTC<a class="button btn-primary badge ms-2" type="button">Buy</a>
                                            </td>
                                            <td class="pe-2">$40,501.87</td>
                                            <td class="text-success"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 0.5L7.4641 5H0.535898L4 0.5Z" fill="#00EC42"/>
                                                </svg>
                                                6.93%
                                            </td>
                                            <td class="text-danger"><svg width="10" height="8" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M4 4.5L0.535898 0L7.4641 0L4 4.5Z" fill="#FF2E2E"/>
                                                </svg>
                                                4.58%
                                            </td>
                                            <td>$123,456,789,159</td>
                                            <td>$373,359,580,155<br>
                                                <small class="ms-5">635,237 BTC</small>
                                            </td>
                                            <td class="ms-5">18,777,768 BTC</td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                <div id="sparklinechart-5"></div>             
                                                <div class="dropdown ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" id="dropdownMenuButton10" data-bs-toggle="dropdown" aria-expanded="false" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                                    </svg>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton10">
                                                        <li><a class="dropdown-item" href="#">View Charts</a></li>
                                                        <li><a class="dropdown-item" href="#">View Markets</a></li>
                                                        <li><a class="dropdown-item" href="#">View Historical Data</a></li>
                                                    </ul>
                                                </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
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
                                            <input type="email" class="form-control" id="email" placeholder="name@example.com">
                                            <label for="email">메일</label>
                                        </div>
                                            <div class="form-floating mb-2">
                                            <input type="password" class="form-control" id="password" placeholder="Password">
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

                {{--  --}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
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
                                        <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                            <input id="amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                            <label for="amount">보유머니</label>
                                        </div>
                                        <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                            <input id="amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                            <label for="amount">주문코인</label>
                                        </div>
                                        <div class="form-floating custom-form-floating custom-form-floating-sm form-group mb-3">
                                            <input id="amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                            <label for="amount">매수가격</label>
                                        </div>
                                        <div class="text-center">                                            
                                            <button type="button" class="btn btn-primary btn-xs mr-2">50,000</button>
                                            <button type="button" class="btn btn-primary btn-xs mr-2">100,000</button>
                                            <button type="button" class="btn btn-primary btn-xs mr-2">500,000</button>
                                            <button type="button" class="btn btn-primary btn-xs mr-2">1000,000</button>
                                            <button type="button" class="btn btn-warning btn-xs mr-2">정정</button>
                                        </div> 
                                        <div class="form-floating custom-form-floating custom-form-floating-sm form-group mt-4 mb-3">
                                            <input id="amount" class="form-control form-control-sm" type="number" placeholder=".form-control-sm" aria-label=".form-control-sm example">
                                            <label for="amount">주문금액</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-primary">회원가입</button>
                                            <button type="button" class="btn btn-danger">회원가입</button>
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
      <footer class="footer">
          <div class="footer-body">
              <ul class="left-panel list-inline mb-0 p-0">
                  <li class="list-inline-item"><a href="../dashboard/extra/privacy-policy.html" class="text-white">Privacy Policy</a></li>
                  <li class="list-inline-item"><a href="../dashboard/extra/terms-of-service.html" class="text-white">Terms of Use</a></li>
              </ul>
              <div class="right-panel">
                  ©<script>document.write(new Date().getFullYear())</script> COINEX, Made with
                  <span class="text-gray">
                      <svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
                      </svg>
                  </span> by <a href="https://iqonic.design/">IQONIC Design</a>.
              </div>
          </div>
      </footer>    </main>
     
    <!-- Wrapper End-->
    <!-- offcanvas start -->

    <!-- Backend Bundle JavaScript -->
    <script src="{{asset('user_assets/js/libs.min.js')}}"></script>
    <!-- widgetchart JavaScript -->
    <script src="{{asset('user_assets/js/charts/widgetcharts.js')}}"></script>
    <!-- fslightbox JavaScript -->
    <script src="{{asset('user_assets/js/fslightbox.js')}}"></script>
    <!-- app JavaScript -->
    <script src="{{asset('user_assets/js/app.js')}}"></script>
    <!-- apexchart JavaScript -->
    <script src="{{asset('user_assets/js/charts/apexcharts.js')}}"></script>
  </body>
</html>