document.addEventListener("DOMContentLoaded", () => {
  const contenedorCards = document.querySelector("#contenedorCards");

  contenedorCards.addEventListener("click", (e) => {
    const btn = e.target.closest(".btnAgregarAlCarrito");
    if (btn !== null) {
      datosModal(btn);
    }
  });
});

function datosModal(btn) {
  const id = btn.dataset.id;
  const precio = btn.dataset.precio;

  const nombre = btn.dataset.nombre;
  const stock = btn.dataset.stock;

  const idModal = document.querySelector("#idVariante");
  const precioModal = document.querySelector("#modalCarritoPrecio");
  const nombreModal = document.querySelector("#modalProductoTitulo");
  const inputCantidad = document.querySelector("#cantidad");

  idModal.value = id;
  precioModal.textContent = precio;
  nombreModal.textContent = nombre;
  inputCantidad.value = 1;
  inputCantidad.max = stock;
}
