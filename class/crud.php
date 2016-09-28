<?php

class crud {

    private $dbCon;

    function __construct($dbCon) {
        $this->dbCon = $dbCon;
    }

    public function create($title, $text, $img_path) {
        try {
            date_default_timezone_set('Europe/Copenhagen');
            $stmt = $this->dbCon->prepare("INSERT INTO images (title, description, path, date) 
                                                       VALUES(:title, :description, :path, :date)");

            $todayDate = date('Y-m-d H:i:s'); //todays date, ex: 2016-04-29 10:12:18

            $stmt->bindparam(":title", $title);
            $stmt->bindparam(":description", $text);
            $stmt->bindparam(":path", $img_path);
            $stmt->bindparam(":date", $todayDate);

            $stmt->execute();

            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

}

?>