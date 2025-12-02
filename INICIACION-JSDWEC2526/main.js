const auto = {
    color: 'rojo',
    motor: 1.6,
    automatico: true
}
const autoNuevo = Object.assign({}, auto);
autoNuevo.color = 'verde';
console.log(autoNuevo);