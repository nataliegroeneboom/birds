

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
const ele = document.getElementsByClassName("content");
const num = document.getElementsByClassName("content").length;
console.log(num);
for(i=0; i< num; i++){
    console.log('clamping');
    $clamp(ele[i], {clamp: '100px', useNativeClamp:false})
}

$('.navbar-toggle').on('click', function() {
    $(this).toggleClass('open');
    $('.icon-bar').toggleClass('open');
});







