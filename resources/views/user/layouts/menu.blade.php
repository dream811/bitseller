<!--Nav Start-->
<nav class="navbar navbar-expand-md navbar-dark fixed-top border-bottom iq-navbar" style="background-color:#202022">
    <div class="container navbar-inner">
        <a href="/" class="navbar-brand">                                    
            <svg width="36" class="text-primary" style="margin-left: 2rem; float:left;" viewBox="0 0 128 150" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g>
                    <path d="M117.348 105.33C117.594 105.476 117.669 105.799 117.508 106.036C110.26 116.759 99.5876 125.042 87.0232 129.687C74.2883 134.395 60.2849 135.117 47.0817 131.745C33.8785 128.372 22.1759 121.086 13.7027 110.961C5.22957 100.836 0.43531 88.4101 0.0282348 75.5189C-0.37884 62.6276 3.62286 49.9548 11.4421 39.3726C19.2614 28.7905 30.4835 20.8602 43.4505 16.7536C56.4176 12.6469 70.4417 12.5815 83.4512 16.5672C96.2865 20.4995 107.462 28.1693 115.375 38.4663C115.55 38.6939 115.495 39.0214 115.256 39.1813L97.3742 51.176C97.1539 51.3238 96.8567 51.2735 96.6942 51.0637C91.6372 44.53 84.5205 39.6627 76.3537 37.1606C68.031 34.6109 59.0591 34.6527 50.7636 37.2799C42.468 39.9071 35.2888 44.9804 30.2865 51.7502C25.2842 58.5201 22.7241 66.6274 22.9846 74.8745C23.245 83.1215 26.3121 91.0709 31.7327 97.5482C37.1533 104.025 44.64 108.687 53.0866 110.844C61.5332 113.002 70.4918 112.54 78.6389 109.528C86.6324 106.573 93.4288 101.316 98.0645 94.5111C98.2142 94.2913 98.5086 94.2233 98.7376 94.3583L117.348 105.33Z" fill="#FF971D"></path>
                    <path d="M53.2837 0.5C53.2837 0.223858 53.5075 0 53.7837 0H75.6195C75.8957 0 76.1195 0.223858 76.1195 0.5V26.25H53.2837V0.5Z" fill="#FF971D"></path>
                    <path d="M53.2837 123.75H76.1195V149.5C76.1195 149.776 75.8957 150 75.6195 150H53.7837C53.5075 150 53.2837 149.776 53.2837 149.5V123.75Z" fill="#FF971D"></path>
                </g>
            </svg>
            <p class="h4 mt-2">OINEX</p>
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
                <a href="{{ route('user.notice') }}"  class="nav-link" id="notification-drop" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    공지사항
                    <span class="bg-danger dots"></span>
                </a>
            </li>
            <li class="nav-item dropdown" style="float: left">
                <a href="{{ route('user.guide') }}"  class="active nav-link" id="notification-drop1" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    거래방법
                    <span class="bg-danger dots"></span>
                </a>
            </li>
            <li class="nav-item dropdown" style="float: left">
                <a href="{{ route('user.trading_history') }}"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    거래내역
                    <span class="bg-danger dots"></span>
                </a>
                <div class="sub-drop dropdown-menu dropdown-menu-end p-0 mt-2" aria-labelledby="mail-drop">
                    <div class="card shadow-none m-0">
                        <div class="card-body p-0 ">
                            <a href="{{ route('user.trading_history') }}" class="iq-sub-card">
                                <div class="d-flex ">
                                    <div class=" w-100 ms-3">
                                    <h6 class="mb-2 ">구매내역</h6>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('user.result_history') }}" class="iq-sub-card">
                                <div class="d-flex ">
                                    <div class=" w-100 ms-3">
                                    <h6 class="mb-2 ">배당금지급내역</h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown" style="float: left">
                <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    입출금
                    <span class="bg-danger dots"></span>
                </a>
                <div class="sub-drop dropdown-menu dropdown-menu-end p-0 mt-2" aria-labelledby="mail-drop">
                    <div class="card shadow-none m-0">
                    <div class="card-body p-0 ">
                        <a href="{{ route('user.deposit') }}" class="iq-sub-card">
                            <div class="d-flex ">
                                <div class=" w-100 ms-3">
                                <h6 class="mb-2 ">입금신청</h6>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('user.withdraw') }}" class="iq-sub-card">
                            <div class="d-flex ">
                                <div class=" w-100 ms-3">
                                <h6 class="mb-2 ">출금신청</h6>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('user.exchange_history') }}" class="iq-sub-card">
                            <div class="d-flex ">
                                <div class=" w-100 ms-3">
                                <h6 class="mb-2 ">입출금내역</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown" style="float: left">
                <a href="{{ route('user.qna') }}"  class="nav-link" id="notification-drop" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    문의하기
                    <span class="bg-danger dots"></span>
                </a>
            </li>
            <li class="nav-item dropdown" style="float: left">
                <a href="{{ route('user.mypage') }}"  class="nav-link" id="notification-drop" style="color: #fff; font-weight: 500; font-size: calc(1rem ); font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">
                    내정보
                    <span class="bg-danger dots"></span>
                </a>
            </li>
            <!--<li class="nav-item dropdown">
                <a href="#"  class="nav-link" id="notification-drop" data-bs-toggle="dropdown" >
                    <svg width="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 17.8476C17.6392 17.8476 20.2481 17.1242 20.5 14.2205C20.5 11.3188 18.6812 11.5054 18.6812 7.94511C18.6812 5.16414 16.0452 2 12 2C7.95477 2 5.31885 5.16414 5.31885 7.94511C5.31885 11.5054 3.5 11.3188 3.5 14.2205C3.75295 17.1352 6.36177 17.8476 12 17.8476Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M14.3889 20.8572C13.0247 22.3719 10.8967 22.3899 9.51953 20.8572" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>                            
                    <span class="bg-danger dots"></span>
                </a>
                 <div class="sub-drop dropdown-menu iq-noti dropdown-menu-end p-0" aria-labelledby="notification-drop">
                    <div class="card shadow-none m-0">
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
            </li> -->
            <li class="nav-item dropdown" >
                <a href="{{route('user.message')}}" class="nav-link" id="mail-drop"  aria-haspopup="true" aria-expanded="false">
                    <svg width="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9028 8.85107L13.4596 12.4641C12.6201 13.1301 11.4389 13.1301 10.5994 12.4641L6.11865 8.85107" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M16.9089 21C19.9502 21.0084 22 18.5095 22 15.4384V8.57001C22 5.49883 19.9502 3 16.9089 3H7.09114C4.04979 3 2 5.49883 2 8.57001V15.4384C2 18.5095 4.04979 21.0084 7.09114 21H16.9089Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>                            
                    @if(Auth::check())
                    <span id="cntMessage" class="bg-primary count-mail bg-round" style="padding-left:1px; padding-right:1px; width:25px; font-size:12px;border-radius: 10px; margin-left:-10px;margin-top: -20px !important;color: red;">
                        {{count(Auth::user()->new_messages)}}
                    </span>
                    @endif
                </a>
                <!-- <div class="sub-drop dropdown-menu dropdown-menu-end p-0 mt-2" aria-labelledby="mail-drop">
                    <div class="card shadow-none m-0">
                    <div class="card-body p-0 ">
                        <a href="{{ route('user.deposit') }}" class="iq-sub-card">
                            <div class="d-flex ">
                                <div class=" w-100 ms-3">
                                <h6 class="mb-2 ">입금신청</h6>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('user.withdraw') }}" class="iq-sub-card">
                            <div class="d-flex ">
                                <div class=" w-100 ms-3">
                                <h6 class="mb-2 ">출금신청</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    </div>
                </div> -->
            </li>
            @guest
                <li class="nav-item dropdown ms-auto" style="float: right;">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <div class="caption ms-3 ">
                        <h6 class="mb-0 caption-title text-xs" style="font-size:12px;"><a href="{{route('login')}}">회원가입</a></h6>
                        <p class="mb-0 caption-sub-title text-xs" style="font-size:12px;"><a href="{{route('register')}}">회원등록</p>
                    </div>
                    </a>
                    
                </li>
            @else
                <li class="nav-item dropdown ms-auto" style="float: right;">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('user_assets/images/avatars/01.png')}}" alt="User-Profile" class="img-fluid avatar avatar-30 avatar-rounded">
                    <div class="caption ms-3 ">
                        <h6 class="mb-0 caption-title text-xs" style="font-size:12px;">{{Auth::user()->name}}({{Auth::user()->userLevel->name}})</h6>
                        <p class="mb-0 caption-sub-title text-xs" style="font-size:12px;"><span id="user_money" value="user_money">{{Auth::user()->money}}</span>원</p>
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                        <input type="hidden" name="user_password" id="user_password" value="{{Auth::user()->password}}">
                    </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-xs" aria-labelledby="navbarDropdown">
                    <li class="border-0"><a class="dropdown-item" href="{{route('user.mypage')}}">나의 정보</a></li>
                    {{-- <li class="border-0"><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li> --}}
                    @if(Auth::user()->isAdmin())
                        <li class="border-0"><a class="dropdown-item" href="/admin">관리자 페이지</a></li>
                    @endif
                    <li class="border-0"><hr class="m-0 dropdown-divider"></li>
                    <li class="border-0"><a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</a></li>
                                {{-- {{ __('Logout') }} --}}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            @endguest                            
            </ul>
        </div>
    </div>
</nav>
{{--<nav class="nav navbar navbar-expand-lg  iq-navbar border-bottom">
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
            @guest
                <li class="nav-item dropdown ms-auto" style="float: right;">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    
                    <div class="caption ms-3 ">
                        <h6 class="mb-0 caption-title text-xs" style="font-size:12px;">회원가입</h6>
                        <p class="mb-0 caption-sub-title text-xs" style="font-size:12px;">회원등록</p>
                    </div>
                    </a>
                    
                </li>
            @else
                <li class="nav-item dropdown ms-auto" style="float: right;">
                    <a class="nav-link py-0 d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('user_assets/images/avatars/01.png')}}" alt="User-Profile" class="img-fluid avatar avatar-30 avatar-rounded">
                    <div class="caption ms-3 ">
                        <h6 class="mb-0 caption-title text-xs" style="font-size:12px;">{{Auth::user()->name}}(3급)</h6>
                        <p class="mb-0 caption-sub-title text-xs" style="font-size:12px;"><span>{{Auth::user()->money}}</span>원</p>
                        <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                        <input type="hidden" name="user_password" id="user_password" value="{{Auth::user()->password}}">
                    </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end text-xs" aria-labelledby="navbarDropdown">
                    <li class="border-0"><a class="dropdown-item" href="../dashboard/app/user-profile.html">마이 페이지</a></li>
                    <!-- <li class="border-0"><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li> -->
                    <li class="border-0"><hr class="m-0 dropdown-divider"></li>
                    <li class="border-0"><a class="dropdown-item" href="{{ route('logout') }}" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">로그아웃</a></li>
                                {{ __('Logout') }}
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            @endguest
                            
            </ul>
        </div>
    </div>
</nav>   
--}}
<!--Nav End-->