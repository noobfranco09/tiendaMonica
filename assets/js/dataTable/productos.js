// if ($.fn.dataTable.isDataTable("#tablaProductos")) {
//   $("#tablaProductos").DataTable().destroy();
// }// en caso de que algún ajax cause problemas

new DataTable("#tablaProductos", {
  responsive: {
    details: {
      type: "column",
      target: "tr",
    },
  },
  columnDefs: [
    {
      className: "dt-control",
      orderable: false,
      targets: 0,
    },
    { responsivePriority: 1, targets: 0 }, // id siempre visible
    { responsivePriority: 2, targets: 1 },
    { responsivePriority: 3, targets: -1 }, // última columna (acciones) siempre visible
    { responsivePriority: 4, targets: -2 }, // penúltima columna
    { responsivePriority: 5, targets: -3 }
  ],
  language: {
    search: "Buscar",
    lengthMenu: "_MENU_ registros",
    info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
    infoEmpty: "Mostrando 0 a 0 de 0 registros",
    infoFiltered: "(filtrado de _MAX_ registros totales)",
    zeroRecords: "No se encontraron resultados",
    emptyTable: "No hay datos disponibles en la tabla",
  },
});
