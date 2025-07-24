document.addEventListener("DOMContentLoaded", () => {
  let tablaProvedor = document.querySelector("#tablaProvedores");
  tablaProvedor.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnEditarProvedor")) {
      id = e.target.dataset.id;
      modalEditarProvedores(id);
    }
  });
});

async function modalEditarProvedores(id) {
  try {
    const respuesta = await fetch(
      "/tiendaMonica/functions/ajaxPhp/ajaxProvedores/traerProvedoresPorId.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idProvedor: id }),
      }
    );
    if (!respuesta.ok) {
      throw new Error(response.error);
    }

    const provedor = await respuesta.json();

    document.querySelector("#editarIdProvedor").value =
      provedor[0].idProvedor;
    document.querySelector("#editarNombreProvedor").value =
      provedor[0].nombre;
    document.querySelector("#editarContactoProvedor").value =
      provedor[0].contacto;
  } catch (error) {
    console.log(error + " error en el fetch de los provedores");
  }
}
