// Cargar las propinas desde el almacenamiento local
let propinas = JSON.parse(localStorage.getItem('propinas')) || [];

document.addEventListener('DOMContentLoaded', function () {
    // Cargar las propinas registradas al cargar la página
    mostrarPropinas();

    // Manejo del formulario de ingreso de propinas
    document.getElementById('form').addEventListener('submit', function (event) {
        event.preventDefault();

        const id_usuario = document.getElementById('id_usuario').value;
        const monto = document.getElementById('monto').value;
        const fecha = new Date().toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD

        // Crear el objeto de propina
        const propina = { id_usuario, fecha, monto };

        // Agregar la nueva propina al array de propinas
        propinas.push(propina);

        // Guardar las propinas en el almacenamiento local
        localStorage.setItem('propinas', JSON.stringify(propinas));

        // Actualizar la tabla de propinas
        mostrarPropinas();

        // Limpiar el formulario
        document.getElementById('form').reset();
    });

    // Generar PDF
    document.getElementById('generar-pdf').addEventListener('click', function () {
        const doc = new jsPDF();
        doc.setFont('Arial', 'B', 12);

        // Título
        doc.text("Registro de Propinas", 20, 20);

        // Agregar las propinas al PDF
        let yPosition = 30;
        propinas.forEach(propina => {
            doc.text(`ID Usuario: ${propina.id_usuario} | Fecha: ${propina.fecha} | Monto: $${propina.monto}`, 20, yPosition);
            yPosition += 10;
        });

        // Guardar el PDF
        doc.save('propinas.pdf');
    });

    // Imprimir ticket (simulando la impresión en el navegador)
    document.getElementById('imprimir-ticket').addEventListener('click', function () {
        let ticketContent = "";
        propinas.forEach(propina => {
            ticketContent += `ID Usuario: ${propina.id_usuario}\nFecha: ${propina.fecha}\nMonto: $${propina.monto}\n\n`;
        });

        // Crear un iframe invisible para imprimir
        const iframe = document.createElement('iframe');
        iframe.style.position = 'absolute';
        iframe.style.width = '0px';
        iframe.style.height = '0px';
        iframe.style.border = 'none';
        document.body.appendChild(iframe);

        // Escribir el contenido del ticket en el iframe y enviarlo a la impresora
        const doc = iframe.contentWindow.document;
        doc.open();
        doc.write(ticketContent);
        doc.close();
        iframe.contentWindow.print();
    });
});

// Función para mostrar las propinas en la tabla
function mostrarPropinas() {
    const tabla = document.getElementById('tabla-propinas').getElementsByTagName('tbody')[0];
    tabla.innerHTML = '';

    propinas.forEach(propina => {
        const row = tabla.insertRow();
        row.innerHTML = `
            <td>${propina.id_usuario}</td>
            <td>${propina.fecha}</td>
            <td>${propina.monto}</td>
        `;
    });
}
