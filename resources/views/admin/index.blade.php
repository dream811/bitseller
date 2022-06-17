@extends('include')
@section('content')
<input type="hidden" id="id_main" value="1">
<div class="wrapper">
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item"> <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a> </li>
		</ul>
		<!-- Right navbar links -->
		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<a class="nav-link" data-widget="fullscreen" href="#" role="button"> <i class="fas fa-expand-arrows-alt"></i> </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" onclick="window.location='/admin/onLogout'" role="button"> <i class="fas fa-sign-out-alt"></i> <span style="font-weight: bold;">로그아웃</span> </a>
			</li>
		</ul>
	</nav>
	<!-- /.navbar -->
	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="#" class="brand-link">
			<img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
			<span class="brand-text font-weight-light" style="font-family: -apple-system,BlinkMacSystemFont,'Malgun Gothic','맑은 고딕',helvetica,'Apple SD Gothic Neo',sans-serif;">아이디</span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- SidebarSearch Form -->
			<div class="form-inline" style="margin-top: 5px;">
				<div class="input-group">
					<input class="form-control form-control-sidebar" style="text-align: center;" ng-model="strServerTime" readonly disabled>
				</div>
			</div>
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-address-card"></i>
							<p> 총판관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/agent/list" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>총판목록</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-address-card"></i>
							<p> 회원관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/user/list" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>회원목록</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-gamepad"></i>
							<p> 게임관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/game/roomList" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>게임방관리</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper iframe-mode" data-widget="iframe" data-loading-screen="750">
		<div class="nav navbar navbar-expand navbar-white navbar-light border-bottom p-0">
			<div class="nav-item dropdown"> <a class="nav-link bg-danger dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Close</a>
				<div class="dropdown-menu mt-0"> <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all">Close All</a> <a class="dropdown-item" href="#" data-widget="iframe-close" data-type="all-other">Close All Other</a> </div>
			</div> <a class="nav-link bg-light" href="#" data-widget="iframe-scrollleft"><i class="fas fa-angle-double-left"></i></a>
			<ul class="navbar-nav overflow-hidden" role="tablist"></ul> <a class="nav-link bg-light" href="#" data-widget="iframe-scrollright"><i class="fas fa-angle-double-right"></i></a> <a class="nav-link bg-light" href="#" data-widget="iframe-fullscreen"><i class="fas fa-expand"></i></a> </div>
		<div class="tab-content">
			<div class="tab-empty">
				<h2 class="display-4">No tab selected!</h2> </div>
			<div class="tab-loading">
				<div>
					<h2><i class="fa fa-sync fa-spin"></i></h2> </div>
			</div>
		</div>
	</div>
	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Control sidebar content goes here -->
	</aside>
	<!-- /.control-sidebar -->
</div>

<div class="modal fade" id="modal-letter">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">쪽지보기</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-heading"></i>&nbsp;&nbsp;제목</span>
                        </div>
                        <input type="text" class="form-control" id="id_title" disabled>
                    </div>
                </div>
                <textarea id="summernote" style="height: 500px;" disabled>
                </textarea>
            </div>
        </div>
    </div>
</div>

<script>
function initialize()
{
	$('#summernote').summernote({
        placeholder: '내용을 입력하세요.',
        tabsize: 2,
        height: 300
    });
	scope.onShowLetter = onShowLetter;
}

function onClickAgentLetter()
{
	$('#id_agent_letter').click();
}

function onShowLetter(info)
{
    $('#id_title').val(info.strTitle);
    $('#summernote').summernote('code', info.strContent);

	http.get(`/agent/showAgentLetter?nLetter=${info.nSn}`).success(function(response)
	{
		if(response.nRetCode == 0x00)
		{
			scope.toastError(response.strValue);
		}
		else if(response.nRetCode == 0x01)
		{
			scope.toastSuccess(response.strValue);
		}
	});
}
</script>
@stop
