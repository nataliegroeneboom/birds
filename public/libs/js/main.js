

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


$(".content").each(function(index,element){
    $clamp(element, {clamp:'150px'});
});

$('.navbar-toggle').on('click', function() {
    $(this).toggleClass('open');
    $('.icon-bar').toggleClass('open');
});

$(document).ready(function(){
    $(".owl-carousel").owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        autoHeight: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
});












