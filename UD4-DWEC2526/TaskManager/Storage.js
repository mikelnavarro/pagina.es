
import { Tarea } from './Tarea.js';
export class GuardarTareas {
  save(tareas) {
    localStorage.setItem("tareas", JSON.stringify(tareas));
  }
  load() {
    const datos = JSON.parse(localStorage.getItem("tareas"));
    if (datos) {
      return datos.map(t => {
        const task = new Tarea(t.titulo, t.description, t.priority)
        task.id = t.id;
        task.done = t.done;
        return task;
      });
    }
  }
}
