<!DOCTYPE HTML>
<!--
	Striped by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <title><?php echo $GLOBALS['model']->Title; ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="contenu/assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="../content/assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="contenu/assets/css/ie8.css" /><![endif]-->
    <link rel="stylesheet" type="text/css" href="../content/assets/css/tableau-res.css">
    <script src="../content/assets/js/jquery.min.js"></script>
</head>
<body>

<script>

    $(document).ready(function(){
        if ($('#mrecette').hasClass('current')) {
            $('#mrecette').removeClass('current');
        }
        if ($('#mproduit').hasClass('current')) {
            $('#mproduit').removeClass('current');
        }
        if ($('#mtheme').hasClass('current')) {
            $('#mtheme').removeClass('current');
        }
        if ($('#mdeconnection').hasClass('current')) {
            $('#mdeconnection').removeClass('current');
        }
        if ($('#mimport').hasClass('current')) {
            $('#mimport').removeClass('current');
        }
        if ($('#mphoto').hasClass('current')) {
            $('#mphoto').removeClass('current');
        }
        if ($('#mconnection').hasClass('current')) {
            $('#mconnection').removeClass('current');
        }
        if ($('#mgouts').hasClass('current')) {
            $('#mgouts').removeClass('current');
        }
        if ($('#mtechniques').hasClass('current')) {
            $('#mtechniques').removeClass('current');
        }
    });

</script>

<!-- Content -->
<div id="content">
    <div class="inner">
        <?=$content ?>
    </div>
</div>


<!-- Sidebar -->
<div id="sidebar">

    <!-- Logo -->
    <h1 id="logo"><a href="#"><?php echo $GLOBALS['model']->Title; ?></a></h1>

    <nav id="nav">
        <ul>
                <li id="mrecette"><a href="index.php?action=rechercher_recettes">Consultation des recettes</a></li>
                <li id="mphoto"><a href="index.php?action=rechercher_photo">Photos culinaires</a></li>
                <li id="mfilm"><a href="index.php?action=afficher_film">Films</a></li>
                <li id="mdocenseignant"><a href="index.php?action=rechercher_doc_enseignant">Documentation enseignants</a></li>
        </ul>
    </nav>

    <!-- Copyright -->
    <ul id="copyright">
        <li>&copy; Untitled.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
    </ul>

</div>



<!-- Scripts -->
<script src="contenu/assets/js/jquery.min.js"></script>
<script src="contenu/assets/js/skel.min.js"></script>
<script src="contenu/assets/js/util.js"></script>
<!--[if lte IE 8]><script src="contenu/assets/js/ie/respond.min.js"></script><![endif]-->
<script src="contenu/assets/js/main.js"></script>

</body>
</html>