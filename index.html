// Arreglo para almacenar las propinas registradas
let propinas = [];

// Función para agregar propina
document.getElementById('form').addEventListener('submit', function (e) {
    e.preventDefault();
    
    let id_usuario = document.getElementById('id_usuario').value;
    let monto = document.getElementById('monto').value;
    let fecha = new Date().toLocaleString();

    // Guardar la propina
    propinas.push({ id_usuario, fecha, monto });

    // Actualizar la tabla
    actualizarTabla();

    // Limpiar los campos del formulario
    document.getElementById('id_usuario').value = '';
    document.getElementById('monto').value = '';
});

// Función para actualizar la tabla
function actualizarTabla() {
    const tbody = document.getElementById('tabla-propinas').getElementsByTagName('tbody')[0];
    tbody.innerHTML = '';

    propinas.forEach(function (propina) {
        let row = tbody.insertRow();
        row.insertCell(0).textContent = propina.id_usuario;
        row.insertCell(1).textContent = propina.fecha;
        row.insertCell(2).textContent = propina.monto;
    });
}

// Función para generar el PDF
document.getElementById('generar-pdf').addEventListener('click', function () {
    const doc = new jsPDF();

    doc.text('Registro de Propinas', 10, 10);
    propinas.forEach(function (propina, index) {
        doc.text(`${index + 1}. ${propina.id_usuario} - ${propina.fecha} - ${propina.monto}`, 10, 20 + (index * 10));
    });
    doc.save('propinas.pdf');
});

// Función para imprimir el ticket
document.getElementById('imprimir-ticket').addEventListener('click', function () {
    let printerContent = `
        <div style="text-align: center; font-family: Arial, sans-serif;">
            <h2>Ticket de Propina</h2>
            <p>ID Usuario: ${propinas[propinas.length - 1].id_usuario}</p>
            <p>Fecha: ${propinas[propinas.length - 1].fecha}</p>
            <p>Monto: $${propinas[propinas.length - 1].monto}</p>
        </div>
    `;
    
    let printWindow = window.open('', '', 'height=500,width=500');
    printWindow.document.write(printerContent);
    printWindow.document.close();
    printWindow.print();
});

// Función para ver los datos con contraseña
document.getElementById('ver-datos').addEventListener('click', function () {
    let password = prompt("Ingrese la contraseña:");
    if (password === "22782522") {
        alert("Datos de propinas: " + JSON.stringify(propinas));
        // Mostrar los datos
        document.getElementById('form-id_usuario').classList.remove('hidden');
        document.getElementById('form-monto').classList.remove('hidden');
    } else {
        alert("Contraseña incorrecta.");
    }
});

// Función para borrar los datos con contraseña
document.getElementById('borrar-datos').addEventListener('click', function () {
    let password = prompt("Ingrese la contraseña:");
    if (password === "22782522") {
        propinas = [];
        actualizarTabla();
        alert("Datos borrados.");
    } else {
        alert("Contraseña incorrecta.");
    }
});
