document.getElementById('formCostos').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(e.target);

    fetch('main.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        const resultadoDiv = document.getElementById('resultado');
        resultadoDiv.innerHTML = `
            <h3>Resultados:</h3>
            <h4>Cédula 1:</h4>
            <p>Materia Prima: $${data['Materia Prima']}</p>
            <p>Mano de Obra: $${data['Mano de Obra']}</p>
            <p>Cargos Indirectos: $${data['Cargos Indirectos']}</p>
            <p><strong>Total Costo Estándar: $${data['Total Costo Estándar']}</strong></p>
            
            <h4>Cédula 2:</h4>
            <p>Costo MPD: $${data['Costo MPD']}</p>
            <p>Costo MOD: $${data['Costo MOD']}</p>
            <p>Costo CIV: $${data['Costo CIV']}</p>
            <p>Costo CIF: $${data['Costo CIF']}</p>
            <p><strong>Suma Total Cédula 2: $${data['Suma Total Cédula 2']}</strong></p>
            
            <h4>Cédula 3:</h4>
            <p>Costo Proceso MPD: $${data['Costo Proceso MPD']}</p>
            <p>Costo Proceso MOD: $${data['Costo Proceso MOD']}</p>
            <p>Costo Proceso CIV: $${data['Costo Proceso CIV']}</p>
            <p>Costo Proceso CIF: $${data['Costo Proceso CIF']}</p>
            <p><strong>Suma Total Cédula 3: $${data['Suma Total Cédula 3']}</strong></p>

            <h4>Cédula 4 (Desviaciones):</h4>
            <p>Desviación MP: $${data['Desviación MP']} (${data['Desviación MP Tipo']})</p>
            <p>Desviación MO: $${data['Desviación MO']} (${data['Desviación MO Tipo']})</p>
            <p>Desviación CI: $${data['Desviación CI']} (${data['Desviación CI Tipo']})</p>

            
            <h4>Cédula 5 (Val. Prod Terminada):</h4>
            <p>Valuacion de la produccion Terminada: $${data['Val.Prod Termi']}</p>

            
            <h4>Cédula 6 (Val. del Inv Final de la Produccion):</h4>
            <p>Costo Total de IFPT a CE: $${data['unidades_vendidas']}</p>
        `;
    })
    .catch(error => console.error('Error:', error));
});