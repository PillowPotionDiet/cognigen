<?php
/**
 * Video Server Configuration Test Script
 * Upload this to: pillowpotion.com/offers/video/test-video-config.php
 * Then access it via browser
 */

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Video Configuration Test</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .test { background: white; padding: 15px; margin: 10px 0; border-radius: 5px; border-left: 4px solid #4CAF50; }
        .fail { border-left-color: #f44336; }
        .warn { border-left-color: #ff9800; }
        h2 { color: #333; }
        code { background: #eee; padding: 2px 6px; border-radius: 3px; }
        .success { color: #4CAF50; font-weight: bold; }
        .error { color: #f44336; font-weight: bold; }
        .warning { color: #ff9800; font-weight: bold; }
    </style>
</head>
<body>
    <h1>🎬 Video Server Configuration Test</h1>

    <?php
    $videoFile = 'lead-4-final.mp4';
    $htaccessFile = '.htaccess';
    $tests = [];

    // Test 1: Check if video file exists
    $tests[] = [
        'name' => 'Video File Exists',
        'pass' => file_exists($videoFile),
        'message' => file_exists($videoFile)
            ? "✓ Video file found: $videoFile"
            : "✗ Video file NOT found: $videoFile",
        'fix' => 'Upload the video file to this directory'
    ];

    // Test 2: Check if video is readable
    if (file_exists($videoFile)) {
        $tests[] = [
            'name' => 'Video File Readable',
            'pass' => is_readable($videoFile),
            'message' => is_readable($videoFile)
                ? "✓ Video file is readable"
                : "✗ Video file is NOT readable",
            'fix' => 'Run: chmod 644 ' . $videoFile
        ];

        // Test 3: Check video file size
        $fileSize = filesize($videoFile);
        $fileSizeMB = round($fileSize / 1024 / 1024, 2);
        $tests[] = [
            'name' => 'Video File Size',
            'pass' => $fileSize > 0,
            'message' => "File size: $fileSizeMB MB",
            'fix' => $fileSizeMB > 100 ? 'Consider compressing video to under 50MB' : 'File size is OK',
            'warn' => $fileSizeMB > 100
        ];
    }

    // Test 4: Check if .htaccess exists
    $tests[] = [
        'name' => '.htaccess File Exists',
        'pass' => file_exists($htaccessFile),
        'message' => file_exists($htaccessFile)
            ? "✓ .htaccess file found"
            : "✗ .htaccess file NOT found",
        'fix' => 'Upload the .htaccess file to this directory'
    ];

    // Test 5: Check if mod_headers is loaded
    $modHeaders = function_exists('apache_get_modules')
        ? in_array('mod_headers', apache_get_modules())
        : null;

    if ($modHeaders !== null) {
        $tests[] = [
            'name' => 'mod_headers Module',
            'pass' => $modHeaders,
            'message' => $modHeaders
                ? "✓ mod_headers is enabled"
                : "✗ mod_headers is NOT enabled",
            'fix' => 'Contact hosting provider to enable mod_headers'
        ];
    }

    // Test 6: Check PHP file upload limits
    $uploadMax = ini_get('upload_max_filesize');
    $postMax = ini_get('post_max_size');
    $tests[] = [
        'name' => 'PHP Upload Limits',
        'pass' => true,
        'message' => "upload_max_filesize: $uploadMax | post_max_size: $postMax",
        'fix' => 'These should be at least 150M for your video'
    ];

    // Test 7: Check if we can set headers
    if (file_exists($videoFile)) {
        $videoUrl = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/' . $videoFile;
        $tests[] = [
            'name' => 'Video URL',
            'pass' => true,
            'message' => "Video URL: <a href='$videoUrl' target='_blank'>$videoUrl</a>",
            'fix' => 'Click the link above to test if video is accessible'
        ];
    }

    // Display results
    foreach ($tests as $test) {
        $class = 'test';
        $status = '';

        if (isset($test['warn']) && $test['warn']) {
            $class .= ' warn';
            $status = '<span class="warning">WARNING</span>';
        } elseif (!$test['pass']) {
            $class .= ' fail';
            $status = '<span class="error">FAILED</span>';
        } else {
            $status = '<span class="success">PASSED</span>';
        }

        echo "<div class='$class'>";
        echo "<h3>{$test['name']} - $status</h3>";
        echo "<p>{$test['message']}</p>";
        if (!$test['pass'] || (isset($test['warn']) && $test['warn'])) {
            echo "<p><strong>Fix:</strong> {$test['fix']}</p>";
        }
        echo "</div>";
    }
    ?>

    <div class="test">
        <h3>Server Information</h3>
        <p><strong>Server Software:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></p>
        <p><strong>PHP Version:</strong> <?php echo phpversion(); ?></p>
        <p><strong>Current Directory:</strong> <?php echo __DIR__; ?></p>
        <p><strong>Document Root:</strong> <?php echo $_SERVER['DOCUMENT_ROOT']; ?></p>
    </div>

    <div class="test">
        <h3>📋 Next Steps</h3>
        <ol>
            <li>Ensure all tests above pass (green)</li>
            <li>Click the video URL link above to test direct access</li>
            <li>Check browser console for specific error codes</li>
            <li>If video is over 100MB, consider compressing it</li>
            <li>Contact hosting provider if mod_headers is disabled</li>
        </ol>
    </div>

</body>
</html>
