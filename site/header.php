<!--
 * User: Jeffrey Hamstra
 * Date: 20/01/2020
 *-->
<div class="contactBar">
		<p class="first"><a href="https://www.youtube.com/channel/UC-rpKTzEw-wUWYWOcJ0452Q"><i class="fab fa-youtube-square"></i></a><a href="https://www.facebook.com/CST.University/"><i class="fab fa-facebook-square"></i></a><p>
		<p class="second"><i class="fas fa-envelope"></i> info.cst@rub.edu.bt Mon - <i class="far fa-clock"></i> Fri 8:00 - 16:00</p>
	</div>
	<nav class="navbar navbar-expand-lg navbar-light">
		<button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
  	<span class="navbar-toggler-icon"></span>
		</button>
 		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  		<img src="img/cstlogo176.png" class="logo">
			<h1 class="name">Weather application </h1><h1 class="company"> College of Science and Technology</h1>
			<ul class="navbar-nav ml-auto mt-2 mt-lg-0">
				<li class="nav-item active">
          <?php if ($_SESSION['role'] != 3):?>
  				<a class="nav-link" href="index.php">Home</a>
        <?php endif?>
				</li>
        <i class="fas fa-user-circle user"></i>
			  <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" 
            href="#" 
            id="logoutDropdown" 
            role="button" 
            data-toggle="dropdown" 
            aria-haspopup="true" 
            aria-expanded="false"><?= $_SESSION['username']; ?></a>
            <div class="dropdown-menu dropdown-menu-right logoutMenu" aria-labelledby="loginDropwdown">
              <a class="dropdown-item" href="download.php">Download</a>
              <?php if($_SESSION['role'] == '1' ): ?>
              <a class="dropdown-item" href="user.php">User management</a>
              <?php endif ?>
              <a class="dropdown-item" href="index.php?logout">Logout</a>
            </div>
          </li>
			</ul>
    </div>
</div>
</nav>