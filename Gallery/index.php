<?php
include ($_SERVER['DOCUMENT_ROOT'].'/includes/constants.php');
include ($_SERVER['DOCUMENT_ROOT'].'/templates/header.php');
include ($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');

if(isset($_POST['upload'])) {

        $countFiles = countPhotos($_FILES['photos']['name']); //счетчик файлов

    if ($countFiles <=$countUploadFiles) {
        $success = false;

        for ($i = 0; $i <$countFiles; $i++) {

            if(!$_FILES['photos']['type'][$i] == in_array(getMimeType($_FILES['photos']['tmp_name'][$i]), $types)) {
                // если размер меньше или равен 5 мегабайт
                galleryMessage('Можно загружать только изображения '. implode(' , ', $types), false);
                continue;
            }

            if ($_FILES['photos']['size'][$i] >= $sizeUploadFile) {
                galleryMessage('Размер картинки не должен превышать ' . $sizeUploadFile/1024/1024 . ' мб', false);
                continue;
            }

            if(file_exists($filePath.$_FILES['photos']['name'][$i])) {
                galleryMessage('Один из выбранных файлов уже загружен', false);
                continue;
            }

            move_uploaded_file($_FILES['photos']['tmp_name'][$i], $uploadPath . $_FILES['photos']['name'][$i]);
            $success = true;

        }
        if ($success) {
            galleryMessage('Изображения успешно загружены');
        }
    } else {
        galleryMessage('Максимальное количество файлов ' . $countUploadFiles, false);
    }
} ?>

<body>
<div class="gallery">
    <form name="uploadForm" class="gallery__form gallery__form--upload" action="/" method="post" enctype="multipart/form-data">
        <input type="file" name="photos[]" multiple="multiple" accept="<?=implode(' , ', $types) ?>">
        <input class="gallery__button gallery__button--upload" id="uploadButton" name="upload" type='submit' value='Загрузить фото'>
    </form>
</div>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/gallery.php'); ?>
    <script type="text/javascript" src="/scripts/reset.js"></script>
</body>
</html>
