$(document).ready(function() {
    var readURL = function(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(".profile-pic").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".file-upload").on("change", function(){
        readURL(this);
    });
    
    $(".upload-button").on("click", function() {
       $(".file-upload").click();
    });

    $("#password_view").on("click", function() {
        let type = $(this).parents(".input-group").children("input[name='new_password'].hide").attr('type');
        if (type == 'text') {
            let value = $(this).parents(".input-group").children("input[type='password']").val();
            $(this).parents(".input-group").children("input[type='password']").addClass('hide');
            $(this).parents(".input-group").children("input[type='text']").removeClass('hide').val(value);
            $(this).children("i").removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            let value = $(this).parents(".input-group").children("input[type='text']").val();
            $(this).parents(".input-group").children("input[type='password']").removeClass('hide').val(value);
            $(this).parents(".input-group").children("input[type='text']").addClass('hide');
            $(this).children("i").removeClass("fa-eye-slash").addClass("fa-eye")
        }
    })
});