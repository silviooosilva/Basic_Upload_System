<?php

require __DIR__ . "/configs/connectionClass.php";


session_start();

$folder = "./uploads";
if (!is_dir($folder) && !is_file($folder)) {
    mkdir($folder, 0755);
}


$file = $_FILES['file'];
$description = $_POST['description'];


filter_var($description, FILTER_SANITIZE_SPECIAL_CHARS);

if (in_array("", $file) && empty($description)) {
    $_SESSION['error404'] = "Error: All fields are required";
    header("Location: ./../index.php");
} else {
    $fileName = $file['name'];
    $allowedTypes = ['image/png', 'image/jpeg', 'image/jpg'];

    if (in_array($file['type'], $allowedTypes)) {


        $saveConnection = new ConnectionClass($fileName, $description);
        $saveConnection->execute();


        $filePath = "./uploads/{$fileName}";
        move_uploaded_file($file['tmp_name'], $filePath);
        $_SESSION['fileName'] = $fileName;
        $_SESSION['description'] = $description;
        $_SESSION['success'] = "File uploaded successfully";


        header("Location: ./../index.php");
    } else {
        $_SESSION['error404'] = "Error: File type not allowed";
        header("Location: ./../index.php");
    }
}
