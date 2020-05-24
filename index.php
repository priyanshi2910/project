<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">

<title>Project</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>



<body>

<div class="container">
	<div class="container-grid">
		<div class="section1">
          <a href="">Image</a>


</div>
		<div class="section2">
            <a href="image2.jpg">Image</a>


</div>
		<div class="section3">
           <a href="video.mp4">Video</a>

</div>
		<div class="section4">
           <a href="audio2.mp3">Audio</a>

</div>
                <div class="section5">
           <a href="audio1.mp3">Audio</a>

</div>
                <div class="section6">
          <a href="pdf1.pdf">PDF</a>


</div>
                
       </div> </div>

</body>

<?php

const IMAGE_HANDLERS = [
    IMAGETYPE_JPEG => [
        'load' => 'imagecreatefromjpeg',
        'save' => 'imagejpeg',
        'quality' => 100
    ]];

function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {
$type = exif_imagetype($src);
if (!$type || !IMAGE_HANDLERS[$type]) {
        return null;
    }
$image = call_user_func(IMAGE_HANDLERS[$type]['load'], $src);
if (!$image) {
        return null;
    }
$width = imagesx($image);
    $height = imagesy($image);
if ($targetHeight == null) {
 $ratio = $width / $height;
if ($width > $height) {
            $targetHeight = floor($targetWidth / $ratio);
        }
else {
            $targetHeight = $targetWidth;
            $targetWidth = floor($targetWidth * $ratio);
        }
    }
 $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
 if ( $type == IMAGETYPE_JPEG) {

        imagecolortransparent(
            $thumbnail,
            imagecolorallocate($thumbnail, 0, 0, 0)
        );
imagealphablending($thumbnail, false);
            imagesavealpha($thumbnail, true); }

imagecopyresampled(
        $thumbnail,
        $image,
        0, 0, 0, 0,
        $targetWidth, $targetHeight,
        $width, $height
    );

return call_user_func(
        IMAGE_HANDLERS[$type]['save'],
        $thumbnail,
        $dest,
        IMAGE_HANDLERS[$type]['quality']
    );
}

createThumbnail('image1.jpg', 'image1thumbnail.jpg', 160);

?>





