<?php
    ob_start();
?>

About

<?php
    $content  = ob_get_clean();
    require_once "Template.php";
?>