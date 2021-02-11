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
  });

});

