<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="style.css" rel="stylesheet" />

</head>
<body>
<?php
    $previousPage = $_SERVER['HTTP_REFERER'] ?? '';
    ?>

    <button class="retour"><a href="<?php echo $previousPage; ?>" >Retour</a></button>
</body>
</html>
<?php
if (isset($_GET['file'])) {
    $basePath = "/home/epitech4/Documents";
    $requestedFile = $_GET['file'];
    $filePath = $basePath . '/' . $requestedFile;

    
    if (file_exists($filePath) && is_file($filePath)) {

        $fileContent = file_get_contents($filePath);
        echo "<pre>{$fileContent}</pre>";

    } else {
        echo "Le fichier spécifié n'existe pas.";
    }
} else {
    echo "Aucun fichier spécifié.";
}
?>