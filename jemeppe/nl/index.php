<?php
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/Room.class.php');
includeFile('backend/model/RoomOverview.class.php');
includeFile('backend/model/Review.class.php');
includeFile('backend/model/ReviewOverview.class.php');
includeFile('backend/model/User.class.php');
includeFile('backend/model/Content.class.php');
includeFile('backend/model/ContentOverview.class.php');

$category = 'index';
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
<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        <style>
            .carousel-inner .item img {
                width: 100%;
            }
            .thumbnail img {
                height: 20%;
                width: auto;
            }
            #youtubevid {
                height: 720px;
            }
            
            @media all and (max-width: 770px) {
                .thumbnail img {
                    width: 100%;
                    height: auto;
                }
            }
        </style>
        <script src="//cdnjs.cloudflare.com/ajax/libs/fitvids/1.1.0/jquery.fitvids.min.js"></script>
        <script>
        $(document).ready(function(){
          $("#youtubevid").fitVids();
        });
      </script>
    </head>
    <body>
        <?php 
            includeFile('frontend/navigation.php');
        ?>
    </body>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="../../jemeppe/media/image/frontpage/Chateau.jpg">
            </div>
            <div class="item">
                <img src="../../jemeppe/media/image/frontpage/Hargimont.jpg">
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <br>
    <div class='container'>
        <p class='lead'>
            <?= $contentContent[0] ?>
        </p>
    </div>
    <div class="container">
        <iframe id="youtubevid" width="100%" height="50%" src="//www.youtube.com/embed/uUUoGVCreQY?hd=1&rel=0&autohide=1&showinfo=0" frameborder="0" allowfullscreen></iframe>
    </div>
    <br>
    <!-- <img src='../../jemeppe/media/image/frontpage/1.jpg' class="img-responsive"> -->
    <div class='container'>
         <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/1.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/2.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/3.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/4.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/5.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/6.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/7.jpg">
              </a>
            </div>
             <div class="col-xs-12 col-sm-4 col-md-3">
              <a class="thumbnail">
                <img src="../../jemeppe/media/image/frontpage/8.jpg">
              </a>
            </div>
        </div>
    </div>
    
    <div class="container">
        <?php
        $o_room = new RoomOverview($mysqli, $language);
        $o_roomId = $o_room->getRoom_id();
        $i = 0;
        foreach($o_roomId as $o_roomId){
            $room = new Room($mysqli, $o_roomId, $language);
            $urlImages = $room->getUrlArray();
        
            $i++;
            echo '<div class="col-md-12">';
            echo '</div>';
        }
        ?>
    </div>
   
    <div class='container'>
        <?php 
            $email = NULL;
            $o_review = new ReviewOverview($mysqli, 5, 5);
            
            $reviewer = $o_review->getId_user();
        ?>
        <br>
        <div id='container' class='container-fluid'>
            <?php
            $stop = 0;
            foreach($reviewer as $userId){
                $stop++;
                if($stop == 3){
                    continue;
                }
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
                <div class='col-md-4' style='background-color: whitesmoke;'>
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
                        <?= (substr($review_content, 0, 265)) . "<a href='/jemeppe/nl/recensies'>...</a>"; ?>
                    </blockquote>
                <p class='pull-right'>Published on: <?= $review_date ?></p>
                </div>
            
            <?php
            }
            ?>
        </div>
    </div>
    <br>
    
        <?php
            includeFile('frontend/footer.php');
        ?>
</html>