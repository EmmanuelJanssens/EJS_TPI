<?php
/**
 * Created by PhpStorm.
 * User: Emmanuel.JANSSENS
 * Date: 23.05.2018
 * Time: 15:35
 */

ob_start();

?>

<div class="form">
    <h1> Create new Project </h1>
    <form action="index.php?action=create_project" method="post">

        <?php if(isset($projectname_error)) echo $projectname_error;?>
        <p><input type="text" placeholder="Project Name" name="projectname" required></p>

        <?php if(isset($projectdesc_error)) echo $projectdesc_error;?>
        <p>
            <textarea rows="4" cols="50" placeholder="username" name="projectdescription" required>

            </textarea>

        </p>

        <p><input type="submit" value="send" text="submit"></p>

</div>

<?php
    $content = ob_get_clean();
    require_once "View/Template.php";
?>
