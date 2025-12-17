document.addEventListener("DOMContentLoaded", () => {
  let tablaProductos = document.querySelector("#tablaProductos");
  tablaProductos.addEventListener("click", (e) => {
    if (e.target.classList.contains("btnAsignarInsumo")) {
      const id = e.target.getAttribute("data-id");
      modalAsignarInsumo(id);
    }
  });
});

async function modalAsignarInsumo(id) {
  try {
    const idInput = document.querySelector('#idProductoModalAsignarInsumo');
    idInput.value=id;
    console.log(id)
  } catch (error) {
    console.log(error);
  }
}
