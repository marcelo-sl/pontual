$(document).ready(function() {
  
  $('#companyForm').validate({
    rules: {
      "company[company_name]": "required",
      "company[cnpj]": {
        required: true,
        maxlength: 14
      },
      "company[trade_name]": "required",      
      "localization[cep]": {
        required: true,
        maxlength: 8
      },
      "localization[address]": {
        required: true,
      },
      "localization[house_number]": {
        required: true,
      },
      "localization[district]": {
        required: true,
      },
      "localization[state_id]": {
        required: true,
      },
      "localization[city_id]": {
        required: true,
      },
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
  });

});

