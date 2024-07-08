<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>H5AI</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="H5ai.js"></script>
    <link rel="icon" href="favicon.ico" />
    
</head>
<body>
    <h1>H5AI</h1>
    
    <section>
        <div class="breadcrumb">
        <?php
                        include 'H5ai.php';
                        $basePath = "/home/epitech4/snap";
                        $h5ai = new H5AI($basePath);
                        $h5ai->printCurrentPath();
                        
                        ?>
        </div>

        <div class="content-container">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Fichier</th>
                            <th>Date de la dernière modification</th>
                            <th>Taille</th>
                            <th>Dossier</th>
                            <th>Date de la dernière modification</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $h5ai->printDirectoryContents();
                        ?>
                    </tbody>
                </table>
            </div>
             <!-- l'Arborescence -->
             <div class="directory-tree-container">
                <br>
                <ul class="directory-tree">
                    <?php
                    

                    $h5ai->printDirectoryTree($basePath);
                    ?>
                </ul>
            </div>
        </div>
    </section>
    <!-- Div pour afficher les sous-dossiers des sous-dossiers -->
    <a href="get.php">Afficher les sous-dossiers des sous-dossiers</a>


</body>
</html>