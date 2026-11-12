<?php function meepleheader(?array $user):void{
?>
<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="preferences.php">Preferencias</a>
        <a href="login.php">Login</a>
        <?php if(isset($user)&&$user['role']=='admin'){?>
        <a href="admin.php">Admin</a>
        <?php }?>
        <a href="logout.php">Logout</a>
    </nav>
</header>
<?php }?>