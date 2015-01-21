<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/User.class.php');
includeFile('backend/model/Review.class.php');
includeFile('backend/model/ReviewOverview.class.php');
?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        <script src='//cdnjs.cloudflare.com/ajax/libs/masonry/3.2.2/masonry.pkgd.min.js'></script>
        
        <style>
        .masonry-col {
            margin: 10px;
            padding: 10px;
        }
        </style>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
            $email = NULL;
            $o_review = new ReviewOverview($mysqli, 0, 5);
            
            $reviewer = $o_review->getId_user();
        ?>
        <br>
        <div id='container' class='container-fluid'>
            <?php
            foreach($reviewer as $userId){
                $review = new Review($mysqli, $language, $userId);
                
                $review_userId = $review->getId_user();
                $review_lang = $review->getLanguage();
                $review_date = $review->getPublished();
                $review_rating = $review->getRating();
                $review_content = $review->getReview();
                
                $review_date = date('Y-m-d', strtotime($review_date));
                
                if($review_lang !== $language) {
                    continue;
                }
                
                $user = new User($mysqli, $email);
                $user->populateById($mysqli, $review_userId);
                $fullName = $user->getFullName();
                
            ?>
                <div class='masonry-col col-md-4' style='background-color: whitesmoke;'>
                    <p class='pull-left'></p>
                    <h3><b><?= $fullName ?></b></h3>
                    <p><h3 style="color: gold;">
                        <?php
                        for($i=0;$i<$review_rating;$i++) {
                            echo "<i class='fa fa-star'></i>";
                        }
                        ?>
                    </h3></p>
                    <blockquote>
                        <?= $review_content ?>
                    </blockquote>
                <p class='pull-right'>Published on: <?= $review_date ?></p>
                </div>
            
            <?php
            }
            ?>
        </div>
        <script>
            $('#container').masonry({
                itemSelector: '.col-md-4'
              });
        </script>
    </body>
</html>