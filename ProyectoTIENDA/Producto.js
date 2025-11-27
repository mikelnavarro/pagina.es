export class Producto {
  constructor(nombre, pais, precioBase, IVA, discount) {
    this.nombre = nombre;
    this.pais = pais;
    this.precioBase = precioBase;
    this.IVA = IVA;
    this.discount = discount;
    this.ID = generarCodigo();
    this.fecha = new Date();
  }

  formatear() {

    const day = this.fecha.getDate() + 1;
    const year = this.fecha.getUTCFullYear();
    const month = this.fecha.getMonth() + 1;
    const fechaFormateada = `${day}-${month}-${year}`;
    
    return fechaFormateada;
  }

  generarCodigo() {
    const primerCaracter = this.nombre.slice(0,1);
    const pais = this.pais.substring(0,2);

    
    return `${pais}${primerCaracter}`;
  }
}
