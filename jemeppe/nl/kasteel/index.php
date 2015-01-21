<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');


?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        <style>
        </style>
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
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/castle/kasteel1.jpg">
                  </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/castle/kasteelgewelf.jpg">
                  </a>
                </div>
            </div>
        </div>
        
        
        <div class="container">
            <h1><?= $contentTitle[0] ?></h1>
            <p><?= $contentContent[0] ?></p>  
        </div>

        <div class='container'>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/castle/kasteel2.jpg">
                  </a>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                  <a class="thumbnail">
                    <img src="../../jemeppe/media/image/castle/kasteelhoek.jpg">
                  </a>
                </div>
            </div>
        </div>
        
        <div class='container'>
            <h1><?= $contentTitle[1] ?></h1>
            <p><?= $contentContent[1] ?></p>
        </div>
        <?php
        includeFile('frontend/footer.php');
        ?>
    </body>
</html>