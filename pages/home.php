<?php
    $SQL = "SELECT id, title, description, date, path  
        FROM images 
        ORDER BY date DESC";
    
   $query = $dbCon->query($SQL);
   $query->setFetchMode(PDO::FETCH_ASSOC);
?>
    <div class="content_news">
                <div id="modalBox">
            <div class="closeModal">Close box</div>
            <div class="modalChecker"></div>
        </div>
<?php
while ($row = $query->fetch()):
    $dateFromDB = $row['date'];
    $dateWritten = strtotime( $dateFromDB );
    $new_date = date( 'Y-m-d', $dateWritten );
    
$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
    echo "<div class='content_box'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p class='created_content_date'>Written: ".$new_date."</p>";
        echo "<img src='../".$row['path']."' alt='".$row['description']."' title='".$row['title']."'>";
        echo "<p>" . $row['description'] . "</p>";
    echo "</div>";
endwhile;
?>
        </div>
