document.addEventListener("DOMContentLoaded", () => {
  let tablaProductos = document.querySelector("#tablaProductos");
  tablaProductos.addEventListener("click", (e) => {
    if (e.target.classList.contains("btnMostrarDetalle")) {
      const id = e.target.getAttribute("data-id");
      modalDetalleProducto(id);
    }
  });
});

async function modalDetalleProducto(id) {
  try {
    const response = await fetch(
      `${window.APP_URL}functions/ajaxPhp/ajaxTraerInsumosProducto/traerInsumos.php`,
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
    const tbody = document.querySelector("#tbodyDetalleProducto");
    tbody.innerHTML = "";
    detalleProducto.forEach((detalle) => {
      let row = document.createElement("tr");
      Object.values(detalle).forEach((valor) => {
        const td = document.createElement("td");
        td.appendChild(document.createTextNode(valor));
        row.appendChild(td);
      });
      tbody.appendChild(row);
    });
  } catch (error) {
    console.log(error);
  }
}
