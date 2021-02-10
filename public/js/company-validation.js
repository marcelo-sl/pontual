$(document).ready(function() {
  
  $('#companyForm').validate({
    rules: {
      "company[company_name]": "required",
      "company[cnpj]": {
        required: true,
        maxlength: 18
      },
      "company[trade_name]": "required",      
      "localization[cep]": {
        required: true,
        maxlength: 9
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
      "hours[range_hour]": "required",
      "hours[start_break]": {
        required: "#hasBreakTime:checked",
      },
      "hours[end_break]": {
        required: "#hasBreakTime:checked",
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
      },
    },
  });

});

