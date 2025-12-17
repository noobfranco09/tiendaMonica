document.addEventListener("click", function (e) {
    if (!e.target.closest(".btn-ver-pedido")) return;

    const btn = e.target.closest(".btn-ver-pedido");

    // Datos simples
    document.getElementById("modalPedidoId").textContent = btn.dataset.id;
    document.getElementById("modalCliente").textContent = btn.dataset.cliente;
    document.getElementById("modalFecha").textContent = btn.dataset.fecha;
    document.getElementById("modalTotal").textContent = btn.dataset.total;

    // Variantes
    const variantes = JSON.parse(btn.dataset.variantes);
    const tbody = document.getElementById("modalVariantesBody");
    tbody.innerHTML = "";

    variantes.forEach(v => {
        tbody.innerHTML += `
            <tr>
                <td>${v.idVariante}</td>
                <td>${v.producto}</td>
                <td>${v.talla}</td>
                <td>${v.color}</td>
                <td>${v.cantidad}</td>
                <td>$${parseFloat(v.subtotal).toFixed(2)}</td>
            </tr>
        `;
    });
});
