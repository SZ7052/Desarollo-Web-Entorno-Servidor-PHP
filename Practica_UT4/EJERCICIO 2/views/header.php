<?php function meepleheader(?array $user):void{
?>
<header>
    <nav>
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="dashboard.php">Dashboard</a>
        <?php if(isset($user)){?>
        <a href="perfil.php">Perfil</a>
        <?php }?>
        <a href="reset.php">Reset contador</a>
    </nav>
</header>
<?php }?>