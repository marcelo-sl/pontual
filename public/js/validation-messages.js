jQuery.extend(jQuery.validator.messages, {
  required: "Campo obrigatório.",
  remote: "Please fix this field.",
  email: "Insira um e-mail válido.",
  url: "URL Inválida.",
  date: "Insira uma data válida.",
  dateISO: "Insira uma data válida (ISO).",
  number: "Insira um número válido.",
  digits: "Insira apenas dígitos.",
  creditcard: "Insira um cartão de crédito válido.",
  equalTo: "Insira o mesmo valor novamente.",
  accept: "Please enter a value with a valid extension.",
  maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
  minlength: jQuery.validator.format("Please enter at least {0} characters."),
  rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
  range: jQuery.validator.format("Insira um valor entre {0} e {1}."),
  max: jQuery.validator.format("Insira com um valor menor ou igual a {0}."),
  min: jQuery.validator.format("Insira com um valor maior ou igual a {0}.")
});