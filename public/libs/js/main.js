

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
const ele = document.getElementsByClassName("description");
const num = document.getElementsByClassName("description").length;
for(i=0; i< num; i++){
    $clamp(ele[i], {clamp: 5, useNativeClamp:false})
}







