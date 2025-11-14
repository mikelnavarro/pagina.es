// ProductFactory.js
export class ProductFactory {
    static create(name, price) {
        return {
            id: crypto.randomUUID(),
            name,
            price,
            finalPrice: price * 1.21 // IVA aplicado
        };
    }
}
