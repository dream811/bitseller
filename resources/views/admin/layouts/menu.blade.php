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
					<!-- <li class="nav-item">
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
					</li> -->
					<li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-address-card"></i>
							<p> 회원관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.new_list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>신규회원목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>회원목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.level_list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>등급관리</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-address-card"></i>
							<p> 입출금관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 0) }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>입금관리</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 1) }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>출금관리</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-gamepad"></i>
							<p> 코인관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/coin/list" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>코인목록</p>
								</a>
							</li>
						</ul>
                        
					</li>
                    <li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-gamepad"></i>
							<p> 정산관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/schedule" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>정산시간설정</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/trading" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>구매목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/result" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>배당금지급내역</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-gamepad"></i>
							<p> 고객관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.msg.list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>쪽지관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.qna.list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>문의관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.notice.list') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>공지사항</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item">
						<a href="#" class="nav-link"> <i class="fas fa-gamepad"></i>
							<p> 설정관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.guide') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>거래방법</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.bank') }}" class="nav-link">
									<i class="far fa-circle nav-icon"></i>
									<p>은행업무설정</p>
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->