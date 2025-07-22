document.addEventListener("DOMContentLoaded", () => {
  let tablaProvedor = document.querySelector("#tablaProvedores");
  tablaProvedor.addEventListener("click", (e) => {
    let id = "";
    if (e.target && e.target.classList.contains("btnAsignarCategoria")) {
      id = e.target.dataset.id;
      modalAsignarCategoria(id);
    } 
  });
});

 function modalAsignarCategoria(id) 
{
    document.querySelector('#idAsignarCategoria').value=id;
}
