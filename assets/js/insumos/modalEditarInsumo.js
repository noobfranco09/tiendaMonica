document.addEventListener("DOMContentLoaded", () => {
  let tablaInsumos = document.querySelector("#tablaInsumos");
  tablaInsumos.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnEditarInsumo")) {
      id = e.target.dataset.id;
      modalEditarInsumos(id);
    }
  });
});

async function modalEditarInsumos(id) {
  try {
    const respuesta = await fetch(
      "/tiendaMonica/functions/ajaxPhp/ajaxInsumos/traerInsumosPorId.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idInsumo: id }),
      }
    );
    if (!respuesta.ok) {
      throw new Error(response.error);
    }
 
    const categoria = await respuesta.json();
    console.log(categoria)
    document.querySelector("#editarIdInsumo").value = categoria[0].idInsumo;
    document.querySelector("#editarNombreInsumo").value = categoria[0].nombre;
    document.querySelector("#editarDescripcionInsumo").value =categoria[0].descripcion;
    document.querySelector("#editarCantidadInsumo").value =categoria[0].cantidad;
  } catch (error) {
    console.log(error + " error en el fetch de las categorías");
  }
}
