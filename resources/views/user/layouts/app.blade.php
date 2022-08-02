
<!doctype html>
<html lang="en">
 <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>COINEX</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('user_assets/images/favicon.ico')}}" />
      <link rel="stylesheet" href="{{asset('user_assets/css/libs.min.css')}}">
      <link rel="stylesheet" href="{{asset('user_assets/css/coinex.css?v=1.0.0')}}">
      <script src="/plugins/jquery/jquery.min.js"></script>
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
        <!-- jquery bootstrap data table -->
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
        <link rel="stylesheet" href="{{asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
      <!-- summernote -->
      <link rel="stylesheet" href="/plugins/summernote/summernote-bs4.min.css">
      <!-- Toastr -->
      <link rel="stylesheet" href="/plugins/toastr/toastr.min.css">

      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
      <script type="text/javascript" src="/plugins/angular.min.js"></script>
      <script type="text/javascript" src="/plugins/moment.js"></script>
      <script type="text/javascript" src="/plugins/numeral.min.js"></script>
      <script type="text/javascript" src="/js/constant.js?{{ time() }}"></script>
      <script type="text/javascript" src="/user_assets/js/include.js?{{ time() }}"></script>
      <script src="/plugins/jquery/jquery.min.js"></script>
      @yield('third_party_stylesheets')
      @stack('page_css')
</head>
  <body ng-app="myApp" ng-controller="myController" class="">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
   
    <main class="main-content">
      <div class="position-relative" >
      <input type="hidden" id="id_strAddress" 
      @guest
        value="ws://{{ env('EXPRESS_HOST') }}:{{ env('EXPRESS_PORT') }}"
      @else
        value="ws://{{ env('EXPRESS_HOST') }}:{{ env('EXPRESS_PORT') }}"
      @endguest
      >
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
        @include('user.layouts.menu')
      </div>
      <style>
        @media (max-width: 767.98px) {
            table.dataTable td {
                font-size: .8em;
                padding: 4px 2px;
            }
            table.dataTable td div span {
                font-size: 1.1em !important;
            }
            table.dataTable td div{
                font-size: 1.0em !important;
            }
            table.dataTable th {
                font-size: .9em;
            }
        }
      </style>
      @yield('content')      
        <footer class="footer">
            <div class="footer-body">
                <ul class="left-panel list-inline mb-0 p-0">
                    <li class="list-inline-item"><a href="../dashboard/extra/privacy-policy.html" class="text-white">개인정보처리방침</a></li>
                    <li class="list-inline-item"><a href="../dashboard/extra/terms-of-service.html" class="text-white">이용약관</a></li>
                </ul>
                <div class="right-panel">
                    ©<script>document.write(new Date().getFullYear())</script> COINEX
                    <span class="text-gray">
                        <svg width="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M15.85 2.50065C16.481 2.50065 17.111 2.58965 17.71 2.79065C21.401 3.99065 22.731 8.04065 21.62 11.5806C20.99 13.3896 19.96 15.0406 18.611 16.3896C16.68 18.2596 14.561 19.9196 12.28 21.3496L12.03 21.5006L11.77 21.3396C9.48102 19.9196 7.35002 18.2596 5.40102 16.3796C4.06102 15.0306 3.03002 13.3896 2.39002 11.5806C1.26002 8.04065 2.59002 3.99065 6.32102 2.76965C6.61102 2.66965 6.91002 2.59965 7.21002 2.56065H7.33002C7.61102 2.51965 7.89002 2.50065 8.17002 2.50065H8.28002C8.91002 2.51965 9.52002 2.62965 10.111 2.83065H10.17C10.21 2.84965 10.24 2.87065 10.26 2.88965C10.481 2.96065 10.69 3.04065 10.89 3.15065L11.27 3.32065C11.3618 3.36962 11.4649 3.44445 11.554 3.50912C11.6104 3.55009 11.6612 3.58699 11.7 3.61065C11.7163 3.62028 11.7329 3.62996 11.7496 3.63972C11.8354 3.68977 11.9247 3.74191 12 3.79965C13.111 2.95065 14.46 2.49065 15.85 2.50065ZM18.51 9.70065C18.92 9.68965 19.27 9.36065 19.3 8.93965V8.82065C19.33 7.41965 18.481 6.15065 17.19 5.66065C16.78 5.51965 16.33 5.74065 16.18 6.16065C16.04 6.58065 16.26 7.04065 16.68 7.18965C17.321 7.42965 17.75 8.06065 17.75 8.75965V8.79065C17.731 9.01965 17.8 9.24065 17.94 9.41065C18.08 9.58065 18.29 9.67965 18.51 9.70065Z" fill="currentColor"></path>
                        </svg>
                    </span> by <a href="#">Royal Dragon</a>.
                </div>
          </div>
        </footer>
    </main>
    <div id="back-to-top" style="display: none;">
        <a class="btn btn-primary btn-xs p-0 position-fixed top" id="top" href="#top">
            <svg width="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M5 15.5L12 8.5L19 15.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
    </div>
    <div class="middle" style="display: none;">
        <button data-trigger="left-side-bar" class="d-xl-none btn btn-xs mid-menu" type="button">
            <i class="icon">
                <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
            </i>
        </button>
    </div>
    <!-- Toastr -->
    <script src="/plugins/toastr/toastr.min.js"></script>
    <script src="/plugins/summernote/summernote-bs4.min.js"></script>
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
    <!-- DataTables  & Plugins -->
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
    @guest
    @else
    <script>
        getRealTimeInfo();
        setInterval(getRealTimeInfo, 5000);
        function getRealTimeInfo(){
            var action = '/user_info';
            $.ajax({
                url: action,
                type: "GET",
                dataType: 'json',
                success: function ({status, data}) {
                    $('.user_money').html(data.user_info.money);
                    $('.count-mail').html(data.user_info.msg_cnt);
                    // $('#new_user_cnt').text(data.new_users);
                    // $('#new_levelup_cnt').text(data.levelup_users);
                    // $('#new_deposit_cnt').text(data.new_deposits);
                    // $('#new_withdraw_cnt').text(data.new_withdraws);
                    // $('#new_qna_cnt').text(data.new_qnas);
                    // $('#new_acc_qna_cnt').text(data.new_acc_qnas);
                    // $('#new_trading_cnt').text(data.new_tradings);
                },
                error: function (data) {
                }
            });
        }
    </script>
    @endguest

    @yield('third_party_scripts')
    @yield('script')
    @stack('page_scripts')
  </body>
</html>