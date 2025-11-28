// IMPORTACIONES
import { tipoNulo, tipoGeneral, tipoReducido, tipoSuperReducido } from "./tiposDeIVA.js";
export class Product {
    
    name;
    price;
    categoria;
    discount;
    fechaCreacion;
    finalPrice;
    codigo;
  constructor(name, price, categoria, discount) {
    this.name = name;
    this.price = price;
    this.categoria = categoria;
    this.discount = discount;
    this.fechaCreacion = new Date().toLocaleDateString("es-ES");
  }
  generarCodigo() {
    const day = new Date().getDate() + 1;
    const primerCaracter = this.name.slice(0, 1);

    return `${primerCaracter}${day}`;
  }
  calcularPrecioFinal() {
    if (this.categoria === "higiene") {
      this.finalPrice = this.price * tipoSuperReducido;
    } else if (this.categoria === "alimentacion") {
      this.finalPrice = this.price * tipoSuperReducido;
    } else {
      this.finalPrice = this.price * tipoGeneral;
    }

    return this.finalPrice;
  }
}
