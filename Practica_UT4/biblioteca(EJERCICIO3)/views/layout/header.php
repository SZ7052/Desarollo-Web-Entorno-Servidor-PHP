<?php function meepleheader(?array $user):void{
    ?>
    <header>
        <nav>
            <a href="index.php">Home</a>
            <a href="login.php">Login</a>
            <?php if(isset($user)&&$user['role']=='admin'){?>
                <a href="admin.php">Admin</a>
            <?php }?>

        </nav>
    </header>
<?php }?>