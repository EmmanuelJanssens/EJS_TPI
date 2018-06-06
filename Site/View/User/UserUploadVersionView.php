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
    <h1> Upload a new version </h1>
    <form action="index.php?action=upload_version" method="post" enctype="multipart/form-data">

        <?php if(isset($versionname_error)) echo $versionname_error;?>
        <p><input type="text" placeholder="Version Name" name="versionname" required></p>

        <?php if(isset($versiondesc_error)) echo $versiondesc_error;?>
        <label>Description</label>
        <p>
            <textarea rows="4" cols="50"name="versiondescription" required>
            </textarea>
        </p>

        <?php if(isset($versionlog_error)) echo $versionlog_error;?>
        <label>Log</label>
        <p>
            <textarea rows="4" cols="50" placeholder="username" name="versionlog" required>
            </textarea>
        </p>

        <label>Choose a file to upload</label>
        <p>
            <input type="file" class="button" text="Choose" name="fileToUpload" accept=".zip" id ="fileToUpload" required>
        </p>

        <input type="hidden" value="<?=$_GET['projectID']?>" name="projectID">
        <p>
            <input type="submit" value="send" text="submit"  onclick="myFunction()"></p>
        </p>

    </form>
</div>
<script>

    function myFunction() {
        var x = document.getElementById("myFile").value;
        var d = document.getElementById("filepath");
        d.value = x;
    }
</script>
<?php
$content = ob_get_clean();
require_once "View/Template.php";
?>
