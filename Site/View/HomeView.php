<?php
    ob_start();
?>

<div class="row 200%">
    <div class="12u">

        <!-- Features -->
            <section class="box features">
                <h2 class="major"><span>Recent projects</span></h2>
                <div>
                    <div class="row">


                        <?php

                        if(isset($projectData) > 0)
                        {
                            foreach($projectData as $row)
                            {
                                echo '<div class="3u 12u(mobile)">';
                                echo '<section class="box feature">';
                                echo '<a href="#" class="image featured"><img src="images/pic01.jpg" alt=""></a>';
                                echo '<h3><a href="index.php?action=view_user_project&username='.$row->username.'&projectID='.$row->pkProject.'" >Project</a>'.$row->name.'</h3>';
                                echo '<p>';
                                echo  $row->description;
                                echo '</p>';
                                echo '</section>';
                                echo '</div>';
                            }
                        }
                        ?>
                    </div>

                </div>
            </section>

    </div>
</div>
<div class="row 200%">
    <div class="12u">

        <!-- Blog -->
            <section class="box blog">
                <h2 class="major"><span>Today's most popular project</span></h2>
                <div>
                    <div class="row">
                        <div class="9u 12u(mobile)">
                            <div class="content content-left">

                                <!-- Featured Post -->
                                    <article class="box post">
                                        <header>
                                            <h3><a href="#">Website</a></h3>
                                            <p>Website develloped for my school work</p>
                                            <ul class="meta">
                                                <li class="icon fa-clock-o">15 minutes ago</li>
                                                <li class="icon fa-comments"><a href="#">8</a></li>
                                            </ul>
                                        </header>
                                        <a href="#" class="image featured"><img src="images/pic05.jpg" alt="" /></a>
                                        <p>
                                            Phasellus quam turpis, feugiat sit amet ornare in, a hendrerit in lectus. Praesent
                                            semper mod quis eget mi. Etiam sed ante risus aliquam erat et volutpat. Praesent a
                                            dapibus velit. Curabitur sed nisi nunc, accumsan vestibulum lectus. Lorem ipsum
                                            dolor sit non aliquet sed, tempor et dolor.  Praesent a dapibus velit. Curabitur
                                            accumsan.
                                        </p>
                                        <a href="#" class="button">Continue Reading</a>
                                    </article>

                            </div>
                        </div>
                        <div class="3u 12u(mobile)">
                            <div class="sidebar">

                                <!-- Archives -->
                                    <ul class="divided">
                                        <li>
                                            <article class="box post-summary">
                                                <h3><a href="#">A Subheading</a></h3>
                                                <ul class="meta">
                                                    <li class="icon fa-clock-o">6 hours ago</li>
                                                    <li class="icon fa-comments"><a href="#">34</a></li>
                                                </ul>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="box post-summary">
                                                <h3><a href="#">Another Subheading</a></h3>
                                                <ul class="meta">
                                                    <li class="icon fa-clock-o">9 hours ago</li>
                                                    <li class="icon fa-comments"><a href="#">27</a></li>
                                                </ul>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="box post-summary">
                                                <h3><a href="#">And Another</a></h3>
                                                <ul class="meta">
                                                    <li class="icon fa-clock-o">Yesterday</li>
                                                    <li class="icon fa-comments"><a href="#">184</a></li>
                                                </ul>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="box post-summary">
                                                <h3><a href="#">And Another</a></h3>
                                                <ul class="meta">
                                                    <li class="icon fa-clock-o">2 days ago</li>
                                                    <li class="icon fa-comments"><a href="#">286</a></li>
                                                </ul>
                                            </article>
                                        </li>
                                        <li>
                                            <article class="box post-summary">
                                                <h3><a href="#">And One More</a></h3>
                                                <ul class="meta">
                                                    <li class="icon fa-clock-o">3 days ago</li>
                                                    <li class="icon fa-comments"><a href="#">8,086</a></li>
                                                </ul>
                                            </article>
                                        </li>
                                    </ul>
                                    <a href="#" class="button alt">Browse Archives</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

    </div>
</div>
                        
<?php
    $content = ob_get_clean();
    require "Template.php";
?>