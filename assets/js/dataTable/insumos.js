
// if ($.fn.dataTable.isDataTable("#tablaProductos")) {
//   $("#tablaProductos").DataTable().destroy();
// }// en caso de que algún ajax cause problemas

new DataTable("#tablaInsumos", {
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
    { responsivePriority: 1, targets: 0 }, 
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
