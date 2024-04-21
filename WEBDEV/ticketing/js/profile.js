$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('userUpdate') === 'success') {
        $('#profileUpdateModal').modal('show');
        removeQueryParams();
    } else if (urlParams.get('resetPass') === 'success') {
        $('#passwordUpdateModal').modal('show');
        removeQueryParams();
    }

    function removeQueryParams() {
        var urlWithoutParams = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({ path: urlWithoutParams }, '', urlWithoutParams);
    }
});

$(document).ready(function() {
    $("#new_user-email").keyup(function() {
        var email = $(this).val();
        $.post("./jQuery/check_email.php", { email: email }, function(response) {
            if (response.trim() === "true") {
                $("#new_emailStatus").css("display", "block");
            } else {
                $("#new_emailStatus").css("display", "none");
            }
        });
    });

    $("#new_user-username").keyup(function() {
        var username = $(this).val();
        $.post("./jQuery/check_username.php", { username: username }, function(response) {
            if (response.trim() === "true") {
                $("#new_usernameStatus").css("display", "block");
            } else {
                $("#new_usernameStatus").css("display", "none");
            }
        });
    });

    $("#userUpdate").click(function(event) {
        if (!canSubmitForm()) {
            event.preventDefault();
            alert("Please fix the errors before submitting the user form.");
        }
    });

    function canSubmitForm() {
        var emailErrorVisible = $("#new_emailStatus").is(":visible");
        var usernameErrorVisible = $("#new_usernameStatus").is(":visible");
        return !emailErrorVisible && !usernameErrorVisible;
    }
    
    function checkPasswordMatch() {
        var password = $("#new_pass").val();
        var confirmPassword = $("#confirm_pass").val();
        var status = $("#new_passStatus");

        console.log("Password:", password);
        console.log("Confirm Password:", confirmPassword);

        if (password !== confirmPassword) {
            status.css("display", "block");
            console.log("Passwords do not match!");
            return false; // Prevent form submission
        } else {
            status.css("display", "none");
            console.log("Passwords match.");
            return true; // Allow form submission
        }
    }

    $("#passwordForm").on("submit", function() {
        return checkPasswordMatch();
    });
});