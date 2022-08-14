<nav>
    <div class="nav-container">
    <div class="nav">
        <ul>
            <li><a href="index.php"><i class="fa-solid fa-person-hiking"></i></a></li>
            <li><a href="turak.php" id='tura'>Túrák</a></li>
            <li><a href="jelentkezes.php" id='jelentkezes'>Jelentkezés</a></li>
            <li><a href="#" id='contact'>Info</a></li>
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
            <li  class="regist"><a href="regisztracio.php">Regisztráció</a></li>
            <li  class="login-logout"><a href="bejelentkezes.php">Bejelentkezés</a></li>
        <?php 
            }
        ?>
        </ul>
    </div>
</nav>



    
  
