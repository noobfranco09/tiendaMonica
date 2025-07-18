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

async function modalEditarProvedores(id) 
{
    
}
