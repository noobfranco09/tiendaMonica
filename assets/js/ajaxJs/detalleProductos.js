document.addEventListener("DOMContentLoaded", () => {
  let tablaProductos = document.querySelector("#tablaProductos");
  tablaProductos.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnAsignarInsumo")) {
      id = e.target.dataset.id;
      modalAsignarInsumos(id);
    }
  });
});

async function modalAsignarInsumos(id) {
  try {
    const respuesta = await fetch(
      "/tiendaMonica/functions/ajaxPhp/ajaxTraerInsumosProducto/traerInsumos.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idProducto: id }),
      }
    );
    if (!respuesta.ok) {
      throw new Error(response.error);
    }
    console.log("here");
    const insumos = await respuesta.json();
  } catch (error) {
    console.log(error + " error en el fetch de las categorías");
  }
}
