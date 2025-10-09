function fill(value) {
    $('#search').val(value);
    $('#display').hide();
}

$(document).ready(function() {
    $("#search").keyup(function() {
        let query = $(this).val().trim();
        if(query === "") {
            $("#display").empty().hide();
        } else {
            $.ajax({
                type: "POST",
                url: "ajax.php",
                data: { search: query },
                success: function(response){
                    $("#display").html(response).show();
                }
            });
        }
    });
});