<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

	<div class="sidebar-header">
		<div class="sidebar-title">
			Navigation
		</div>
		<div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
			<i class="fas fa-bars" aria-label="Toggle sidebar"></i>
		</div>
	</div>

	<div class="nano">
		<div class="nano-content">
			@if(!Auth()->check())
				<nav id="menu" class="nav-main" role="navigation">
					<ul class="nav nav-main">
						<li>
							<a class="nav-link" href="/login">
								<i class="fas fa-sign-in-alt" aria-hidden="true"></i>
								<span>Sign In</span>
							</a>
						</li>
						<li>
							<a class="nav-link" href="/register">
								<i class="fas fa-user-plus" aria-hidden="true"></i>
								<span>Sign Up</span>
							</a>
						</li>
					</ul>
				</nav>
			@else
				<nav id="menu" class="nav-main" role="navigation">

					<ul class="nav nav-main">
						<li class="nav-active nav-expanded">
							<a class="nav-link" href="/ucp">
								<i class="fas fa-home" aria-hidden="true"></i>
								<span>Dashboard</span>
							</a>
						</li>
						<li>
							<a class="nav-link" href="/faction">
								<i class="fas fa-users" aria-hidden="true"></i>
								<span>Factions</span>
							</a>
						</li>
						<li class="nav-parent">
							<a class="nav-link" href="#">
								<i class="fas fa-user" aria-hidden="true"></i>
								<span>Characters</span>
							</a>
							<ul class="nav nav-children">
								@if(Auth()->user()->confirmed == 0)
									<li>
										<a class="nav-link" href="/characters">
											Application
										</a>
									</li>
								@else
									@foreach(auth()->user()->character()->get() as $character)
										<li>
											<a class="nav-link" href="/view/character/{{ $character->id }}">
												{{ $character->firstname }} {{ $character->lastname }}
											</a>
										</li>
									@endforeach
								@endif
							</ul>
						</li>
						<li class="nav-parent">
							<a class="nav-link" href="#">
								<i class="fas fa-shopping-cart" aria-hidden="true"></i>
								<span>Webshop</span>
							</a>
							<ul class="nav nav-children">
								<li>
									<a class="nav-link" href="/funds/redeem">
										Shop
									</a>
								</li>
								<li>
									<a class="nav-link" href="/funds/redeem/history">
										History
									</a>
								</li>
								<li>
									<a class="nav-link" href="/funds">
										Add funds
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a class="nav-link" href="/xmr/request">
								<i class="fas fa-broadcast-tower" aria-hidden="true"></i>
								<span>XMR</span>
							</a>
						</li>
					</ul>
				</nav>
				@if(!is_null(Auth()->user()->role) && Auth()->user()->role->role_id > 0)
				<hr class="separator" />
				<div class="sidebar-widget widget-tasks">
					<div class="widget-header">
						<h6>Administration</h6>
					</div>
				</div>
				<nav id="menu" class="nav-main" role="navigation">
					<ul class="nav nav-main">
						@if(Auth()->user()->role->role_id >= 1)
							<li class="nav-parent">
								<a class="nav-link" href="#">
									<i class="fas fa-cog" aria-hidden="true"></i>
									<span>Tester</span>
								</a>
								<ul class="nav nav-children">
									<li>
										<a class="nav-link" href="tester/applications">
											<span class="float-right badge badge-primary">{{ number_format(App\Models\Application::count()) }}</span>
											Applications
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/stats">
											Tester Stats
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/namechanges">
											Namechange Logs
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/iplookup">
											IP Lookup
										</a>
									</li>
									<li>
										<a class="nav-link" href="https://forum.gta.world/en/index.php?/forum/14-bug-reports/">
											Bug Reports
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/bans">
											Ban Archive
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/staff">
											Stafflist
										</a>
									</li>
									<li>
										<a class="nav-link" href="tester/devtracker">
											Development Tracking
										</a>
									</li>														
								</ul>
							</li>
						@endif

							@if(Auth()->user()->role->role_id >= 2)
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-cog" aria-hidden="true"></i>
										<span>Administration</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="admin/lookup">
												Lookup Functions
											</a>
										</li>
										<li>
											<a class="nav-link" href="admin/ban">
												Ban Users
											</a>
										</li>
										<li>
											<a class="nav-link" href="admin/unban">
												Unban Users
											</a>
										</li>
										<li>
											<a class="nav-link" href="{{ route('adminmask_decrypter') }}">
												Mask Decrypter
											</a>
										</li>
										<li>
											<a class="nav-link" href="admin/factions">
												Faction List
											</a>
										</li>
										<li>
											<a class="nav-link" href="{{ route('adminlookup_items') }}">
												Advanced Items Lookup
											</a>
										</li>
										<li>
											<a class="nav-link" href="admin/xmr/approve">
												Approve XMR
											</a>
										</li>
									</ul>
								</li>
							@endif

							@if(Auth()->user()->role->role_id >= 6)
								<li class="nav-parent">
									<a class="nav-link" href="#">
										<i class="fas fa-cog" aria-hidden="true"></i>
										<span>Management</span>
									</a>
									<ul class="nav nav-children">
										<li>
											<a class="nav-link" href="management/serials">
												Serial Codes
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/wp-logs">
												World Point Logs
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/events">
												Events Timetable
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/refund">
												Refunds
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/refund-logs">
												Refunds Log
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/archive">
												Character Archive
											</a>
										</li>
										<li>
											<a class="nav-link" href="#">
												Activity
											</a>
										</li>
										<li>
											<a class="nav-link" href="tester/logs">
												UCP Logs
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/widgets">
												Widgets Framework
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/manual_creation">
												Manual User Creation
											</a>
										</li>
										<li>
											<a class="nav-link" href="management/site">
												Site Content Manager
											</a>
										</li>
									</ul>
								</li>
							@endif
						@endif
					</ul>
				</nav>
			@endif

			<nav id="menu" class="nav-main" role="navigation">
				<ul class="nav nav-main">
					<hr class="separator" />
					<li>
						<a class="nav-link" href="terms">
							<i class="fas fa-user-secret" aria-hidden="true"></i>
							<span>Terms & Privacy</span>
						</a>
					</li>
					<li>
						<a class="nav-link" href="https://map.gta.world/" target="_blank">
							<i class="fas fa-map-marker-alt" aria-hidden="true"></i>
							<span>Maps</span>
						</a>
					</li>
					<li>
						<a class="nav-link" href="https://forum.gta.world/en/" target="_blank">
							<i class="fas fa-external-link-alt" aria-hidden="true"></i>
							<span>Forums</span>
						</a>
					</li>
					<li>
						<a class="nav-link" href="https://status.gta.world/" target="_blank">
							<i class="fas fa-signal" aria-hidden="true"></i>
							<span>Status</span>
						</a>
					</li>
					<li>
						<a class="nav-link" href="https://discord.gg/h8NTEtX" target="_blank">
							<i class="fab fa-discord" aria-hidden="true"></i>
							<span>Discord</span>
						</a>
					</li>

				</ul>
			</nav>

			<hr class="separator" />

			<div class="sidebar-widget widget-stats">

				<div class="widget-content">
					<ul>
						<li>
							<span class="stats-title">Players Online</span>
							<span class="stats-complete" id="online_players"></span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="#players_now" aria-valuemin="0" aria-valuemax="1000" style="width: 85%;">
								</div>
							</div>
						</li>
						<li>
							<span class="stats-title">Stat 2</span>
							<span class="stats-complete">70%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;">
									<span class="sr-only">70% Complete</span>
								</div>
							</div>
						</li>
						<li>
							<span class="stats-title">Stat 3</span>
							<span class="stats-complete">2%</span>
							<div class="progress">
								<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="#players_now" aria-valuemin="0" aria-valuemax="100" style="width: 2%;">
									<span class="sr-only">2% Complete</span>
								</div>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>

		<script>
			// Maintain Scroll Position
			if (typeof localStorage !== 'undefined') {
				if (localStorage.getItem('sidebar-left-position') !== null) {
					var initialPosition = localStorage.getItem('sidebar-left-position'),
						sidebarLeft = document.querySelector('#sidebar-left .nano-content');
					
					sidebarLeft.scrollTop = initialPosition;
				}
			}


            $(document).ready(function() {
                $.getJSON( "https://cdn.rage.mp/master/", function(data) {
                    $('#online_players').text(data["164.132.206.209:22005"].players + "/" + data["164.132.206.209:22005"].maxplayers);
                    $('#players_now').text(data["164.132.206.209:22005"].players);
                })
            });
		</script>
		

	</div>

</aside>
<!-- end: sidebar -->