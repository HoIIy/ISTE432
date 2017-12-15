<div class="loginForm w3-modal">
<h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-teal"></i>LOGIN</h2>
<div class="loginForm" class="card-5">
    <div class="loginFormLeft">
		<form action="#" onsubmit="return loginUser()" method="post">
	    <div class="formField">
			<label for="username">Username</label>
			<input type="text" name="username" maxlength="30" autofocus>
		</div>
	    <div class="formField">
			<label for="password">Password</label>
			<input type="password" name="psswd" maxlength="30">
		</div>
		<div id="submit">
			<input type="submit" class="submit" value="Login">
		</div>
		</form>
		<div class="formField"><a href="#" onclick="forgotPass()">Forgot password?</a></div>
		<div class="formField"><a href="#" onclick="createAccount()">Create an account?</a></div>
	</div>
</div>
</div>
