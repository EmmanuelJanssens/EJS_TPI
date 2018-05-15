<?php
    ob_start();
?>
<div class="form">
    <h1> Login </h1>

    <form action="index.php?action=user_login" method="post">
        <p><input type="text" placeholder="username"></p>
        <p><input type="password" placeholder="password"></p>
        <p><input type="submit" text="submit"></p>
    </form>
</div>
<?php
    $content = ob_get_clean();
    require_once "View/Template.php"
?>