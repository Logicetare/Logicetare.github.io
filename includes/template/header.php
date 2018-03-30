
		<ul class="profile"> 
			
                        <li>
				<a href="/unset.php" class="btn-circle btn-sm">
					<i class="pe-7f-back"></i>
					
				</a>
			</li>
			<li>
				<a href="/support.php" class="btn-circle btn-sm">
					<i class="pe-7f-mail"></i>
					<span class="badge badge--blue"><?php echo getUsersOpenedTickets(); ?></span>
					
				</a>
			</li>
			<li>
				<a href="/profile.php" class="btn-circle btn-sm">
					<i class="pe-7g-sets"></i>
				</a>
			</li>
			
			
		</ul>

		<div class="main-search" style="padding-left:25px;">
			<form action="/testboot.php" method="POST">
				<input type="hidden" name="ip" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>" />
				<input type="text" placeholder="Send test boot to <?php
						echo $_SERVER["REMOTE_ADDR"]; 
					?> for 45 sec" id="msearch" style="width:358px;" disabled="disabled" />

				<button type="submit" name="testBoot">
					<i class="pe-7g-arrow-circled pe-rotate-90" name="testBtn"></i>
				</button>
			</form>
		</div>
		
		<div class="main-brand">
			<div class="main-brand__container">
				<div class="main-logo"><img src="/img/logo.png"></div>
				<!--<input type="checkbox" id="s-logo" class="sw" />
				<label class="swtc swtc--dark swtc--header" for="s-logo"></label> -->
			</div>
		</div>
