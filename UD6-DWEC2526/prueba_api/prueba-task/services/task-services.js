const Task = require("../models/task");

class TaskService {
  static tasks = [];

  static get() {
    return TaskService.tasks;
  }

  static getById(id) {
    return TaskService.tasks.find((m) => m.id === id);
  }

  static post(marca, modelo, precio) {
    const newTask = new Task(marca, modelo, precio);
    TaskService.tasks.push(newTask);
    return newTask;
  }

  static delete(id) {
    const index = TaskService.tasks.findIndex((m) => m.id === id);
    if (index === -1) return null;

    return TaskService.tasks.splice(index, 1)[0];
  }

  static update(id, marca, modelo, precio) {
    const task = TaskService.tasks.find((m) => m.id === id);
    if (!task) return null;

    task.marca = marca;
    task.modelo = modelo;
    task.precio = precio;

    return task;
  }
}

module.exports = TaskService;