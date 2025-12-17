document.addEventListener("DOMContentLoaded", () => {
  const tablaProductos = document.querySelector("#tablaProductos");

  tablaProductos.addEventListener("click", (e) => {
    const btn = e.target.closest(".btnEditarProducto");
    if (!btn) return;

    const idProducto = btn.dataset.id;
    cargarDatosProducto(idProducto);
  });
});

async function cargarDatosProducto(idProducto) {
  try {
    const response = await fetch(
      `${window.APP_URL}functions/ajaxPhp/editarProducto.php`,
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idProducto }),
      }
    );

    if (!response.ok) throw new Error("Error en la petición");

    const producto = await response.json();

    // Llenar campos del modal
    document.querySelector("#editarIdProducto").value = producto.idProducto;
    document.querySelector("#editarNombreProducto").value = producto.nombre;
    document.querySelector("#editarDescripcionProducto").value = producto.descripcion;

    const selectCategoria = document.querySelector("#editarIdTipoProducto");
    selectCategoria.innerHTML = "";

    producto.categorias.forEach(cat => {
      const option = document.createElement("option");
      option.value = cat.idTipoProducto;
      option.textContent = cat.nombreTipo;
      if (cat.idTipoProducto == producto.idTipoProducto) {
        option.selected = true;
      }
      selectCategoria.appendChild(option);
    });


  } catch (error) {
    console.error(error);
  }
}
