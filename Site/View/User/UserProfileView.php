<?php
    ob_start();
?>
<div class="row 200%">
    <div class="12u">
        <!-- Features -->
            <section class="box features">
                <h2 class="major"><span>UserName</span></h2>
                <div>
                    <div class="row">
                        <div class="3u 12u(mobile)">

                            <!-- Display list of three most recent projects -->
                            <section class="box feature">
                                <h1><a href="#">Project List</a></h1>
                                <p>
                                    <ul>
                                        <li><a href ="index.php?action=view_user_project&id=1&user=manu">Project 1</a></li>
                                        <li><a href ="index.php?action=view_user_project&id=2&user=manu">Project 2</a></li>
                                        <li><a href ="index.php?action=view_user_project&id=3&user=manu">Project 3</a></li>                                            
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
                                        <li><a href ="#">Message 1</a></li>
                                        <li><a href ="#">Message 2</a></li>
                                        <li><a href ="#">Message 3</a></li>   
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
                    <div class="row">
                        <div class="12u">
                            <ul class="actions">
                                <li><a href="#" class="button big">Create Project</a></li>
                                <li><a href="#" class="button alt big">Update profile</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

    </div>
</div>
<?php
    $content = ob_get_clean();
    require_once "View/Template.php";
?>