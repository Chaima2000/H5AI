<?php
class H5AI
{
    private $_basePath;

    // icones
    private $_fileIcons = [
        'php' => 'php-icon.png',
        'js' => 'js-icon.png',
        'css' => 'css-icon.png',
        'html' => 'html-icon.png', 
        'sql' => 'sql-icon.png',
        'jpg' => 'jpg-icon.png',
        'png' => 'png-icon.png',
        'dossier' => 'dossier-icon.png', 
    ];

    public function __construct($basePath)
    {
        $this->_basePath = $basePath;
    }

// breadcrumb
    public function getBreadcrumbs($path)
{
    $breadcrumbs = [];
    $parts = explode('/', $path);
    $currentPath = '';
    
    foreach ($parts as $part) {
        $currentPath .= '/' . $part;
        $breadcrumbs[] = ['name' => $part, 'path' => $currentPath];
    }
    
    return $breadcrumbs;
}
// j'ai recuperer le chemain depuit la racine 
    public function printCurrentPath()
{
    $requestedPath = $this->getRequestedPath();
    $absolutePath = realpath($requestedPath);
    $breadcrumbs = $this->getBreadcrumbs($absolutePath);

    echo '<ul class="breadcrumbs">';
    foreach ($breadcrumbs as $breadcrumb) {
        echo '<li><a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '?path=' . htmlspecialchars($breadcrumb['path']) . '">' . htmlspecialchars($breadcrumb['name']) . '</a></li>';
    }
    echo '</ul>';
}
// faire Arborescence

public function printDirectoryContents()
{
    $requestedPath = $this->getRequestedPath();
    $contents = $this->getDirectoryContents($requestedPath);

    // Afficher les fichiers et les dossiers
    foreach ($contents as $content) {
        if ($content['is_file']) {
            echo "<tr>";
            echo "<td>";
            echo "<a href='view_file.php?file={$content['name']}' target='_blank'>"; // lien vers view_file.php
            echo "<img class='icon' src='icons/{$content['icon']}' alt='{$content['icon']}'>";
            echo "{$content['name']}";
            echo "</a>";
            echo "</td>";
            echo "<td>{$content['modified_date']}</td>";
            echo "<td>{$content['size']}</td>";
            echo "<td></td>"; 
            echo "<td></td>"; 
            echo "</tr>";
        } else {
            echo "<tr>";
            echo "<td></td>"; 
            echo "<td></td>";
            echo "<td></td>"; 
            echo "<td>";
            echo "<img class='icon' src='icons/{$content['dossier_icon']}' alt='{$content['dossier_icon']}'>";
            echo "{$content['name']}";
            echo "</td>";
            echo "<td>{$content['modified_date']}</td>";
            echo "</tr>";
        }
    }
}

public function printDirectoryTree($basePath)
{
    echo '<ul class="directory-tree">';
    $this->printSubDirectories($basePath);
    
    echo '</ul>';
}

private function printSubDirectories($basePath, $isMainFolder = true)
{
    $folders = glob($basePath . '/*', GLOB_ONLYDIR);
    
    foreach ($folders as $folder) {
        $folderName = basename($folder);
        echo '<li>';
        if ($isMainFolder) {
            echo '<a href="#" class="toggle-arrow">▶ ' . $folderName . '</a>'; // Lien avec la classe "toggle-arrow" devant le nom du dossier
        } else {
            echo '<span class="folder">' . $folderName . '</span>'; // Affiche simplement le nom du sous-dossier
        }
        echo '<img class="icon" src="icons/dossier-icon.png" alt="dossier-icon">';
        
        // Afficher les sous-dossiers récursivement sans le lien "toggle-arrow"
        echo '<ul>';
        $this->printSubDirectories($folder, false); // Passer false pour indiquer que ce n'est pas un dossier principal
        echo '</ul>';
        echo '</li>';
    }
}


public function getSubSubDirectories()
{
    $subSubDirectories = [];
    $subDirectories = glob($this->_basePath . '/*', GLOB_ONLYDIR);
    
    foreach ($subDirectories as $subDirectory) {
        $subSubDirectories[basename($subDirectory)] = glob($subDirectory . '/*', GLOB_ONLYDIR);
    }
    
    return $subSubDirectories;
}



    private function getRequestedPath()
    {
        $requestedPath = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $requestedPath = substr($requestedPath, strpos($requestedPath, 'h5ai/') + 5);
        return $this->_basePath . '/' . $requestedPath;
    }

    private function getDirectoryContents($path)
    {
        $contents = [];
        $items = glob($path . '/*');

        foreach ($items as $item) {
            $name = basename($item);
            $modifiedDate = date('Y-m-d H:i:s', filemtime($item));
            $size = is_file($item) ? filesize($item) . ' bytes' : '';
            $extension = pathinfo($item, PATHINFO_EXTENSION);
            $icon = isset($this->_fileIcons[$extension]) ? $this->_fileIcons[$extension] : 'default-icon.png';
            $is_file = is_file($item);
            $dossier_icon = $this->_fileIcons['dossier']; // icone pour les dossiers

            $contents[] = [
                'name' => $name,
                'modified_date' => $modifiedDate,
                'size' => $size,
                'icon' => $icon,
                'is_file' => $is_file,
                'dossier_icon' => $dossier_icon, 
                'extension' => $extension //pour la vérification du favicon HTML
            ];
        }

        return $contents;
    }
    
}
?>