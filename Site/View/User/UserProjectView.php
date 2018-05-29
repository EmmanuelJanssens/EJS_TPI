<?php
    ob_start();

    //to be able to check if a user is connected
    $connected = isset($_SESSION['user_session']);

    //Get what action is ongoing
    if(isset($_GET['action']))
    {
        $action = $_GET['action'];
        $updating = $action == 'update_project';
    }

    //Get the username if one is connected

    if($connected)
    {
        $username = $_SESSION['user_session']['username'];
        $projectID = $projectData[0]->pkProject;
    }
echo '<form action="index.php?action=save_project&username='.$username.'&projectID='.$projectID.'" method=post>';

    if($updating)
    {
        echo '<input type="text" name="projectName" value="'.$projectData[0]->name.'">';
    }
    else
    {
        echo '<h3 class="major">project : '.$projectData[0]->name.'</h3>';
    }

echo '<section>';
echo '<div class="row">';
echo '<div class="12u">';
echo '<ul class="actions">';
echo '<li><a class="button">Download Latest</a></li>';

if($connected)
{
    if($username == $projectData[0]->username)
    {
        if($updating)
        {
            echo'<li><input type="submit"  class="button" value = "save"></a></li>';
        }
        else
        {
            echo '<li><a href="index.php?action=update_project&username='.$username.'&projectID='.$projectID.'" class="button">Update</a></li>';
            echo '<li><a href="index.php?action=delete_project&username='.$username.'&projectID='.$projectID.'" class="button">Delete</a></li>';
        }


    }
}
echo '</ul>';
echo '</div>';
echo '</div>';
echo '</section>';

?>

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
        <?php
            if($updating)
            {
                echo '<textarea name = "projectDescription">'.$projectData[0]->description.'</textarea> ';
            }
            else
            {
                //Write project description
                echo '<p>'.$projectData[0]->description.'</p>';
            }

        ?>
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
                if($username == $projectData[0]->username)
                {

                    echo <<<"HTML"
                         <a class="button" href="index.php?action=user_upload_version&projectID=$projectID">Upload Version</a>
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
                    echo '<a href="index.php?action=view_project_topic&projectID='.$projectID.'&projectName='.$projectData[0]->name.'" class = "button">GO</a>';
                }
                ?>
                    </ul>
                </div>

    <div id="accessibility" class="tabcontent">
        <p>Tokyo is the capital of Japan.</p>
    </div>
</div>
</form>
<?php
    $content = ob_get_clean();
    require_once "View/Template.php";

?>