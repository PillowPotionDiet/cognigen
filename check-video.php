<?php
/**
 * Quick Video Check Script
 * Upload to: public_html/offers/video/check-video.php
 * Access via: http://pillowpotion.com/offers/video/check-video.php
 */

$videoFile = 'lead-4-final.mp4';
$currentDir = __DIR__;

echo "<h1>Video File Check</h1>";
echo "<pre>";

echo "Current Directory: $currentDir\n";
echo "Looking for: $videoFile\n\n";

if (file_exists($videoFile)) {
    echo "✓ FILE EXISTS\n\n";

    echo "File Size: " . round(filesize($videoFile) / 1024 / 1024, 2) . " MB\n";
    echo "Is Readable: " . (is_readable($videoFile) ? "YES" : "NO") . "\n";
    echo "Permissions: " . substr(sprintf('%o', fileperms($videoFile)), -4) . "\n\n";

    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $httpUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $videoFile;
    $httpsUrl = "https://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/" . $videoFile;

    echo "HTTP URL:\n";
    echo "<a href='$httpUrl' target='_blank'>$httpUrl</a>\n\n";

    echo "HTTPS URL:\n";
    echo "<a href='$httpsUrl' target='_blank'>$httpsUrl</a>\n\n";

    echo "Click the URLs above to test if they work!\n";

} else {
    echo "✗ FILE NOT FOUND\n";
    echo "Files in this directory:\n";
    $files = scandir('.');
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            echo "  - $file\n";
        }
    }
}

echo "</pre>";
?>
