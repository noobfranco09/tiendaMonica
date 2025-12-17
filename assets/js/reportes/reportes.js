document.addEventListener("DOMContentLoaded", () => {
  document.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-ventasMes")) {
      ventasMes("ventas");
    }
    if (e.target.classList.contains("btn-masVendido")) {
      masVendido("productos");
    }
    if (e.target.classList.contains("btn-comprasVentas")) {
      ventasCompras("comparativa");
    }
  });
});

let chartActual = null;
async function ajax(tipo) {
  const respuesta = await fetch(
    `${window.APP_URL}functions/ajaxPhp/reportes/reportes.php`,
    {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ tipo: tipo }),
    }
  );
  if (!respuesta.ok) {
    throw new Error("Error en la petición");
  }
  //   console.log(await respuesta.text());
  const data = await respuesta.json();
  return await data;
}

function formatearMeses(meses) {
  console.log(meses);
  const nombres = [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre",
  ];

  return meses.map((m) => {
    const [year, month] = m.split("-");
    return `${nombres[parseInt(month) - 1]} ${year}`;
  });
}

async function ventasMes(tipo) {
  try {
    const ctx = document.getElementById("grafico").getContext("2d");
    let data = await ajax(tipo);
    if (data.error) {
      alert(data.error);
      return;
    }

    if (chartActual) chartActual.destroy(); // limpiar gráfico anterior
    chartActual = new Chart(ctx, {
      type: "line",
      data: {
        labels: formatearMeses(data.meses),
        datasets: [
          {
            label: "Ventas por mes",
            data: data.totales,
            borderWidth: 2,
          },
        ],
      },
    });
  } catch (error) {
    console.log(error);
  }
}

async function masVendido(tipo) {
  try {
    let data = await ajax(tipo);
    if (data.error) {
      alert(data.error);
      return;
    }

    const ctx = document.getElementById("grafico").getContext("2d");

    if (chartActual) chartActual.destroy(); // limpiar gráfico anterior
    chartActual = new Chart(ctx, {
      type: "bar",
      data: {
        labels: data.productos,
        datasets: [
          {
            label: "Cantidad vendida",
            data: data.cantidades,
            borderWidth: 2,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: (v) => v.toLocaleString(),
            },
          },
        },
      },
    });
  } catch (error) {
    console.log(error);
  }
}

async function ventasCompras(tipo) {
  try {
    let data = await ajax(tipo);
    if (data.error) {
      alert(data.error);
      return;
    }

    const ctx = document.getElementById("grafico").getContext("2d");

    if (chartActual) chartActual.destroy(); // limpiar gráfico anterior
    chartActual = new Chart(ctx, {
      type: "bar",
      data: {
        labels: formatearMeses(data.meses),
        datasets: [
          {
            label: "Compras",
            data: data.compras,
            borderWidth: 2,
          },
          {
            label: "Ventas",
            data: data.ventas,
            borderWidth: 2,
          },
        ],
      },
    });
  } catch (error) {
    console.log(error);
  }
}
