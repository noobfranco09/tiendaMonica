document.addEventListener("DOMContentLoaded", () => {
  let tablaProductos = document.querySelector("#tablaProductos");
  tablaProductos.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnAsignarInsumo")) {
      id = e.target.dataset.id;
      document.querySelector('#idProductoModalAsignarInsumo').value=id;
    }
  });
});

