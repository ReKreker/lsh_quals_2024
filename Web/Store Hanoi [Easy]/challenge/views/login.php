<?php include '../views/layouts/header.php' ?>
		<div class="pure-g">
			<div class="pure-u-1-3"></div>
			<div class="pure-u-1-3">
				<h1>Login</h1>
				<form class="pure-form pure-form-aligned" action="" method="post">
					<fieldset>
						<div class="pure-control-group">
							<label>Username</label>
							<input name="username" type="text">
						</div>
						<div class="pure-control-group">
							<label>Password</label>
							<input name="password" type="password">
						</div>
						<div class="pure-controls">
							<button class="pure-button pure-button-primary" type="submit">Login</button>
						</div>
					</fieldset>
				</form>
			</div>
			
		</div>
<?php include '../views/layouts/footer.php' ?>