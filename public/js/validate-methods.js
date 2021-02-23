jQuery.validator.addMethod("verificaCPF", function(value, element) {
  value = jQuery.trim(value);
  cpf = value.replace(/[^\d]+/g,'')

  while(cpf.length < 11) cpf = "0"+ cpf;
  var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
  var a = [], b = new Number, c = 11;
  for (i=0; i<11; i++){
    a[i] = cpf.charAt(i);
    if (i < 9) b += (a[i] * --c);
  }

  ((x = b % 11) < 2) ? a[9] = 0 : a[9] = 11-x ;
  b = 0;
  c = 11;
  for (y=0; y<10; y++) b += (a[y] * c--);
  ((x = b % 11) < 2) ? a[10] = 0 : a[10] = 11-x;

  var retorno = true;
  if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;

  return this.optional(element) || retorno;
}, "CPF Inválido");

jQuery.validator.addMethod("validaDataBR", function (value, element) {
  //contando chars
  if (value.length != 10) return (this.optional(element) || false);
  // verificando data
  var data = new Date();
  var anoAtual = data.getYear();
  var mesAtual = data.getMonth() + 1;
  var diaAtual = data.getDate();
  if (anoAtual < 1000){
    anoAtual+=1900;
  }

  var data = value;
  var dia = data.substr(0, 2);
  var barra1 = data.substr(2, 1);
  var mes = data.substr(3, 2);
  var barra2 = data.substr(5, 1);
  var ano = data.substr(6, 4);
  if (data.length != 10 || barra1 != "/" || barra2 != "/" || isNaN(dia) || isNaN(mes) || isNaN(ano) || dia > 31 || mes > 12) return (this.optional(element) || false);
  if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia == 31) return (this.optional(element) || false);
  if (mes == 2 && (dia > 29 || (dia == 29 && ano % 4 != 0))) return (this.optional(element) || false);
  if (ano < 1900 || ano > anoAtual) return (this.optional(element) || false);
  if (ano >= anoAtual && mes > mesAtual) return (this.optional(element) || false);
  if ((ano >= anoAtual && dia > diaAtual) && (mes >= mesAtual && dia > diaAtual)) return (this.optional(element) || false);

  return (this.optional(element) || true);
}, "Informe uma Data Válida.");  // Mensagem padrão

jQuery.validator.addMethod("telefone", function (value, element) {
    return this.optional(element) || /\([0-9]{2}\) [0-9]{4}-[0-9]{4}/.test(value);
}, "Insira um telefone válido");

jQuery.validator.addMethod("celular", function (value, element) {
    return this.optional(element) || /\([0-9]{2}\) [0-9]{4,5}-[0-9]{4}/.test(value);
}, "Insira um celular/telefone válido ");

jQuery.validator.addMethod("letras", function(value, element) {
  return this.optional(element) || /^[a-z-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/i.test(value);
}, "Somente letras");

jQuery.validator.addMethod("minDate", function(value, element, param) {
  var minDate = new Date(dateReplace(param, '/', '-')), valueDate = new Date(dateReplace(value, '/', '-'));
  return valueDate < minDate ? false : true;
}, "Data válida somente a partir de {0}");

jQuery.validator.addMethod("regex", function(value, element, regexp) {
  var re = new RegExp(regexp);
  return this.optional(element) || re.test(value);
}, "Favor preencher o campo corretamente.");

jQuery.validator.addMethod("extension", function(value, element, param) {
  param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
  return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i"));
}, "Por favor coloque arquivo com a extensão válida.");

jQuery.validator.addMethod("multiple_extensions", function (value, element, params) {
  files = $("input[name='"+element.name+"']") //input dos arquivos
  var names = []
  params = params.split('|') //separa as extensoes obtidas por parametro em array

  for (var i = 0; i < files.get(0).files.length; ++i){
    var ext = ((files.get(0).files[i].name).toLowerCase()).split('.');
    names.push(ext[ext.length-1])// armazena as extensoes dos arquivos do input
  }

  return (this.optional(element) || verificaExtensao(names, params));
}, "Por favor, coloque arquivos com a extensão válida.");  // Mensagem padrão

jQuery.validator.addMethod("files_size", function (value, element, size) {
  files = $("input[name='"+element.name+"']") //input dos arquivos
  total = 0
  for (var i = 0; i < files.get(0).files.length; ++i){
    total += files.get(0).files[i].size; //soma o tamanho dos arquivos
  }

  return (this.optional(element) || total <= size*1024);
}, "Os arquivos não devem ultrapassar 5MB");  // Mensagem padrão

jQuery.validator.addMethod("clicked", function(value, element) {
  if($('.buscar_endereco').data('clicked')){
    return true;
  }else{
    return false;
  }
}, "Necessário realizar busca de endereço automatica.");

function dateReplace(date, from, to) {
    split = date.split(from);
    return date = split[2] + to + split[1] + to + split[0];
}

function verificaExtensao(files, exts){
 var correto
 for (let i = 0; i < files.length; i++) {
   var correto = false
   for (let j = 0; j < exts.length; j++) {
     if(exts[j] == files[i])
       correto = true
     if(j == exts.length-1 && !correto)
       return false
   }
 }
 return true
}
