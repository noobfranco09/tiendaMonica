document.addEventListener("DOMContentLoaded", () => {
  const btnEditar = document.querySelectorAll(".btnEditarProducto");
  btnEditar.forEach((boton) => {
    boton.addEventListener("click", () => {
      const id = boton.getAttribute("data-id");
      formEditarProducto(id);
      console.log(id)
    });
  });
});

async function formEditarProducto(id) {
  try {
    const response = await fetch(
      "../../../tiendaMonica/functions/ajaxPhp/productoPorId.php",
      {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ idProducto: id }),
      }
    );
    if (!response.ok) {
      throw new Error(response.error);
    }
    let producto = await response.json();

    producto = producto[0];
    document.querySelector("#editarIdProducto").value = producto.idProducto;
    document.querySelector("#editarNombreProducto").value = producto.nombre;
    document.querySelector("#editarDescripcionProducto").value =
      producto.descripcion;
    document.querySelector("#editarStockProducto").value = producto.stock;
    document.querySelector("#editarPrecioProducto").value = producto.precio;

    const responseTipoProducto = await fetch(
      "../../../tiendaMonica/functions/ajaxPhp/traerCategorias.php"
    );
    if (!responseTipoProducto.ok) {
      throw new Error(
        `Error en la solicitud: ${response.status} - ${response.statusText}`
      );
    }
    const categoria = await responseTipoProducto.json();

    const idTipoProducto = document.querySelector("#editarIdTipoProducto");
    categoria.forEach((categoria) => {
      if (categoria.idTipoProducto === producto.idTipoProducto) {
        console.log(categoria.idTipoProducto)
        let option = document.createElement("option");
        option.setAttribute("value", `${categoria.idTipoProducto}`);
        option.setAttribute("selected", "selected");
        option.appendChild(document.createTextNode(`${categoria.nombre}`));
        idTipoProducto.appendChild(option);
      } else {
        let option = document.createElement("option");
        option.setAttribute("value", `${categoria.idTipoProducto}`);
        option.appendChild(document.createTextNode(`${categoria.nombre}`));
        idTipoProducto.appendChild(option);
      }
    });

    const idProvedor = document.querySelector("#editarIdProvedor");
    const responseProvedor = await fetch("../../../tiendaMonica/functions/ajaxPhp/ajaxProvedores/traerProvedores.php");
    const provedores = await responseProvedor.json();

    provedores.forEach((provedor) => {
      if (provedor.idProvedor === producto.idProvedor) {
        console.log(provedor.idProvedor+"ddsdsfdsdfsfdsfds")
        let option = document.createElement("option");
        option.setAttribute("value", `${provedor.idProvedor}`);
        option.setAttribute("selected", "selected");
        option.appendChild(document.createTextNode(`${provedor.nombre}`));
        idProvedor.appendChild(option);
      } else {
        console.log(provedor.idProvedor+"ddsdsfdsdfsfdsfds")
        let option = document.createElement("option");
        option.setAttribute("value", `${provedor.idProvedor}`);
        option.appendChild(document.createTextNode(`${provedor.nombre}`));
        idProvedor.appendChild(option);
      }
    });
  } catch (error) {
    console.log(error);
  }
}
