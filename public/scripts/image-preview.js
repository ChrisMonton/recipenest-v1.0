
$(document).ready(() => {
    previewImage();
});

function previewImage() {
    console.log('preview image function ready');

    // Source: https://www.geeksforgeeks.org/preview-an-image-before-uploading-using-jquery/
    const photoInp = $("#image-input");
    let file;

    console.log(photoInp);

    photoInp.change(function (e) {
        file = this.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (event) {
                $("#imgPreview")
                    .attr("src", event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
}
