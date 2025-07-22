document.addEventListener("DOMContentLoaded", () => {
  let tablaCategoria = document.querySelector("#tablaCategorias");
  tablaCategoria.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnEditarCategoria")) {
      id = e.target.dataset.id;
      modalEditarProvedores(id);
    }
  });
});

async function modalEditarProvedores(id) {
  try {
    const respuesta = await fetch(
      "/tiendaMonica/functions/ajaxPhp/ajaxCategorias/categoriaPorId.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idCategoria: id }),
      }
    );
    if (!respuesta.ok) {
      throw new Error(response.error);
    }
 
    const categoria = await respuesta.json();
    
    document.querySelector("#editarIdCategoria").value = categoria[0].idCategoria;
    document.querySelector("#editarNombreCategoria").value = categoria[0].nombre;
    document.querySelector("#editarDescricionCategoria").value =
      categoria[0].descripcion;
  } catch (error) {
    console.log(error + " error en el fetch de las categorías");
  }
}
