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
        <p><input type="text" placeholder="Name" name="name"></p>
        <p><input type="text" placeholder="LastName"></p>
        <p> <input type="text" placeholder="username"></p>
        <p><input type="text" placeholder="email"></p>
        <p><input type="password" placeholder="password"></p>
        <p><input type="password" placeholder="confirm password"></p>
        <p><input type="submit" text="submit"></p>
    </form>
</div>
<?php
    $content = ob_get_clean();

    require_once "View/Template.php";
?>