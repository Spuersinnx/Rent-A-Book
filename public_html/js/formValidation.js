/**
 * Created by may on 3/10/17.
 */

var errors = 0;

$(document).ready(function() {

    validateForm();

});

function validateForm() {

    //first name validation
    $('#newFirstName').on('input',function() {
        var firstName = $('#newFirstName').val();
        if (firstName == "" || firstName.length < 2) {
            $('#errFirstNInfo').removeClass('valid').addClass('invalid');
            errors++;

        }
        else {
            $('#errFirstNInfo').removeClass('invalid').addClass('valid');
        }

    }).focus(function () {
        $('#errFirstN').show();
    }).blur(function () {
        $('#errFirstN').hide();
    });

    //last name validation
    $('#newLastName').on('input',function() {
        var lastName = $('#newLastName').val();
        if (lastName == "" || lastName.length < 2) {
            $('#errLastNInfo').removeClass('valid').addClass('invalid');
            errors++;

        }
        else {
            $('#errLastNInfo').removeClass('invalid').addClass('valid');
        }

    }).focus(function () {
        $('#errLastN').show();
    }).blur(function () {
        $('#errLastN').hide();
    });


    //password validation
    $('#confirmPsw').keyup(function() {
        var password=$('#newPsw').val();
        var confirmPassword = $('#confirmPsw').val();

        //validate confirmed password matches initial password
        if(confirmPassword == password) {
            $('#match').removeClass('invalid').addClass('valid');
        }
        else {
            $('#match').removeClass('valid').addClass('invalid');
            errors++;

        }

    }).focus(function () {
        $('#confirmPswdDiv').show();
    }).blur(function () {
        $('#confirmPswdDiv').hide();
    });

    //email validation
    $('#newEmail').keyup(function() {
        var email=$('#newEmail').val();
        var emailRegex = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i

        //validate email matches regex
        if(email.match(emailRegex)) {
            $('#errorEmail').removeClass('invalid').addClass('valid');
        }
        else {
            $('#errorEmail').removeClass('valid').addClass('invalid');
            errors++;

        }

    }).focus(function () {
        $('#errorEmailDiv').show();
    }).blur(function () {
        $('#errorEmailDiv').hide();
    });

    strengthPassword();
    
    
}

function strengthPassword() {

    $('#newPsw').keyup(function () {
        var password = $(this).val();
        if (password.length < 8) {
            $('#length').removeClass('valid').addClass('invalid');
            errors++;

        } else {
            $('#length').removeClass('invalid').addClass('valid');
        }
        //validate letter
        if (password.match(/[A-z]/)) {
            $('#letter').removeClass('invalid').addClass('valid');
        } else {
            $('#letter').removeClass('valid').addClass('invalid');
            errors++;


        }

        //validate capital letter
        if (password.match(/[A-Z]/)) {
            $('#capital').removeClass('invalid').addClass('valid');
        } else {
            $('#capital').removeClass('valid').addClass('invalid');
            errors++;

        }

        //validate number
        if (password.match(/\d/)) {
            $('#number').removeClass('invalid').addClass('valid');
        } else {
            $('#number').removeClass('valid').addClass('invalid');
            errors++;

        }

    }).focus(function () {
        $('#pswdInfo').show();
    }).blur(function () {
        $('#pswdInfo').hide();
    });

}












