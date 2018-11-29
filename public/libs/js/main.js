
$(document).ready(function(){
 $('#search').keyup(function(){
const query = $("#search").val();
if(query.length > 2){
    console.log(query);
    $.ajax(
        {
            url: 'ajax.php',
            method: 'POST',
            data: {
                search: 1,
                q: query
            },
            success: function(data){
               $("#response").html(data);
            },
            dataType: 'text'
        }
    );
}
 });

$(document).on('click', 'li', function(){
    const birdname = $(this).text();
    $("#search").val(birdname);
    $("#response").html("");
})

});


