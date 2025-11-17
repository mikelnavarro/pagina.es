export class Tarea {
    constructor(titulo,description,priority) {
        this.id = Date.now();
        this.titulo = titulo;
        this.description = description;
        this.priority = priority;
        this.done = false;
        }
    toggleComplete() { this.done = !this.done; }
    complete() { this.done = true; }
}