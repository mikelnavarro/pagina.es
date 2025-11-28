export class ProductFactory {
    constructor(name, price, discount) {
        return {
            id: crypto.randomUUID(),
            name,
            price,
            finalPrice: price * 1.21, // IVA aplicado
            fechaProducto: new Date().toLocaleDateString('es-ES'),
            horaProducto: new Date().getHours()
        };
    }
}
