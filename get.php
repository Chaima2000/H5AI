<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sous-dossiers des sous-dossiers</title>
    
</head>
<body>
    
    <div id="subSubDirectories">
        <h2>Sous-dossiers des sous-dossiers</h2>
        <table>
            <thead>
                <tr>
                    <th>Dossier principal</th>
                    <th>Sous-dossier</th>
                </tr>
            </thead>
            <tbody>
        <?php
include 'H5ai.php';

$basePath = "/home/epitech4/snap";
$h5ai = new H5AI($basePath);
$subSubDirectories = $h5ai->getSubSubDirectories();
echo json_encode($subSubDirectories);
?><</tbody>
</table>
</div>
        
</body>
</html>


