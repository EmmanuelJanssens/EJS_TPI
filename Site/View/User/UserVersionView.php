<?php
    ob_start();
?>
<h3>Version 1.4</h3>
<a class="button">Download</a>
<nav id="my_nav">
    <ul>
        <li><a class="tablinks" onclick="openTab(event, 'summary')" id="defaultOpen">Summary</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'files')">Files</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'devlog')">Devlog</a></li>

    </ul>
</nav>

<div class = "box post myTabs">
    <div id="summary" class="tabcontent">
        <p>
        <?php
        //Write project description
            echo $versionData[0]->description;
        ?>   
        </p>
    </div>

    <div id="files" class="tabcontent">
    <?php
        foreach($FILES as $row)
        {
            echo $row.'<br>';
        }
    ?>
    </div>

    <div id="devlog" class="tabcontent">
        <p>
        <?php
        //Write project description
            echo $versionData[0]->DevLog;
        ?>   
        <p>
     </div>

</div>

<?php
    $content = ob_get_clean();
    require_once "View/Template.php";

?>