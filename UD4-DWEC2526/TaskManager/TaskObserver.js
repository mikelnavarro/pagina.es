export class TaskObserver {
    constructor() {
        this.subscribers = [];
    }
    subscribe(fn) {
        this.subscribers.push(fn);
    }
    notify(tarea) {
        this.subscribers.forEach(fn => fn(tarea));
    }
    
}


// Cuando el usuario marcara completada
// Llamamos a notify