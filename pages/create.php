<?php
include_once('include/upload.php');
//$user_id = $_SESSION['userSession']; //see session.php under "include" folder
//    
//
if (isset($_POST['create_news'])) { //if we have pressed the submit button
    $title = $_POST['title'];
    $article_text = $_POST['article_text'];
    $imagefile = $_FILES['upload'];

    //USING THE CRUD.PHP CLASS
    
    if ($title == "") {
        echo $user->redirect('/pages/create?f=title');
    }elseif ($article_text == "") {
        echo $user->redirect('/pages/create?f=text');
    }elseif ($title != "" && $article_text != "" && $imagefile != "" ) {
        $billeder = $_FILES['upload'];
$antalBilleder = count($billeder["name"]) - 1;

for ($i = 0; $i <= $antalBilleder; $i++) {
    foreach ($billeder as $key => $value) {
        $billede[$i][$key] = $value[$i];
    }
}

$uploadDir = "images/";
foreach ($billede as $value) {
    $info = Upload($value, $uploadDir);

    $filename = $info['filename'];
    $imageTotal = $uploadDir . "" . $filename . "";

    $image = getimagesize($imageTotal);
    $image_width = $image[0];
    $image_height = $image[1];
    }
        $crud->create($title, $article_text, $imageTotal); //here we call tle crud->create function
        echo $user->redirect('/pages/create?s=content');
        
        
    }else {
        $error = "Wrong Details !";
    }
}
?>
<div class="flex_box_user">
    <form action="/pages/create" method="POST" id="create_form" enctype="multipart/form-data">
        <?php
if($succes == "content"){
    echo "<p class='text_succes'>You created some content! Go to the view page!</p>";
}
?>
        
        <div>
            <!-- if something failed -->
            <?php
            if($failed == "title"){
                echo "<p class='bad_response'>you need a title!</p>";
            }
            ?>
            
            <label for="title">Title for image:</label>
            <input type="text" name="title" id="title" placeholder="Ex: Blue Ocean Robotics is awesome!">
        </div>
        <div>
            <?php
            if($failed == "file"){
                echo "<p class='bad_response'>Select!</p>";
            }
            ?>
            <label for="file">Select image:</label>
            <input type="file" name="upload[]" id="image_select">
        </div>
        <div>
            <!-- if something failed -->
            <?php
            if($failed == "text"){
                echo "<p class='bad_response'>Descripe the image!</p>";
            }
            ?>
            
            <label for="article_text">Descripe the image:</label>
            <textarea name="article_text" id="article_text" placeholder="The entire crew of Blue Ocean Robotics!"></textarea>
        </div>    

        <input type="submit" name="create_news" value="Create">
    </form>

</div>