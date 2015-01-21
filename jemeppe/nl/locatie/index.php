<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
            
            $category = 'castle_index';
            $o_content = new ContentOverview($mysqli, $category, $language);
            $o_contentId = $o_content->getId_content();
            $contentTitle = array();
            $contentContent = array();

            foreach($o_contentId as $o_contentId) {
            $content = new Content($mysqli, $o_contentId);

            $title = $content->getTitle();
            $content = $content->getContent();

            array_push($contentTitle, $title);
            array_push($contentContent, $content);
        }
        ?>
        <br>
        <div class='container'>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/location/schilderij1.jpg">
                  </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/location/knights.jpg">
                  </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/location/schilderij2.jpg">
                  </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-3">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/location/pastor.jpg">
                  </a>
                </div>
            </div>
        </div>
        
        
        <div class='container'>
            <h1><?= $contentTitle[0] ?></h1>
            <?= $contentContent[0] ?>
        </div>
        
        <?php includeFile('frontend/footer.php') ?>
    </body>
</html>