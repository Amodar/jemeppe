<?php
include_once 'db_connect.php';
//retrieving content through ID as parameter
//different methods(different parameters) in retrieving content


function getContentByID($id, $mysqli) {
    $thumbnail = "images/thumbnails/" . $_POST['thumbnail'];
    $title = $_POST['title'];
    $article = $_POST['editor1'];
    $published_date = $_POST['date'];
    $hidden = $_POST['hidden'];
    $subject = $_POST['subject'];
    $category = $_POST['category'];
    
    if($stmt = $mysqli->prepare("INSERT INTO article (thumbnail, title, article, published_date, hidden, subject, category) VALUES (?, ?, ?, ?, ?, ?, ?);")) {
        $stmt->bind_param('ssssiss', $thumbnail, $title, $article, $published_date, $hidden, $subject, $category);
        
        $stmt->execute();
        return true;
    } else {
        return false;
    }
}

function getContentByCategory($category, $lang, $mysqli) {
    $lang = $_POST['lang'];
    
     if ($stmt = $mysqli->prepare("SELECT articleId, thumbnail, title, article, subject, category, published_date from article where articleId= ?;")) {
 
        $stmt->bind_param('s', $articleId);
        $stmt->execute();
        $stmt->store_result();
        
        $stmt->bind_result($db_articleId, $thumbnail, $title, $article, $subject, $category, $published_date);
        $stmt->fetch();
        
        echo $db_articleId . "<br>";
        echo $thumbnail . "<br>";
        echo $title . "<br>";
        echo $article . "<br>";
        echo $subject . "<br>";
        echo $category . "<br>";
        echo $published_date . "<br>";
        
        
    } else {
        echo "something went wrong!";
    }
}



?>