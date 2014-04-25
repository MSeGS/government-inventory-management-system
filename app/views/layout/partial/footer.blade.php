	<div class="footerStyles">
		<div class="container">
	<hr />
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="row">
						<div class="col-md-2 col-sm-3 text-right">
							<img src="{{asset('templates/default/images/logo.jpg')}}" alt="" width="83">
						</div>
						<div class="col-md-10 col-sm-9">
							<address>
								<strong>Mizoram State e-Governance Society</strong><br>
								(An Autonomous Society under the Govt of Mizoram)<br>
								Secretariat Building Block Annexe-I<br> 
								Treasury Square, Aizawl - 796001, Mizoram
							</address>
						</div>
					</div>
				</div>

				<div class="col-md-3 col-sm-6">
					<div class="row">
						@include('layout.partial.language')
					</div>
				</div>
				<div class="col-md-3 col-sm-6">
					<div class="row">
						@include('layout.partial.theme')
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- JQuery -->
	<script type="text/javascript" src="{{asset('templates/default/lib/jquery/jquery-1.11.0.min.js')}}"></script>

	<!-- Bootstrap JS -->
	<script type="text/javascript" src="{{asset('templates/default/lib/bootstrap/bootstrap.min.js')}}"></script>

	<!-- Modernizr Plugin for cross browser -->
	<script type="text/javascript" src="{{asset('templates/default/lib/js/modernizr.min.js')}}"></script>

	<!-- Legacy for IE -->
	<script type="text/javascript" src="{{asset('templates/default/lib/js/legacy.js')}}"></script>

	<!-- Easy Dropdown -->
	<script type="text/javascript" src="{{asset('templates/default/lib/js/jquery.easydropdown.min.js')}}"></script>

	<!-- Datepicker JS -->
	<script type="text/javascript" src="{{asset('templates/default/lib/datepicker/picker.js')}}"></script>
	<script type="text/javascript" src="{{asset('templates/default/lib/datepicker/picker.date.js')}}"></script>

	<!-- Template JS -->
	<script type="text/javascript" src="{{asset('templates/default/js/script.js')}}"></script>

	@yield('scripts')
</body>
</html>