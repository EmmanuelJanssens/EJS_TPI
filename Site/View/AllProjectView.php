<?php
    ob_start();
?>
<div class="row">
<div class="3u 12u(mobile)">
        <div class="sidebar">

        <!-- Sidebar -->

            <!-- Recent Posts -->
                <section>
                    <h2 class="major"><span>Recent Posts</span></h2>
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
                    </ul>
                    <a href="#" class="button alt">Browse Archives</a>
                </section>

            <!-- Something -->
                <section>
                    <h2 class="major"><span>Ipsum Dolore</span></h2>
                    <a href="#" class="image featured"><img src="images/pic03.jpg" alt="" /></a>
                    <p>
                        Donec sagittis massa et leo semper scele risque metus faucibus. Morbi congue mattis mi.
                        Phasellus sed nisl vitae risus tristique volutpat. Cras rutrum sed commodo luctus blandit.
                    </p>
                    <a href="#" class="button alt">Learn more</a>
                </section>

            <!-- Something -->
                <section>
                    <h2 class="major"><span>Magna Feugiat</span></h2>
                    <p>
                        Rhoncus dui quis euismod. Maecenas lorem tellus, congue et condimentum ac, ullamcorper non sapien.
                        Donec sagittis massa et leo semper scele risque metus faucibus. Morbi congue mattis mi.
                        Phasellus sed nisl vitae risus tristique volutpat. Cras rutrum sed commodo luctus blandit.
                    </p>
                    <a href="#" class="button alt">Learn more</a>
                </section>

        </div>

    </div>
    <div class="9u 12u(mobile) important(mobile)">
        <div class="content content-right">
            <?php

            if(isset($error))
            {
                echo 'erreur '.$error;
            }
                foreach($projectData as $row)
                {
                    echo <<<"HTML"
                    
                    <ul class="divided">
                        <li>
                            <article class="box post-summary">
                                <h2 class="major"><a href="index.php?action=view_user_project&username=$row->username&projectID=$row->pkProject">Project $row->name by $row->username</a></h2>
                                <p> $row->description</p>   
                            </article>
                        </li>
                        <a href="index.php?action=view_user_project&username=$row->username&projectID=$row->pkProject" class="button">View Project</a>

                    </ul>

HTML;
                }
            
            ?>
        </div>
    </div>
   
</div>
<?php
    $content  = ob_get_clean();
    require_once "Template.php";
?>