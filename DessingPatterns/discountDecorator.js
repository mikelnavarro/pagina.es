export function applyDiscount(producto, discountPercent){
    return {
        ...producto,
        discountPrice: producto.price * (1 - discountPercent)
    }
}