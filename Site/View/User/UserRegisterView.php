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
    <h1> Register </h1>

    <form action="index.php?action=user_register" method="post">
        <p><input type="text" placeholder="Name" name="name" required></p>

        <p><input type="text" placeholder="LastName" name="lastname" required></p>

        <?php if(isset($username_err)) echo $username_err;?>
        <p> <input type="text" placeholder="username" name="username" required></p>

        <?php if(isset($mail_err)) echo $mail_err;?>
        <p><input type="text" placeholder="email" name="email" required></p>

        <?php if(isset($pswd_err)) echo $pswd_err;?>
        <p><input type="password" placeholder="password" name="password" required></p>

        <?php if(isset($pswd_conf_err)) echo $pswd_conf_err;?>
        <p><input type="password" placeholder="confirm password" name="passwordconfirm" required></p>

        <p><input type="submit" value="send" text="submit"></p>
    </form>
</div>
<?php
    $content = ob_get_clean();

    require_once "View/Template.php";
?>