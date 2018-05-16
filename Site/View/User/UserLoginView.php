<?php
    ob_start();
?>


<?php
    if(isset($error))
    {
        echo $error;
    }
?>
<div class="form">
    <h1> Login </h1>

    <form action="index.php?action=user_login" method="post">
        <p><input type="text" placeholder="username" name = "username" required></p>
        <p><input type="password" placeholder="password" name ="password" required></p>
        <p><input type="submit" text="submit"></p>
    </form>
</div>
<?php
    $content = ob_get_clean();
    require_once "View/Template.php"
?>