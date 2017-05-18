$(document).ready(function() {
    $("#btn").click(function() {
        $.ajax({
            type:'POST', 
            url: "../ajaxtest/data/getdata.php",
            dataType:'JSON',
            success: function(result) {
                var text = JSON.parse(result);
                $('p').innerHTML = text.name + " " + text.time;              
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('error: ' + textStatus + ': ' + errorThrown);
            }
        });
    }); 
});