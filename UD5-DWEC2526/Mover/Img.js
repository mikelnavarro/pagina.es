export class Img {
  constructor(src, alt, x, y, vx, vy) {
    this.alt = alt;
    this.src = src;
    this.x = x;
    this.y = y;
    this.vy = vy;
    this.vx = vx;

    // Creamos el elemento img
    this.img = document.createElement('img');
    this.img.src = src;
    this.img.alt = alt;
    this.img.style.position = "absolute"; // imprescindible para moverla con top/left
  }
  // width/height para mover
  move(container, width, height) {
    this.x += this.vx;
    this.y += this.vy;
    this.width = width;
    this.height = height;

    // Rebote en los bordes
    if (this.x + width > window.innerWidth || this.x < 0) {
      this.vx = -this.vx;
    } else if (this.y + height > window.innerHeight || this.y < 0) {
      this.vy = -this.vy;
    }
    // actualizamos la posicion
    this.img.style.left = this.x + "px";
    this.img.style.top = this.y + "px";
    
    // Añadimos al container si no está
    if (!this.img.parentElement) {
      container.appendChild(this.img);
    }
    
  }
}
