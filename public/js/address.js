var mainUrl = window.location.origin;

$(document).on('blur', '#inputCep', function() {
  let cep = $(this).val();

  $.ajax({
    url: 'https://viacep.com.br/ws/'+cep+'/json/',
    method: 'GET',
    dataType: 'JSON',
    success: function(data) {
      $('#inputAddress').val(data.logradouro);
      $('#inputDistrict').val(data.bairro);
      $('#inputState').val(data.uf);
      filterCitiesByUf(data.uf);

      $.get(mainUrl + "/findCityByName/" + data.uf + "/" + data.localidade, function (data) {        
        $('#inputCity').val(data);
      });
    }
  })
});

$(document).on('change', '#inputState', function() {
  let uf = $(this).val();

  filterCitiesByUf(uf);
})

function filterCitiesByUf(uf) {
  var options = "<option value='' selected>Selecione a cidade...</option>";

  if (uf !== "") {
    $.get(mainUrl + "/filterCitiesByUf/" + uf, function (data) {
      $.each(data, function (index, element) {
        options += "<option value='" + element.id + "'>" + element.city + "</option>";
      });

      let cityInput = document.getElementById("inputCity");
      cityInput.options.length = 0;  // ZERA O CAMPO DE CIDADE
      cityInput.innerHTML = options; // ADICIONA AS CIDADES DE ACORDO COM ESTADO
    });
  }
}