$(document).ready(function() {
  
  $('#providerForm').validate({
    rules: {
      "provider[cpf]": {
        required: true,
        maxlength: 14,
        verificaCPF: true,
      },
      "provider[nickname]": "required",
      "provider[activities][]": "required",
    },
  });

});

