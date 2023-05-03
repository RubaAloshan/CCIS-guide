<?php 

			switch ($mode) {
				case 'enter_email':
					// code...
					?>
						<form method="post" action="forgot.php?mode=enter_email"> 
							<h5>Enter your email below</h5>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>    <div class="form-group">

							<input class="textbox" type="email" name="email" placeholder="Email" required="required"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next">
              
							<br><br>
							<div><a href="login.php">Login</a></div>
						</form>
					<?php				
					break;

				case 'enter_code':
					// code...
					?>
						<form method="post" action="forgot.php?mode=enter_code"> 
							
							<h5>Enter your the code sent to your email</h5>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
              <div class="form-group">
							<input class="textbox" type="text" name="code" placeholder="12345"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next" style="float: right;">
							<a href="forgot.php">
              <br></br>
              <div><a href="forgot.php" value="Start Over">Start Over</a></div>
							</a>

							<div><a href="login.php">Login</a></div>
						</form>
					<?php
					break;

				case 'enter_password':
					// code...
					?>
						<form method="post" action="forgot.php?mode=enter_password"> 
							<h3>Enter your new password</h3>
							<span style="font-size: 12px;color:red;">
							<?php 
								foreach ($error as $err) {
									// code...
									echo $err . "<br>";
								}
							?>
							</span>
              <div class="form-group">
							<input class="textbox" type="text" name="password" placeholder="Password"><br>
							<input class="textbox" type="text" name="password2" placeholder="Retype Password"><br>
							<br style="clear: both;"></div>
							<input class="btn btn-secondary btn-block border-0 py-3" type="submit" value="Next" style="float: right;">
							<a href="forget.html">
              <div><a href="forget.html" value="Start Over">Start Over</a></div>
							</a>
							
							<div><a href="Login.html">Login</a></div>
						</form>
					<?php
					break;
				
				default:
					// code...
					break;
			}

		?>