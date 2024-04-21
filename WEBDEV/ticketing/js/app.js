var offcanvasElement = document.getElementById('offcanvas')
var offcanvas = new bootstrap.Offcanvas(offcanvasElement)

var myModal = new bootstrap.Modal(document.getElementById('loginModal'), {
keyboard: false
});

document.getElementById('loginButton').addEventListener('click', function() {
var offcanvasElement = document.getElementById('offcanvas');
var offcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
offcanvas.hide();
});

$(document).ready(function() {
    // User Form
    $("#user-email").keyup(function() {
        var email = $(this).val();
        $.post("./jQuery/check_email.php", { email: email }, function(response) {
            if (response.trim() === "true") {
                $("#emailStatus").css("display", "block");
            } else {
                $("#emailStatus").css("display", "none");
            }
        });
    });

    $("#user-username").keyup(function() {
        var username = $(this).val();
        $.post("./jQuery/check_username.php", { username: username }, function(response) {
            if (response.trim() === "true") {
                $("#usernameStatus").css("display", "block");
            } else {
                $("#usernameStatus").css("display", "none");
            }
        });
    });

    $("#user-password, #user-confirmpassword").keyup(checkPasswordMatch);

    $("#signUp-user").click(function(event) {
        if (!canSubmitUserForm()) {
            event.preventDefault();
            alert("Please fix the errors before submitting the user form.");
        }
    });

    // Organizer Form
    $("#organizer-email").keyup(function() {
        var email = $(this).val();
        $.post("./jQuery/check_email.php", { email: email }, function(response) {
            if (response.trim() === "true") {
                $("#organizerEmailStatus").css("display", "block");
            } else {
                $("#organizerEmailStatus").css("display", "none");
            }
        });
    });

    $("#organizer-username").keyup(function() {
        var username = $(this).val();
        $.post("./jQuery/check_username.php", { username: username }, function(response) {
            if (response.trim() === "true") {
                $("#organizerUsernameStatus").css("display", "block");
            } else {
                $("#organizerUsernameStatus").css("display", "none");
            }
        });
    });

    $("#organizer-password, #organizer-confirmpassword").keyup(checkOrganizerPasswordMatch);

    $("#signUp-organizer").click(function(event) {
        if (!canSubmitOrganizerForm()) {
            event.preventDefault();
            alert("Please fix the errors before submitting the organizer form.");
        }
    });
});

function canSubmitUserForm() {
    var emailErrorVisible = $("#emailStatus").is(":visible");
    var usernameErrorVisible = $("#usernameStatus").is(":visible");
    var passErrorVisible = $("#passStatus").is(":visible");
    return !emailErrorVisible && !usernameErrorVisible && !passErrorVisible;
}

function canSubmitOrganizerForm() {
    var emailErrorVisible = $("#organizerEmailStatus").is(":visible");
    var usernameErrorVisible = $("#organizerUsernameStatus").is(":visible");
    var passErrorVisible = $("#organizerPassStatus").is(":visible");
    return !emailErrorVisible && !usernameErrorVisible && !passErrorVisible;
}

function checkPasswordMatch() {
    var password = $("#user-password").val();
    var confirmPassword = $("#user-confirmpassword").val();
    var status = $("#passStatus");

    if (password.length === 0 && confirmPassword.length === 0) {
        status.css("display", "none");
    } else {
        if (password === confirmPassword) {
            status.css("display", "none");
        } else {
            status.css("display", "block");
        }
    }
}

function checkOrganizerPasswordMatch() {
    var password = $("#organizer-password").val();
    var confirmPassword = $("#organizer-confirmpassword").val();
    var status = $("#organizerPassStatus");

    if (password.length === 0 && confirmPassword.length === 0) {
        status.css("display", "none");
    } else {
        if (password === confirmPassword) {
            status.css("display", "none");
        } else {
            status.css("display", "block");
        }
    }
}


