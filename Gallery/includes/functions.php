<?php
function galleryMessage($text, $good = true) {
    $goodClass = $good ? 'good-message' : 'wrong-message'; ?>

    <div class="<?=$goodClass ?>">
        <p><?=$text ?></p>
    </div><?php
}

function countPhotos($photo) {
    return count($photo);
}

function getMimeType($filename) {
    if(!empty($filename)) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $info = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $info;
    }
}
