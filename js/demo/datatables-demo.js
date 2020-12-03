// Call the dataTables jQuery plugin
$(document).ready(function () {

  $('#dataTable').DataTable({
    "destroy": true,
    "language": {
      "url": "https://cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "buttons": [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });

});
// Call the dataTables jQuery plugin