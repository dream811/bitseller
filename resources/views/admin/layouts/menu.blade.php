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
					<li class="nav-item {{ (request()->routeIs('admin.user*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.user*')) ? 'active' : '' }}"> <i class="fas fa-address-card"></i>
							<p> 회원관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.new_list') }}" class="nav-link {{ (request()->routeIs('admin.user.new_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>신규회원목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.list') }}" class="nav-link {{ (request()->routeIs('admin.user.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>회원목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.levelup_list') }}" class="nav-link {{ (request()->routeIs('admin.user.levelup_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>레벨업회원목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.user.level_list') }}" class="nav-link {{ (request()->routeIs('admin.user.level_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>등급관리</p>
								</a>
							</li>
						</ul>
					</li>
					{{-- <li class="nav-item {{ (request()->routeIs('admin.cash.cash_list')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link  {{ (request()->routeIs('admin.cash.cash_list')) ? 'active' : '' }}"> <i class="fas fa-hand-holding-usd"></i>
							<p> 파트너관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 0) }}" class="nav-link {{ (request()->is('admin/cash/cash/0')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>파트너목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 1) }}" class="nav-link {{ (request()->is('admin/cash/cash/1')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>입금신청</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 1) }}" class="nav-link {{ (request()->is('admin/cash/cash/1')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>출금신청</p>
								</a>
							</li>
						</ul>
					</li> --}}
					<li class="nav-item {{ (request()->routeIs('admin.cash.cash_list')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link  {{ (request()->routeIs('admin.cash.cash_list')) ? 'active' : '' }}"> <i class="fas fa-hand-holding-usd"></i>
							<p> 입출금관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 0) }}" class="nav-link {{ (request()->is('admin/cash/cash/0')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>입금관리</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.cash.cash_list', 1) }}" class="nav-link {{ (request()->is('admin/cash/cash/1')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>출금관리</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item {{ (request()->routeIs('admin.coin*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.coin*')) ? 'active' : '' }}"> <i class="fas fa-coins"></i>
							<p> 코인관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/coin/list" class="nav-link {{ (request()->routeIs('admin.coin.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>코인목록</p>
								</a>
							</li>
						</ul>
                        
					</li>
                    <li class="nav-item {{ (request()->routeIs('admin.calculate*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.calculate*')) ? 'active' : '' }}"> <i class="fas fa-calculator"></i>
							<p> 정산관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/schedule" class="nav-link {{ (request()->routeIs('admin.calculate.schedule_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>정산시간설정</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/trading" class="nav-link {{ (request()->routeIs('admin.calculate.trading_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>구매목록</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="/admin/calculate/result" class="nav-link {{ (request()->routeIs('admin.calculate.result_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>배당금지급내역</p>
								</a>
							</li>
						</ul>
					</li>
					<li class="nav-item {{ (request()->is('admin/contact*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->is('admin/contact*')) ? 'active' : '' }}"> <i class="fas fa-user-astronaut"></i>
							<p> 고객관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.msg.list') }}" class="nav-link {{ (request()->routeIs('admin.msg.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>쪽지관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.qna.list') }}" class="nav-link {{ (request()->routeIs('admin.qna.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>1:1문의관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.qna.acc_list') }}" class="nav-link {{ (request()->routeIs('admin.qna.acc_list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>계좌문의관리</p>
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('admin.notice.list') }}" class="nav-link {{ (request()->routeIs('admin.notice.list')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>공지사항</p>
								</a>
							</li>
						</ul>
					</li>
                    <li class="nav-item  {{ (request()->routeIs('admin.setting*')) ? 'menu-open' : '' }}">
						<a href="#" class="nav-link {{ (request()->routeIs('admin.setting*')) ? 'active' : '' }}"> <i class="fas fa-cogs"></i>
							<p> 설정관리 <i class="right fas fa-angle-left"></i> </p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.guide') }}" class="nav-link {{ (request()->routeIs('admin.setting.guide')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>거래방법</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.bank') }}" class="nav-link {{ (request()->routeIs('admin.setting.bank')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>은행업무설정</p>
								</a>
							</li>
						</ul>
						{{-- <ul class="nav nav-treeview">
							<li class="nav-item">
								<a href="{{ route('admin.setting.bank') }}" class="nav-link {{ (request()->routeIs('admin.setting.bank')) ? 'active' : '' }}">
									<i class="far fa-circle nav-icon"></i>
									<p>사이트설정</p>
								</a>
							</li>
						</ul> --}}
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->