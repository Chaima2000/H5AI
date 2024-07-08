// ouvrir le fichier 
    window.onload = function() {
        var tableRows = document.querySelectorAll('table tbody tr');
        tableRows.forEach(function(row) {
            row.addEventListener('click', function() {
                var fileName = this.getAttribute('data-file');
                window.location = 'view_file.php?file=' + fileName;
            });
        });
    };

// faire la fléche 
document.addEventListener('DOMContentLoaded', function() {
            var toggleArrows = document.querySelectorAll('.toggle-arrow');
            toggleArrows.forEach(function(arrow) {
                arrow.addEventListener('click', function() {
                    var subFolder = arrow.nextElementSibling;
                    if (subFolder.style.display === 'none') {
                        subFolder.style.display = 'block';
                        arrow.textContent = '▼'; 
                    } else {
                        subFolder.style.display = 'none';
                        arrow.textContent = '▶'; 
                    }
                });
            });
        });
        
        