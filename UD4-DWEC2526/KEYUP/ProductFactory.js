export class ProductFactory {
    static create(name, price, categoria, discount) {
        return {
            id: crypto.randomUUID(),
            name,
            price,
            categoria,
            discount,
            finalPrice: price * 1.21, // IVA aplicado
            fechaCreacion: new Date().toLocaleDateString('es-ES')
        };
    }
}
