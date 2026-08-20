// ============================================
// SCRIPTS.JS - Sistema Promart
// ============================================

// ============================================
// 1. RELOJ EN TIEMPO REAL
// ============================================
function iniciarReloj() {
    const reloj = document.getElementById('reloj');
    if (!reloj) return;
    function actualizar() {
        const ahora = new Date();
        const horas = String(ahora.getHours()).padStart(2, '0');
        const minutos = String(ahora.getMinutes()).padStart(2, '0');
        const segundos = String(ahora.getSeconds()).padStart(2, '0');
        const dias = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
        const meses = ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'];
        const dia = dias[ahora.getDay()];
        const fecha = `${dia} ${ahora.getDate()} ${meses[ahora.getMonth()]} ${ahora.getFullYear()}`;
        reloj.innerHTML = `🕐 ${horas}:${minutos}:${segundos} &nbsp;|&nbsp; 📅 ${fecha}`;
    }
    actualizar();
    setInterval(actualizar, 1000);
}

// ============================================
// 2. ALERTAS BONITAS (reemplaza alert())
// ============================================
function mostrarAlerta(mensaje, tipo = 'info') {
    // Eliminar alerta anterior si existe
    const anterior = document.getElementById('alerta-promart');
    if (anterior) anterior.remove();

    const colores = {
        'success': { bg: 'rgba(46,204,113,0.15)', border: '#2ecc71', icon: '✅' },
        'error':   { bg: 'rgba(231,76,60,0.15)',  border: '#e74c3c', icon: '❌' },
        'warning': { bg: 'rgba(224,123,32,0.15)', border: '#e07b20', icon: '⚠️' },
        'info':    { bg: 'rgba(52,152,219,0.15)', border: '#3498db', icon: 'ℹ️' }
    };

    const c = colores[tipo] || colores['info'];
    const div = document.createElement('div');
    div.id = 'alerta-promart';
    div.style.cssText = `
        position: fixed; top: 20px; right: 20px; z-index: 9999;
        background: ${c.bg}; border-left: 4px solid ${c.border};
        color: white; padding: 16px 20px; border-radius: 8px;
        font-family: Arial; font-size: 14px; max-width: 320px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        animation: slideIn 0.3s ease;
    `;
    div.innerHTML = `${c.icon} ${mensaje}`;

    const style = document.createElement('style');
    style.textContent = `@keyframes slideIn { from { transform: translateX(100px); opacity:0; } to { transform: translateX(0); opacity:1; } }`;
    document.head.appendChild(style);
    document.body.appendChild(div);

    setTimeout(() => { if(div) div.remove(); }, 3500);
}

// ============================================
// 3. CONFIRMACION BONITA ANTES DE ELIMINAR
// ============================================
function confirmarEliminar(url, nombre = 'este registro') {
    const modal = document.createElement('div');
    modal.style.cssText = `
        position: fixed; inset: 0; background: rgba(0,0,0,0.6);
        display: flex; align-items: center; justify-content: center;
        z-index: 9999; font-family: Arial;
    `;
    modal.innerHTML = `
        <div style="background:#1a2a3a; border:1px solid rgba(255,255,255,0.15);
             border-radius:16px; padding:36px; max-width:380px; text-align:center; color:white;">
            <div style="font-size:48px; margin-bottom:16px;">🗑️</div>
            <h3 style="font-size:18px; margin-bottom:10px;">¿Eliminar registro?</h3>
            <p style="font-size:14px; color:#a0bcd8; margin-bottom:28px;">
                ¿Estás seguro que deseas eliminar <strong>${nombre}</strong>? Esta acción no se puede deshacer.
            </p>
            <div style="display:flex; gap:12px; justify-content:center;">
                <button onclick="this.closest('[style]').remove()"
                    style="padding:10px 28px; background:transparent; border:2px solid rgba(255,255,255,0.3);
                    border-radius:8px; color:white; font-size:14px; cursor:pointer;">
                    Cancelar
                </button>
                <button onclick="window.location='${url}'"
                    style="padding:10px 28px; background:#e74c3c; border:none;
                    border-radius:8px; color:white; font-size:14px; font-weight:bold; cursor:pointer;">
                    Sí, eliminar
                </button>
            </div>
        </div>
    `;
    document.body.appendChild(modal);
}

// ============================================
// 4. BUSCADOR EN TABLAS
// ============================================
function iniciarBuscador() {
    const input = document.getElementById('buscador');
    if (!input) return;
    input.addEventListener('keyup', function () {
        const filtro = this.value.toLowerCase();
        const filas = document.querySelectorAll('table tbody tr, table tr:not(:first-child)');
        filas.forEach(fila => {
            const texto = fila.textContent.toLowerCase();
            fila.style.display = texto.includes(filtro) ? '' : 'none';
        });
    });
}

// ============================================
// 5. CONTADOR DE CARACTERES EN INPUTS
// ============================================
function contadorCaracteres() {
    document.querySelectorAll('input[maxlength], textarea[maxlength]').forEach(input => {
        const max = input.getAttribute('maxlength');
        const contador = document.createElement('small');
        contador.style.cssText = 'color:#a0bcd8; font-size:11px; display:block; text-align:right; margin-top:2px;';
        contador.textContent = `0 / ${max}`;
        input.parentNode.insertBefore(contador, input.nextSibling);
        input.addEventListener('input', () => {
            contador.textContent = `${input.value.length} / ${max}`;
            contador.style.color = input.value.length >= max ? '#e74c3c' : '#a0bcd8';
        });
    });
}

// ============================================
// 6. RESALTAR FILA AL HACER HOVER EN TABLA
// ============================================
function resaltarFilas() {
    document.querySelectorAll('table tr').forEach(fila => {
        fila.addEventListener('mouseenter', () => fila.style.cursor = 'pointer');
    });
}

// ============================================
// 7. VOLVER ARRIBA
// ============================================
function botonVolverArriba() {
    const btn = document.createElement('button');
    btn.id = 'btn-arriba';
    btn.innerHTML = '↑';
    btn.style.cssText = `
        position: fixed; bottom: 30px; right: 30px;
        width: 44px; height: 44px; border-radius: 50%;
        background: #e07b20; border: none; color: white;
        font-size: 20px; cursor: pointer; display: none;
        box-shadow: 0 4px 12px rgba(0,0,0,0.3); z-index: 999;
        transition: 0.2s;
    `;
    btn.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
    document.body.appendChild(btn);
    window.addEventListener('scroll', () => {
        btn.style.display = window.scrollY > 300 ? 'block' : 'none';
    });
}

// ============================================
// INICIALIZAR TODO AL CARGAR LA PÁGINA
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    iniciarReloj();
    iniciarBuscador();
    contadorCaracteres();
    resaltarFilas();
    botonVolverArriba();
});