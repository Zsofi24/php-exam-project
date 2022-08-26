<?php
require_once('includes/nav.inc.php');
?>

<nav>
    <div class="nav-container">
    <div class="nav">
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-person-hiking"></i></a></li>
            <!-- <li><a href="tours.php" id='tura'>Túrák</a></li> -->
            <li><a href="jelentkezes.php" id='jelentkezes'>Jelentkezés</a></li>
            <div class="dropdown">
                <li><button class="dropbtn"><a href="tours.php">Túrák</a></button></li>
                <div class="dropdown-content">
                    <?php foreach ($locations as $key => $value) : ?>
                        <a href="tours.php#<?php echo $locations[$key]['helyszinId']?>"><?php echo $locations[$key]['helyszinNev']?></a>
                    <?php endforeach ?>
                </div>
            </div>
        </ul>
    </div>
    <div class="nav">
        <ul>
        <?php
            if(isset($_SESSION["userid"])) 
            {
        ?>
            <li class="username"><a href="#"><?php echo $_SESSION["useruid"];?></a></li>
            <li class="login-logout"><a href="includes/logout.inc.php">Kijelentkezés</a></li>
        <?php
            }
            else
            {
        ?>
            <li  class="regist"><a href="signup.php">Regisztráció</a></li>
            <li  class="login-logout"><a href="login.php">Bejelentkezés</a></li>
        <?php 
            }
        ?>
        </ul>
    </div>
</nav>



    
  