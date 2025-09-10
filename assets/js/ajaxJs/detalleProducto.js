document.addEventListener("DOMContentLoaded", () => {
  const btnEditar = document.querySelector(".btnMostrarDetalle");
  btnEditar.addEventListener("click", () => {
    const id = btnEditar.getAttribute("data-id");
    modalDetalleProducto(id);
  });
});

async function modalDetalleProducto(id) {
  try {
    const response = await fetch(
      "../../../tiendaMonica/functions/ajaxPhp/ajaxTraerInsumosProducto/traerInsumos.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idProducto: id }),
      }
    );
    if (!response.ok) {
      throw new Error(response.error);
    }
    let detalleProducto = await response.json();
    console.log(detalleProducto)
    const modal = document.querySelector("#modalDetalleProducto");
    detalleProducto.forEach((detalle) => {
      modal.appendChild(document.createTextNode(`${detalle.nombre}`));
    });
  } catch (error) {
    console.log(error);
  }
}
