<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel.JANSSENS
 * Date: 29.05.2018
 * Time: 08:14
 */

ob_start();
?>
<div class="form">
    <h3> Get new Password </h3>

    <?php
        if(isset($error))
        {
            echo '<p>'.$error.'</p>';
        }
    ?>
    <form action="index.php?action=send_new_password" method="post">

        <p><label>email</label><input type="text" placeholder="enter your email" name = "email" required></p>
        <p><label>username</label><input type="text" placeholder="enter your username" name = "username" required></p>

        <p><input type="submit" value="send"></p>
    </form>


</div>

<?php
    $content = ob_get_clean();
    require_once "View/Template.php";
?>