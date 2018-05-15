<?php
    ob_start();
?>

Forum list

<?php
    $content  = ob_get_clean();
    require_once "Template.php";
?>