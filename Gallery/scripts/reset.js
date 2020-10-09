(function () {
    function deletePhotos() {
        let form = document.getElementById('deletePhoto');
        let formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.open('POST','/index.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send(formData);

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === 4 && this.status === 200) {
                console.log(this.responseText);
            }
        })
    }
})();
