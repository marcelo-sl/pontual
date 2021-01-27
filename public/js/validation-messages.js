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
  maxlength: jQuery.validator.format("Insira um valor menor ou igual a {0} caracteres."),
  minlength: jQuery.validator.format("Insira um valor maior ou igual a {0} caracteres."),
  rangelength: jQuery.validator.format("Insira um valor entre {0} e {1} caracteres."),
  range: jQuery.validator.format("Insira um valor entre {0} e {1}."),
  max: jQuery.validator.format("Insira um valor menor ou igual a {0}."),
  min: jQuery.validator.format("Insira um valor maior ou igual a {0}.")
});