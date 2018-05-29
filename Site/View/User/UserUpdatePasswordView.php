<?php
ob_start();
?>


<?php
if(isset($error))
{
    echo $error;
}
if(isset($message))
{
    echo $message;
}
?>
    <div class="form">
        <h1> Set your new password </h1>

        <form action="index.php?action=update_user_password&username=<?=$_GET['user']?>" method="post">
            <input type = "hidden" value="<?=$_GET['user']?>" name="user">
            <p><label>Password</label><input type="password" placeholder="password" name = "password" required></p>
            <p><label>Confirm password</label><input type="password" placeholder="confirm password" name ="confirmation" required></p>
            <p><input type="submit" text="submit"></p>
        </form>
    </div>
<?php
$content = ob_get_clean();
require_once "View/Template.php"
?>