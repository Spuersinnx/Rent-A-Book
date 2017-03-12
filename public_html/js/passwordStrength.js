/**
 * Created by may on 3/10/17.
 */

$(document).ready(function() {

    strengthPassword();
    validateForm();
});

function validateForm() {


    $('#confirmPsw').keyup(function() {
        var password=document.getElementById('newPsw').value;
        var confirmPassword = document.getElementById('confirmPsw').value;

        //validate confirmed password matches initial password
        if(confirmPassword != password) {
            $('#match').removeClass('valid').addClass('invalid');
        }
        else {
            $('#match').removeClass('invalid').addClass('valid');
        }

    });

    $('#newEmail').keyup(function() {
        var email=document.getElementById('newEmail').value;
        var emailRegex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

        //validate email matches regex
        if(email.match(emailRegex)) {
            $('#errorEmail').removeClass('invalid').addClass('valid');
        }
        else {
            $('#errorEmail').removeClass('valid').addClass('invalid');
        }

    }).focus(function () {
        $('#errorEmailDiv').show();
    }).blur(function () {
        $('#errorEmailDiv').hide();
    });


}

function strengthPassword() {

    $('input[type=password]').keyup(function () {
        var password = $(this).val();
        if (password.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }
        //validate letter
        if (password.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
        }

        //validate capital letter
        if (password.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
        }

        //validate number
        if (password.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
        }

    }).focus(function () {
        $('#pswdInfo').show();
    }).blur(function () {
        $('#pswdInfo').hide();
    });

}




