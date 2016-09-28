<?php

error_reporting(-1);
ini_set('display_errors', 'On');
/**
 * The Function can upload files to a folder on the server.
 * Allowed filetypes is being validated by the array "$allowed_mime_types".
 * Maximum allowed filsizes is validated by the variable "$allowed_file_size", but 
 * is ofcourse also changed by the options on the server itself.
 * 
 * @param array $FILES is a $_FILES array from upload
 * @param string $hvilken_mappe_skal_filen_gemmes_i destination 
 * @return array 
 */


function Upload($FILES, $hvilken_mappe_skal_filen_gemmes_i) {
    if (substr($hvilken_mappe_skal_filen_gemmes_i, -1) != "/") {
        $hvilken_mappe_skal_filen_gemmes_i .= "/";
    }
    $name = $FILES['name'];
    $type = $FILES['type'];
    $size = $FILES['size'];
    $error = $FILES['error'];
    
    $allowed_filetypes = array(
        'image/jpeg',
        'image/pjpeg',
        'image/gif',
        'image/png',
        'application/pdf'
    );

    //MAX validated filesizes - is said in  MB(mega-bytes)
    $allowed_filesize = 5.5;

    //and we're checking....
    if ($error != 0) {
        die("hejsa det er sket en fejl");
    }
    if (!in_array($type, $allowed_filetypes)) {
        die('The filetype is not allowed!');
    }
    if ($size / 1000000 > $allowed_filesize) {
        die('the file is to big, please change the size');
    }
    

    // Redeem the new filename, where we cleanse it from special characters, like "ÆØÅ" and SPACE etc.
    // first line: making the filename all lower-cased
    $new_filename = strtolower($name);

    // replaces æ ø å space and (,) to ae oe aa and the hyphen (-) and fullstop (.)
    $new_filename = str_replace(
            array('æ', 'ø', 'å', ' ', ','), array('ae', 'oe', 'aa', '_', ''),
            // Shall be packed in utf8_encode or else it wont understand æøå
            utf8_encode($new_filename)
    );
    // removing all un-needed characters, like arab signs etc./
    $new_filename = preg_replace("/[^A-Z0-9._-]/i", "_", $new_filename);

    //We put a timestamp in the front, so we dont overwrite the files that exist in the first place.
    $new_filename = time() . '_' . $new_filename;

    //We're checking if the file is going to overwrite a file that already exist with the same filename
    $i = 0;
    $parts = pathinfo($new_filename);
    while (file_exists($hvilken_mappe_skal_filen_gemmes_i . $new_filename)) {
        $i++;
        $new_filename = $parts['filename'] . '-' . $i . $parts['extension'];
    }

    //Now we're copying the file with the name the server gave it, to the folder we directed it to
    //If everything goes well, it will return TRUE, to the variable succes, if not then it will return FALSE
 
    //Out-comment the code below this, to get a copy of the uploaded file (just leave it gui) 
    //$success = copy($tmp_filename, $hvilken_mappe_skal_filen_gemmes_i . $new_filename);
    $succes = move_uploaded_file(
            $FILES['tmp_name'], $hvilken_mappe_skal_filen_gemmes_i . $new_filename);

    if ($succes) {
        return array(
            'filename' => $new_filename,
            'type' => $type,
            'dir' => $hvilken_mappe_skal_filen_gemmes_i
        );
    } else {
        die('Something weird happend..');
    }
}

