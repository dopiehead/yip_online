
function openPopup(){
    $("#popupOverlay").fadeIn(200);
    $(".popup-content").fadeIn(200);
}

function closePopup(){
    $("#popupOverlay").fadeOut(200);
    $(".popup-content").fadeOut(200);
}

// Clicking outside closes popup
$("#popupOverlay").on("click", closePopup);

$(document).on("submit", "#update-user", function(e){
    e.preventDefault();

    const form = $(this);
    const btn = form.find("button[type=submit]");
    const data = form.serialize();

    $.ajax({
        url: "edit-user-details",
        type: "POST",
        data: data,
        dataType: "json",

        beforeSend: function(){
            btn.prop("disabled", true).text("Saving...");
        },

        success: function(response){
            if(response.status === "success"){
                swal("Success", response.message, "success");

                $(".popup-content").fadeOut(200);
                $("#popupOverlay").fadeOut(200);
            } else {
                swal("Notice", response.message, "warning");
            }
        },

        error: function(xhr){
            swal("Error", "Server error or invalid JSON response", "error");
            console.log(xhr.responseText);
        },

        complete: function(){
            btn.prop("disabled", false).text("Save Changes");
        }
    });
});


