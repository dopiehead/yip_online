$('#login-form').on('submit', function(e) {
    e.preventDefault();

    // Show loading, disable button
    $(".spinner-border").show();
    $(".signin-note").hide();
    $('.btn-custom').prop('disabled', true);

    const formData = $(this).serialize(); 
    const redirectUrl = $("#redirectUrl").val(); 

    $.ajax({
        type: "POST",
        url: "login-post",
        data: formData,
        dataType: "json", // Expect JSON response
        success: function(response) {
            $(".spinner-border").hide();
            $(".signin-note").show();
            $('.btn-custom').prop('disabled', false);

            if (response.status === "success") {
                // Redirect either to the hidden field or server-specified redirect
                window.location.href = redirectUrl ? redirectUrl : response.redirect;
            } else {
                $("#message").text(response.message || "Login failed");
                $("#email-input-field, #password-input-field").addClass("border border-2 border-danger");
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            $(".spinner-border").hide();
            $(".signin-note").show();
            $('.btn-custom').prop('disabled', false);

            let errorMsg = jqXHR.responseJSON?.message || "Something went wrong. Please try again.";
            $("#message").text(errorMsg);
            console.error("AJAX Error:", {status: jqXHR.status, statusText: textStatus, errorThrown, response: jqXHR.responseText});
        }
    });
});
