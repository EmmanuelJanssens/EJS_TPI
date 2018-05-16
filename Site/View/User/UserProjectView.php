<?php
    ob_start();
?>

<h3>Project <?php echo $projectID?></h3>

<a class="button">Download Latest</a>
<nav id="my_nav">
    <ul>
        <li><a class="tablinks current" onclick="openTab(event, 'summary')" id="defaultOpen">Summary</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'version')">Version</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'forum')">Forum</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'accessibility')">Accessibility</a></li>

    </ul>
</nav>

<div class = "box post myTabs">
    <div id="summary" class="tabcontent">
        <p>This project is dope</p>
    </div>

    <div id="version" class="tabcontent">
        <ul>
            <li><a href="index.php?action=view_user_version">version 1.4</a></li>
            <li><a>version 1.3</a></li>
            <li><a>version 1.2</a></li>
            <li><a>version 1.1</a></li>
        </ul>
    </div>

    <div id="forum" class="tabcontent">
        <ul>
            <li><a>message 300</a></li>
            <li><a>message 299</a></li>
            <li><a>message 298</a></li>
            <li><a>message 297</a></li>
        </ul>   
     </div>

    <div id="accessibility" class="tabcontent">
        <p>Tokyo is the capital of Japan.</p>
    </div>
</div>

<?php
    $content = ob_get_clean();
    require_once "View/Template.php";

?>