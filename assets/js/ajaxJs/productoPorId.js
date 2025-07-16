document.addEventListener("DOMContentLoaded", () => {
  const btnEditar = document.querySelectorAll(".btnEditarProducto");
  btnEditar.forEach((boton) => {
    boton.addEventListener("click", () => {
      const id = boton.getAttribute("data-id");
      formEditarProducto(id);
    });
  });
});

async function formEditarProducto(id) {
  try {
    const response = await fetch(
      "../../functions/ajaxPhp/productoPorId.php",
      {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({ idProducto: id }),
      }
    );
    if (!response.ok) {
      throw new Error(response.error);
    }
    const producto = await response.json();
    document.querySelector("#editarIdProducto").value = producto.idProducto;
    document.querySelector("#editarNombreProducto").value = producto.nombre;
    document.querySelector("#editarDescripcionProducto").value = producto.descripcion;
    document.querySelector("#editarStockProducto").value = producto.stock;
    document.querySelector("#editarPrecioProducto").value = producto.precio;
    document.querySelector("#editarIdProvedor").value = producto.idProvedor;
    document.querySelector("#editarIdTipoProducto").value = producto.idTipoProducto;
    
  } catch (error) {
    console.log(error);
  }
}
