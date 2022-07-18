


<!doctype html>
<html lang="en" >
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>COINEX | 회원가입</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="{{asset('user_assets/images/favicon.ico')}}" />
      <link rel="stylesheet" href="{{asset('user_assets/css/libs.min.css')}}">
      <link rel="stylesheet" href="{{asset('user_assets/css/coinex.css?v=1.0.0')}}">  </head>
  <body class="" data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
      <div style="background-image: url('{{asset('user_assets/images/auth/01.png')}}')" >  
        <div class="wrapper">
<section class="vh-100 bg-image">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="auth-form">
                                <h2 class="text-center mb-4">로그인</h2>
                                <form  method="POST" action="{{ route('login') }}">
                                @csrf
                                    <p></p>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="이메일">
                                        <label for="email">이메일</label>
                                    </div>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                     <div class="form-floating mb-2">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="비밀번호">
                                        <label for="password">비밀번호</label>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <div class="d-flex justify-content-between  align-items-center flex-wrap">
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"  id="remember"  {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="remember">비밀번호 기억하기{{--{{ __('Remember Me') }}--}}</label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <a href="{{ route('password.request') }}">비밀번호 찾기</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                                    </div>
                                    <!-- <div class="text-center mt-3">
                                        <p>or sign in with others account?</p>
                                    </div>
                                     <div class="d-flex justify-content-center ">
                                        <ul class="list-group list-group-horizontal   list-group-flush">
                                            <li class="list-group-item bg-transparent border-0">
                                            <a href="#"><img src="{{asset('user_assets/images/brands/01.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="img60"></a>
                                            </li>
                                            <li class="list-group-item bg-transparent border-0">
                                            <a href="#"><img src="{{asset('user_assets/images/brands/02.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="gm"></a>
                                            </li>
                                            <li class="list-group-item bg-transparent border-0">
                                            <a href="#"><img src="{{asset('user_assets/images/brands/03.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="im"></a>
                                            </li>
                                            <li class="list-group-item bg-transparent border-0">
                                            <a href="#"><img src="{{asset('user_assets/images/brands/04.png')}}" class="img-fluid avatar avatar-30 avatar-rounded" alt="li"></a>
                                            </li>
                                        </ul>
                                    </div> -->
                                </form>
                                <div class="new-account mt-3 text-center">
                                    <p>계정이 없으신가요? <a class="" href="{{route('register')}}">회원등록</a></p>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
        </div>
      </div>
      
    
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