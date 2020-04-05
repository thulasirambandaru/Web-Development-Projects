<body class="login-wrap">
	<section class="container">
		<section class="login-form col-md-7 col-lg-6 col-sm-12 align-center">
			<p class="err_msg">
				<?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message'); } ?>
			</p>
			<div class="login-logo col-md-5 col-sm-5 col-xs-12">
				<img src="
					<?=BASE_URL?>images/sun-logo.png" width="150"/>
				</div>
				<form method="post" action="
					<?=BASE_URL?>index.php/welcome/makeLogin" role="login" class="col-md-7 pull-right">
					<input type="text" name="username" id="username" placeholder="Username"  class="form-control input-lg" />
					<input type="password" name="password" id="password" placeholder="Password"  class="form-control input-lg" />
					<button type="submit" name="go" class="btn btn-lg btn-primary btn-block login-btn">Sign in</button>
					<div>
						<a href="#">Reset password</a>
					</div>
				</form>
				<!--<div class="form-links"><a href="#">www.website.com</a></div>-->
			</section>
		</section>
