$(document).ready(function() {
  
  $('#userForm').validate({
    rules: {
      name: "required",
      gender: "required",
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
        equalTo: "#inputConfirmPassword"
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
    }
  });

});