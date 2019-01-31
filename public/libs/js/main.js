

    console.log('hello from main.js');


function previewImage(){
    const file = document.querySelector('#imagePreview').files[0];
    const preview = document.querySelector('#previewbird');
    console.log(file);
    console.log(preview);

    const reader = new FileReader();

    reader.addEventListener("load", function(){
    preview.src = reader.result;
    }, false)
    if(file){
        reader.readAsDataURL(file);
    }
}






