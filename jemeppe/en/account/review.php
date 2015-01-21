<?php
ob_start();
session_start();
include( $_SERVER['DOCUMENT_ROOT'] . '/jemeppe/loader.php' );
includeFile('backend/model/cookie.php');
includeFile('backend/model/validation.php');
includeFile('backend/model/Price.class.php');
includeFile('backend/model/User.class.php');
includeFile('backend/model/Review.class.php');

$email = $_SESSION['email'];
$user = new User($mysqli, $email);
$id_user = $user->getId_user();



?>

<html>
    <head>
        <?php includeFile('frontend/standard.php'); ?>
        <script src="includes/frontend/ckeditor/ckeditor.js" type="text/javascript"></script>

            <script>
                CKEDITOR.replace('editor1');
            </script>
    </head>
    <body>
        <?php 
        includeFile('frontend/navigation.php');
        if (login_check($mysqli) == true) {
            $review = new Review($mysqli, $language, $id_user);
            
            $review_id = $review->getId_review();
            $review_content = $review->getReview();
            $review_rating = $review->getRating();
            
            if(isset($_POST['submit']) == "update") {
                $rating = $_POST['rating'];
                $editor = $_POST['editor'];
                
                $review->setLanguage($language);
                $review->setRating($rating);
                $review->setReview($editor);
                
                $review->updateReview($mysqli);
                header("location: http://www.broowse.com/jemeppe/en/account/review?msg=1");
            }
            if(isset($_POST['submit']) == "submit") {
                $rating = $_POST['rating'];
                $editor = $_POST['editor'];
                
                $review->setId_user($id_user);
                $review->setLanguage($language);
                $review->setRating($rating);
                $review->setReview($editor);
                
                $review->insertReview($mysqli, $id_user);
                header("location: http://www.broowse.com/jemeppe/en/account/review?msg=1");
            }
        ?>
        <br>
        <div class='container'>
            
            <form action='en/account/review' method='POST'>
                <label>Your rating</label>
                <select class='form-control' name='rating'>
                    <?php
                    echo $review_rating == null ? "<option selected>" : "</option>";
                    echo "Choose a rating";
                    echo "</option>";
                    for($i = 1; $i <= 5; $i++) {
                        echo $review_rating == $i ? "<option selected>" : "<option>";
                        echo $i;
                        echo "</option>";
                    }
                    ?>
                </select>
                <br>
                <?php echo isset($_GET['msg']) == 1 ? "<p class='mark centered'>Your review has been placed, thank you.</p>" : null; ?>
                <label>Your review</label>
                <textarea id="editor1" name='editor'>
                <?= $review_content ?>
                </textarea>
                <br>
                <?php
                if ($review_rating == null) {
                    echo '<input type="submit" value="submit" class="form-control pull-right btn btn-default" method="execute" key="content" class="btn" name="submit">';
                } else {
                    echo '<input type="submit" value="update" class="form-control pull-right btn btn-default" method="execute" key="content" class="btn" name="submit">';
                }
                ?>
                    <?php 
                /*
                if(isset($_POST['submit'])) {
                    if (isset($_POST['hidden'], $_POST['category'], $_POST['subject'], $_POST['thumbnail'], $_POST['title'], $_POST['editor1'])) {

                        if(push_article($mysqli) == true) {


                        }
                        } else {
                            echo "something went wrong";
                        }
                    } else {
                        echo "you forgot something";
                    }
                } */
                ?>
            </form>
        </div>
        
        <?php
        }
        ?>
    </body>
    
    <script>
            CKEDITOR.replace('editor1');
    </script>
</html>