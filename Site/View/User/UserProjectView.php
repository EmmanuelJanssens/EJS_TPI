<?php
    ob_start();

    $connected = isset($_SESSION['user_session']);
?>

<h3>Project</h3>

<a class="button">Download Latest</a>
<nav id="my_nav">
    <ul>
        <li><a class="tablinks current" onclick="openTab(event, 'summary')" id="defaultOpen">Summary</a></li>
        <li><a class="tablinks" onclick="openTab(event, 'version')">Version</a></li>
        <?php if($connected)
            echo <<<"HTML"
<li><a class="tablinks" onclick="openTab(event, 'forum')">Forum</a></li>
HTML;
        ?>
        <li><a class="tablinks" onclick="openTab(event, 'accessibility')">Accessibility</a></li>

    </ul>
</nav>

<div class = "box post myTabs">
    <div id="summary" class="tabcontent">
        <p>
        <?php
        //Write project description
            echo $projectData[0]->description;
        ?>   
        </p>
    </div>

    <div id="version" class="tabcontent">


        <ul>

            <?php
            //Get the date from the projects
                foreach($versionList as $row)
                {
                    echo <<<"HTML"
                    <li><a href = "index.php?action=view_user_version&versionID=$row->pkVersion&username=$row->username">$row->title</a></li> 
HTML;
                }                                     
            ?>

        </ul>

        <?php

            if($connected)
            {
                $username = $_SESSION['user_session']['username'];
                $id = $projectData[0]->pkProject;
                if($username == $projectData[0]->username)
                {

                    echo <<<"HTML"
                         <a class="button" href="index.php?action=user_upload_version&projectID=$id">Upload Version</a>
HTML;
                }
            }
        ?>
    </div>


        <?php
            if($connected)
            {
                ?>
                <div id="forum" class="tabcontent">
                <ul>

                <?php
                foreach($messageList as $row)
                {
                    echo <<<"HTML"
                    <li><a href="#">message</a> by <a href="#">$row->username</a></li>
HTML;
                }

            }
            ?>
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