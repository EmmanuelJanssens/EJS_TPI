<?php
    ob_start();


    if(isset($_SESSION['user_session']))
    {
        $current_user = $_SESSION['user_session']['username'];
    }
    else
    {
        $current_user = "visitor";
    }

    if(isset($error))
    {
        echo $error;
    }

    $UserCtrl = $GLOBALS['userController'];

    $UserType = $UserCtrl->GetUserType($_GET['username']);
?>

<div class="row 200%">
    <div class="12u">
        <!-- Features -->
            <section class="box features">

                <h2 class="major"><span><?=$_GET['username']?></span></h2>
                <div>
                    <div class="row">
                        <div class="3u 12u(mobile)">

                            <!-- Display list of three most recent projects -->
                            <section class="box feature">
                                <h1><a href="#">Project List</a></h1>
                                <p>
                                    <ul>
                                    <?php

                                    //Get the date from the projects
                                        foreach($userData as $row)
                                        {
                                            echo <<<"HTML"
                                            <li><a href = "index.php?action=view_user_project&projectID= $row->pkProject&username=$row->username">$row->name</a></li> 
HTML;
                                        }                                     
                                    ?>
                                               
                                    </ul>
                                </p>
                            </section>
                        </div>
                        <div class="3u 12u(mobile)">
                            <!-- Display a summary of my profile-->
                            <section class="box feature">
                                <h3><a href="#">Profile</a></h3>
                                <p>
                                    Phasellus quam turpis, feugiat sit amet ornare in, a hendrerit in
                                    lectus dolore. Praesent semper mod quis eget sed etiam eu ante risus.
                                </p>
                            </section>
                        </div>
                        <div class="3u 12u(mobile)">
                            <!-- Display three last message I posted-->
                            <section class="box feature">
                                <h3><a href="#">Recent Messages</a></h3>
                                <ul>
                                    <?php

                                    //Get the date from the projects
                                    foreach($userMessages as $row)
                                    {
                                        echo <<<"HTML"
                                            <li><a href = "index.php?action=view_project_topic&projectID=$row->pkProject&projectName=$row->projectName#$row->pkMessage">Message On $row->projectName</a></li> 
HTML;
                                    }
                                    ?>
                                </ul>
                            </section>
                        </div>
                        <div class="3u 12u(mobile)">
                            <!-- Short summary about myself-->
                            <section class="box feature">
                                <h3><a href="#">About Me</a></h3>
                                <p>
                                    Phasellus quam turpis, feugiat sit amet ornare in, a hendrerit in
                                    lectus dolore. Praesent semper mod quis eget sed etiam eu ante risus.
                                </p>
                            </section>
                        </div>
                    </div>

                    <?php


                    if($current_user == $_GET['username'])
                    {

                        echo '
                        <div class="row">
                            <div class="12u">
                                <ul class="actions">
                                    <li><a href="index.php?action=user_create_project" class="button big">Create Project</a></li>
                                    <li><a href="index.php?action=user_update_password&user='.$current_user.'" class="button big">Update Password</a></li>

                            ';
                                    if($UserType == "Admin")
                                    {
                                        echo '                                                                                                                
                                            <li><a href="index.php?action=manage_all_user" class ="button big">Manage User</a></li>
                                            <li><a href="index.php?action=Manage_all_project" class ="button big">Manage Projects</a></li>
                                            ';
                                    }
                        echo'
                                </ul>
                            </div>
                        </div>     
                        ';

                        }
                    
                    ?>
                    

                </div>
            </section>

    </div>
</div>
<?php
    $content = ob_get_clean();
    require_once "View/Template.php";
?>