export const validator = {
    set(obj, prop, value){
        if (prop === "price" && value < 0){
            throw Error("No puedes poner precios negativos.");
        }
        obj[prop] = value;
        return true;
    }
}