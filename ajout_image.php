<!DOCTYPE html>
<html>
<head>
    <title>Redimensionnement et découpage d'image</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" accept="image/png, image/jpeg">
        <input type="submit" value="Envoyer">
    </form>
<?php
if (isset($_FILES['image'])) {
    $file = $_FILES['image'];
    $filename = $file['tmp_name'];
    $filetype = $file['type'];

    if ($filetype == 'image/png' || $filetype == 'image/jpeg') {
        $source = imagecreatefromstring(file_get_contents($filename));

        $width = 360;
        $height = intval(imagesy($source) * $width / imagesx($source));
        $resized = imagecreatetruecolor($width, $height);
        imagecopyresampled($resized, $source, 0, 0, 0, 0, $width, $height, imagesx($source), imagesy($source));

        $parts = [];
        for ($x = 0; $x < 3; $x++) {
            for ($y = 0; $y < 3; $y++) {
                $part = imagecreatetruecolor(120, 120);
                imagecopy($part, $resized, 0, 0, $x * 120, $y * 120, 120, 120);
                $parts[] = $part;
            }
        }
        @
        $folderName = uniqid();
        $fullFolderPath = __DIR__ . '/captcha/asset/' . $folderName;
        mkdir($fullFolderPath, 0777, true);

        foreach ($parts as $index => $part) {
            $outputFilename = $fullFolderPath . '/' . ($index + 1) . '.png';
            imagepng($part, $outputFilename);
        }

        echo 'La photo a été envoyée avec succès !';

        imagedestroy($source);
        imagedestroy($resized);
        foreach ($parts as $part) {
            imagedestroy($part);
        }

        $folderPath = __DIR__ . '/captcha/asset/';
        $imageFiles = glob($folderPath . '*.png');

        $imageFileNames = [];
        foreach ($imageFiles as $imageFile) {
            $imageFileNames[] = basename($imageFile);
        }

        echo '<script>';
        echo 'var imageFileNames = ' . json_encode($imageFileNames) . ';';
        echo '</script>';
    } else {
        echo 'Veuillez sélectionner une image au format PNG ou JPEG.';
    }
}
?>    
</body>
</html>
