$(document).ready( function () {
    var table = $('#datatable').DataTable({
        "language": {
          "sEmptyTable": "Nenhum registro encontrado",
          "sInfo": "Exibindo de _START_ até _END_ de _TOTAL_ registros",
          "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
          "sInfoFiltered": "(Filtrados de _MAX_ registros)",
          "sInfoPostFix": "",
          "sInfoThousands": ".",
          "sLengthMenu": "Resultados por página: _MENU_ ",
          "sLoadingRecords": "Carregando...",
          "sProcessing": "Processando...",
          "sZeroRecords": "Nenhum registro encontrado",
          "sSearch": "Pesquisar",
          "oPaginate": {
              "sNext": "Próximo",
              "sPrevious": "Anterior",
              "sFirst": "Primeiro",
              "sLast": "Último"
          },
          "oAria": {
              "sSortAscending": ": Ordenar colunas de forma ascendente",
              "sSortDescending": ": Ordenar colunas de forma descendente"
          },
          "select": {
              "rows": {
                  "_": "Selecionado %d linhas",
                  "0": "Nenhuma linha selecionada",
                  "1": "Selecionado 1 linha"
              }
          }
        },
        "respnsive": "true",
        "dom": "Bfrtilp",
        "buttons": [
            {
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel"></i>',
                titleAttr: 'Exportar em Excel',
                className: 'btn btn-success mr-2'
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fas fa-file-pdf"></i>',
                titleAttr: 'Exportar em PDF',
                className: 'btn btn-danger mr-2'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i>',
                titleAttr: 'Imprimir',
                className: 'btn btn-dark'
            },
        ],
        // "bFilter": false,
        "bInfo": false,
        "bPaginate": false
      });

    // Event listener to the two range filtering inputs to redraw on input
    $('#status').change( function() {
        table.draw();
    });

    $('#client, #clientCPF').keyup( function() {
        table.draw();
    });

    $('#datatable_filter').hide();
  });

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function( settings, data, dataIndex ) {
        let client = $('#client').val();
        let clientCPF = $('#clientCPF').val();
        let status;
        
        switch($('#status').val()) {
            case "1":
                status = "Agendado";
                break;
            case "2":
                status = "Aguardando lançamento";
                break;
            case "3":
                status = "Realizado";
                break;
            case "4":
                status = "Cancelado";
                break;
            case "5":
                status = "Cliente ausente";
                break;
            default:
                status = "";
                break;
        }
 
        if ( data[2].toLowerCase().includes(status.toLowerCase()) &&
             data[3].toLowerCase().includes(client.toLowerCase()) &&             
             data[4].includes(clientCPF))
        {
            return true;
        }
        return false;
    }
);