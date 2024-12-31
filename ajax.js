function peticionAjax(metodo, recurso, datos) {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            respuestaAjax(this);
        }
    };
    ajax.open(metodo, recurso, true);
    ajax.send(); 
    console.log("enviados");
}

function respuestaAjax(ajax) {
    var response = JSON.parse(ajax.responseText);
    mostrarTotal(response);
}

function mostrarTotal(data) {
    let resultados = document.getElementById('resultados');
    resultados.innerHTML = ""; //para limpiar
    let html = "";
    for (let i = 0; i < data.length; i++) {
        let producto = data[i]; 
        html += `${producto.nombre}: ${producto.cantidad} x $${producto.precio} = $${producto.total.toFixed(2)}<br>`;
        }
    resultados.innerHTML = html;
    }
