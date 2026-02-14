function togglePassword(fieldId, button) {
    const input = document.getElementById(fieldId);

    if (input.type === "password") {
        input.type = "text";
        button.textContent = "Hide";
    } else {
        input.type = "password";
        button.textContent = "Show";
    }
}

$(document).ready(function () {

    $('#signupForm').on('submit', function (e) {
        e.preventDefault();
        if ($(".btn-custom").prop("disabled")) return;

        const $form = $(this);
        const fullName = $('#fullName');
        const email = $('#email');
        const password = $('#password');
        const confirmPassword = $('#confirmPassword');
        const userType = $("#userType");

        let isValid = true;
        $('.form-group').removeClass('error success');
        $('.error-message').text('');

        // Validation
        if ($.trim(fullName.val()).length < 2) {
            fullName.closest('.form-group').addClass('error');
            fullName.siblings('.error-message').text('Full name must be at least 2 characters');
            isValid = false;
        } else fullName.closest('.form-group').addClass('success');

        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.val())) {
            email.closest('.form-group').addClass('error');
            email.siblings('.error-message').text('Enter a valid email address');
            isValid = false;
        } else email.closest('.form-group').addClass('success');

        if (password.val().length < 8) {
            password.closest('.form-group').addClass('error');
            password.siblings('.error-message').text('Password must be at least 8 characters');
            isValid = false;
        } else password.closest('.form-group').addClass('success');

        if (password.val() !== confirmPassword.val()) {
            confirmPassword.closest('.form-group').addClass('error');
            confirmPassword.siblings('.error-message').text('Passwords do not match');
            isValid = false;
        } else confirmPassword.closest('.form-group').addClass('success');

        if (!isValid) {
            $('html, body').animate({ scrollTop: $('.form-group.error').first().offset().top - 100 }, 600);
            return;
        }

        $(".spinner-border").removeClass("d-none");
        $(".signup-note").removeClass("d-none");
        $(".btn-custom").prop("disabled", true);

        // ✅ Include CSRF manually
        const formData = new FormData(this);
        formData.append('csrf', $('input[name="csrf"]').val());

        $.ajax({
            url: 'register-post',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                $(".spinner-border").addClass("d-none");
                $(".signup-note").addClass("d-none");
                $(".btn-custom").prop("disabled", false);

                if (data.status === "success") {
                    swal("Success", data.message, "success").then(() => {
                        window.location.href = data.redirect;
                    });
                    $form[0].reset();
                    $('.form-group').removeClass('success error');
                } else {
                    swal("Failed", data.message, "warning");
                }
            },
            error: function (xhr) {
                $(".spinner-border").addClass("d-none");
                $(".signup-note").addClass("d-none");
                $(".btn-custom").prop("disabled", false);

                let errMsg = "Something went wrong. Please try again.";
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errMsg = xhr.responseJSON.message;
                } else if (xhr.responseText) {
                    try {
                        const parsed = JSON.parse(xhr.responseText);
                        errMsg = parsed.message || errMsg;
                    } catch (e) {
                        errMsg = xhr.responseText;
                    }
                }

                swal("Error", errMsg, "error");
            }
        });
    });
});
