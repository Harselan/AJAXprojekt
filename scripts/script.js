$(document).ready(function() {  
    //Visar upp kommentarerna när sidan laddas upp
    ajaxshower();
    function ajaxshower(){
        $.ajax({ 
            url: "../ajaxcommentsystem/data/getdata.php",
            dataType:'JSON',
            success: function(result) {
                result = JSON.parse(result);
                $(".comments").remove();
                var comments;
                comments = $("<div class='comments'>");
                comments.append("<h1>Kommentarer</h1>");
                for(var i = 0; i < result.length; i++){
                    comments.append("<h3>"+result[i].NAME+":</h3>"+result[i].COMMENT+"<br><br>");
                }
                $('.wrapper').prepend(comments);
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('error: ' + textStatus + ': ' + errorThrown);
            }
        });
    }
    //Uppdaterar kommentarerna
    setInterval(function(){
        ajaxshower();        
    },2000);
    //Lägger till en kommentar
    $("#form").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var inputs = form.serialize();
        $.ajax({
            url:"../ajaxcommentsystem/data/insertdata.php",
            type:"post",
            data:inputs,
            success: function(){
                form.find(".inputtext").val("");
                ajaxshower(); 
            }
        });
    }); 
});