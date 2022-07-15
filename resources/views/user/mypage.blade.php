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
                <h2 class="h6 pb-2 border-bottom">내정보</h2>
                <nav class="small" id="elements-section">
                    <ul class="list-unstyled mb-0">
                        <li class="mt-2">
                            <a href="{{ route('user.deposit') }}" class="active btn d-inline-flex align-items-center collapsed " >나의정보</a>
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
                                <form id="infoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4 form-group">
                                            <div class="profile-img-edit position-relative">
                                                <img class="img-fluid avatar avatar-100 avatar-rounded" src="/user_assets/images/avatars/01.png" alt="profile-pic">
                                                <!-- <div class="upload-icone bg-primary">
                                                    <svg class="upload-button" width="14" height="14" viewBox="0 0 24 24">
                                                        <path fill="#ffffff" d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"></path>
                                                    </svg>
                                                    <input class="file-upload" type="file" accept="image/*">
                                                </div> -->
                                            </div>
                                            
                                        </div>
                                        <div class="col-8">
                                            <div class="pt-2 text-right">
                                                <h5 class="counter" style="visibility: visible;"><small>보유머니: {{Auth::user()->money}}원</small>
                                                    
                                                </h5>
                                                <div class="pt-1">
                                                    <div class="pb-3">
                                                    <small>이름: &nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->name}}</small>  <br>
                                                    <small>등급: &nbsp;&nbsp;&nbsp;&nbsp;{{Auth::user()->userLevel->name}}</small>  
                                                    </div> 
                                                </div>                       
                                            </div>                                                                              
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="deposit-info mb-3">
                                            <div class="alert alert-success mb-0" role="alert">
                                                <h4 class="alert-heading">주의사항!</h4>
                                                <p>이메일과 은행정보 변경요청은 고객센터로 문의부탁드립니다.</p>
                                                
                                                @if(Auth::user()->userLevel->can_buy == 0)
                                                    <hr><p class="mb-0">현재 구매 할 수 있는 수량이 없습니다. 다음 시간대에 구매하여 주세요.</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->str_id}}
                                                </span>
                                                <label for="str_id">아이디</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" value="{{Auth::user()->nickname}}" name="nickname" id="nickname" placeholder="닉네임">
                                                <label for="nickname">닉네임</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="password" id="password" placeholder="password">
                                                <label for="password">비밀번호</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-4">
                                            <button class="mt-2 btn btn-success changePassword" type="button">
                                                <span>비번변경</span>
                                                <svg class="rotate-45" width="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row" id="divChangePassword" style="display:none">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="비밀번호">
                                                <label for="new_password">비밀번호</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="new_password_confirm" id="new_password_confirm" placeholder="비밀번호 확인">
                                                <label for="new_password_confirm">비밀번호 확인</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <!-- <input type="text" class="form-control" id="firstName" value="브론즈" readonly placeholder="FirstName"> -->
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->userLevel->name}}
                                                </span>
                                                <label for="firstName">등급</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->userBank->name}}
                                                </span>
                                                <label for="lastName">은행명</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->bank_user}}
                                                </span>
                                                <label for="firstName">예금주</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->bank_account}}
                                                </span>
                                                <label for="lastName">계좌번호</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <!-- <input type="text" class="form-control" id="firstName" value="브론즈" readonly placeholder="FirstName"> -->
                                                <span class="form-control" type="text"  placeholder="" aria-label="">
                                                    {{Auth::user()->email}}
                                                </span>
                                                <label for="firstName">이메일</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="phone" id="phone" value="{{Auth::user()->phone}}" placeholder="8자이상특수문자포함">
                                                <label for="phone">전화번호</label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="text-center">
                                        <button class="btn btn-success changeInfo" type="button" >
                                            <span>수정</span>
                                            <svg class="rotate-45" width="14" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.75 11.7256L4.75 11.7256" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M13.7002 5.70124L19.7502 11.7252L13.7002 17.7502" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>
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

@push('page_scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });	
        
        $('body').on('click', '.changePassword', function () {
            var password = $('#password').val();

            if(password == ""){
                alert('비밀번호를 입력하세요.');
                return;
            }

            
            var action = '/check_password';
            //var data = $('#divProductForm').serialize();
            var data = { password }
            $.ajax({
                url: action,
                data: data,
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        $('#divChangePassword').show();
                    }else{
                        alert(data.message);
                    }
                },
                error: function (data) {
                }
            });
        });
        $('body').on('click', '.changeInfo', function () {
            if($('#divChangePassword').is(':visible')){
                if($('#new_password').val() == ""){
                    alert('새 비밀번호를 입력하세요.');
                    return;
                }
                if($('#new_password_confirm').val() == ""){
                    alert('새 비밀번호를 확인하세요.');
                    return;
                }
                if($('#new_password_confirm').val() != $('#new_password').val()){
                    alert('비밀번호가 일치하지 않습니다.');
                    return;
                }
            }
            if($('#nickname').val() =="" ){
                alert('닉네임을 입력하세요');
                return;
            }
            if($('#phone').val() =="" ){
                alert('전화번호를 입력하세요');
                return;
            }
            if(!confirm('정보를 수정하시겠습니까')){
                return false;
            }
            
            var action = '/change_info';
            var data = $('#infoForm').serialize();
            $.ajax({
                url: action,
                data: data,
                type: "POST",
                dataType: 'json',
                success: function ({status, data}) {
                    if(status == "success"){
                        alert(data.message);
                    }else{
                        alert(data.message);
                    }
                },
                error: function (data) {
                }
            });
        });

        $('body').on('click', '.btnAdd', function () {
            window.open('/admin/user/userManage/edit/0', '정보 추가', 'scrollbars=1, resizable=1, width=800, height=620');
            return false;
        });
    </script>
@endpush