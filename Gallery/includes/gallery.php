<?php

if (isset($_POST['deletePhotos'])) {

    if(isset($_POST['photo'])) {

        for ($i = 0; $i < countPhotos($_POST['photo']); $i++) {
            if(file_exists($filePath.$_POST['photo'][$i])) {
                if(strpos(realpath($filePath), realpath($uploadPath))  === 0) {
                    $unlink = unlink($filePath.$_POST['photo'][$i]);
                }


            }
        }
    }
}

if ($open = scandir($filePath)) { ?>
    <div class="gallery">
        <form onsubmit="deletePhotos(); return false;" id="deletePhoto" action="/" method="post" class="gallery__form"><?php
            foreach ($open as $photo) {
                if ($photo != '.' && $photo != '..') { ?>
                    <div class="gallery__photo">
                        <input type="checkbox" name="photo[]" value="<?=$photo;?>" class="gallery__checkbox"/>
                        <label for="photo[]" class="gallery__label">
                            <img src=" <?=$filePath.$photo ?> " width="200px"  alt="" />
                        </label>
                    </div><?php
                }
            }
            if (countPhotos($open) > 2) { ?>
                <input type="submit" name="deletePhotos" value="Удалить фотографии" class="gallery__button" /><?php
            } ?>
        </form>
    </div><?php
}
