<?php

if(isset($_FILES['upload']['name'])){
    $file_name = $_FILES['upload']['name'];
    $file_path = 'data/fileContent'.$file_name;
    $file_extention = strtolower(pathinfo($file_path, PATHINFO_EXTENSION));

    if($file_extention == 'jpg' || $file_extention == 'jpeg' || $file_extention == 'png'){
        if(move_uploaded_file($_FILES['upload']['tmp_name'], $file_path))
        {
            $data['file'] = $file_name;
            $data['url'] = $file_path;
            $data['uploaded'] = 1;
        }
        else{
            $data['uploaded'] = 0;
            $data['error']['message']= 'Error! file not uploaded';
        }
    }else{
        $data['uploaded'] = 0;
        $data['error']['message']= 'Invalid extention';
    }
}
echo json_encode($data);

?>