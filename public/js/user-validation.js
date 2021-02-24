$(document).ready(function() {
  
  $('#userForm').validate({
    rules: {
      name: "required",
      gender: "required",
      cpf: {
        required: true,
        maxlength: 14,
        verificaCPF: true,
      },
      contact: "required",
      birthday: "required",
      email: {
        required: true,
        email: true,
      },
      password: {
        required: true,
        minlength: 6
      },
      password_confirmation: {
        required: true,
        equalTo: "#inputPassword"
      }
    },
    messages: {
      email: {
        email: "Insira um e-mail válido",
      },
      password: {
        minlength: "A senha deve conter no mínimo {0} caracteres"
      },
      password_confirmation: {
        equalTo: "As senhas não conferem"
      }
    },

    errorPlacement: function (error, element) {
      if (element.is(':radio') || element.is(':checkbox')) {       
        error.appendTo(element.parents('div.form-group').first());
      } else{
        error.insertAfter(element).parents('.collapse').collapse('show');
      }
    },

    highlight: function(element, errorClass, validClass){ 
      $(element).parents('.form-group').addClass('has-error');
    },

    unhighlight: function(element, errorClass, validClass) {
      if ($.trim(element.value)) {
        $(element).parents('.form-group').removeClass('has-error');
      }
    }
  });

  $('.sp_celphones').rules("add", {
    required: true,
    celular: true
  });

});

