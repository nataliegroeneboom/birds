

function previewImage(){
    const file = document.querySelector('#imagePreview').files[0];
    const preview = document.querySelector('#previewbird');
    const reader = new FileReader();

    reader.addEventListener("load", function(){
    preview.src = reader.result;
    }, false);
    if(file){
        reader.readAsDataURL(file);
    }
}
const ele = document.getElementsByClassName("content");
const num = document.getElementsByClassName("content").length;
for(i=0; i< num; i++){
    $clamp(ele[i], {clamp: '100px', useNativeClamp:false})
}

$('.navbar-toggle').on('click', function() {
    $(this).toggleClass('open');
    $('.icon-bar').toggleClass('open');
});

$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        autoPlay: 3000,
        loop:true,
        items: 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3]
    });
});












