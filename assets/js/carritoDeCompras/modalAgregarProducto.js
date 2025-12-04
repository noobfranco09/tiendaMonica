
document.addEventListener("DOMContentLoaded", () => {
  const contenedorCards = document.querySelector("#contenedorCards");

  contenedorCards.addEventListener("click", (e) => {
    const btn = e.target.closest(".btnAgregarAlCarrito");
    if (btn) cargarModal(btn.dataset.producto);
  });
});

async function cargarModal(idProducto) {
  const response = await fetch(
    `/tiendaMonica/controller/usuario/getVariantes.php?idProducto=${idProducto}`
  );

  const data = await response.json();

  // --- Info producto ---
  document.querySelector("#modalProductoTitulo").textContent =
    data.producto.nombre;

  // Precio base (puedes usar el primero)
  document.querySelector("#modalCarritoPrecio").textContent =
    data.variantes[0].precio;

  // --- Limpiar selects previos ---
  const contColores = document.querySelector("#contenedorColores");
  contColores.innerHTML = "";

  const contTallas = document.querySelector("#contenedorTallas");
  contTallas.innerHTML = "";

  document.querySelector("#idVariante").value = "";
  document.querySelector("#cantidad").value = 1;

  // --- Crear botones de color ---
  data.colores.forEach((color) => {
    const btn = document.createElement("button");
    btn.className = "btn btn-outline-primary btn-sm";
    btn.textContent = color.nombre;
    btn.dataset.colorId = color.idColor;

    btn.onclick = () => seleccionarColor(color.idColor, data);

    contColores.appendChild(btn);
  });
}

// ---------------------------------------------
// Seleccionar Color → cargar tallas válidas
// ---------------------------------------------
function seleccionarColor(idColor, data) {
  const contTallas = document.querySelector("#contenedorTallas");
  contTallas.innerHTML = "";

  // Filtrar por color
  const variantesColor = data.variantes.filter(
    (v) => v.idColor == idColor
  );

  // Tallas sin repetir
  const tallasUnicas = [];
  variantesColor.forEach((v) => {
    if (!tallasUnicas.find((t) => t.idTalla == v.idTalla)) tallasUnicas.push(v);
  });

  tallasUnicas.forEach((v) => {
    const btn = document.createElement("button");
    btn.className = "btn btn-outline-dark btn-sm";
    btn.textContent = v.talla;

    btn.onclick = () => seleccionarVariante(idColor, v.idTalla, data);

    contTallas.appendChild(btn);
  });

  document.querySelector("#idVariante").value = "";
}

// ---------------------------------------------
// Seleccionar talla → elegir variante válida
// ---------------------------------------------
function seleccionarVariante(idColor, idTalla, data) {
  const variante = data.variantes.find(
    (v) => v.idColor == idColor && v.idTalla == idTalla
  );

  if (!variante) return; // seguridad

  // Setear datos
  document.querySelector("#modalCarritoPrecio").textContent = variante.precio;
  document.querySelector("#cantidad").max = variante.stock;
  document.querySelector("#idVariante").value = variante.idVariante;
}
