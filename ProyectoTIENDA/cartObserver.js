export class CartObserver {
    constructor(){
        this.observers = [];
    }
    subscribe(fn){
        this.observers.push(fn);
    }
    notify(total){
        this.observers.forEach(fn => fn(total));
    }
}