<?php
ob_start();
//   ../../img/catalogo_productos/
// Get real path for our folder
$rootPath = realpath('../../img/catalogo_productos/');

// Initialize archive object
$zip = new ZipArchive();
$zip->open('../../img/CATALOGO_MUEBLERIA.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}
// Zip archive will be created only after closing object
$zip->close();
$file = "../../img/CATALOGO_MUEBLERIA.zip";
$nombreR="CATALOGO MUEBLERIA.zip";
header('Content-Type: application/zip');
header("Content-Disposition: attachment; filename=$nombreR");
//header('Content-Length: ' . filesize($file));
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

ob_end_clean();
readfile($file);
exit;
ob_end_flush();

?>