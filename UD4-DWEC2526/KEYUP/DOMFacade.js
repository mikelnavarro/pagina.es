export const DOMFacade = {
  // Mostrar Elementos
  mostrar(arrayProductos) {
    const listaproductos = document.getElementById("listaproductos");
    listaproductos.innerHTML = "";

    // Ver si hay productos
    if (arrayProductos.length === 0) {
      listaproductos.innerHTML = "<p>No hay productos a mostrar.</p>";
      return;
    }
    arrayProductos.forEach((product) => {
      const div = document.createElement("div");
      div.classList.add("producto-card");
      div.innerHTML = `<h5>${product.name}</h5>
            <p>Precio sin IVA: ${product.price} $</p>
            <p>Fecha: ${product.fechaProducto} </p>
            <p>Horas: ${product.horaProducto} h. </p>
            <p>Precio final: ${product.finalPrice} $ </p>
            <p>ID: ${product.id}</p><br>`;
      listaproductos.appendChild(div);
    });
  },
  clearForm() {
    document.getElementById("form-producto").reset();
  },
};
