<div id="navBarContainer">
	<nav class="navBar">
		<span role="link" tabindex="0" onclick="openPage('index.php')" class="logo">
			<img src="assets/images/logo.png">
		</span>

		<div class="group">
			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('search.php')" class ="navItemLink">
					Search
					<img src="assets/icons/icons8-search.png" class="icon" alt="search">
				</span>
			</div>
		</div>

		<div class="group">
			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink">Browse</span>
			</div>
			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('yourMusic.php')" class="navItemLink">Your Music</span>
			</div>
			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('settings.php')" class="navItemLink"><?php echo $userLoggedIn->getUsername(); ?></span>
			</div>
			<div class="navItem about">
				<span role="link" tabindex="0" onclick="openPage('about.php')" class="navItemLink">About</span>
			</div>
		</div>

	</nav>
	
</div>