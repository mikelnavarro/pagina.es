import { Tarea } from './Tarea.js';
import { TaskObserver } from './TaskObserver.js';
import { GuardarTareas } from './Storage.js';
const formularioGestor = document.getElementById("formulario");
const storage = new GuardarTareas();
const observer = new TaskObserver();
const listaTotal = document.getElementById("lista");
const estaCompletada = document.getElementById("filterStatus");
const filterPriority = document.getElementById("filterPriority");





const arrayTasks = storage.load() || []; // array de tareas
/* Escucha al Formulario */
/* Aqui yo que se que nombres puesto */
formularioGestor.addEventListener("submit", (e) => {
    e.preventDefault();
    // Elementos de la Tarea
    const title = document.getElementById("title").value;
    const description = document.getElementById("description").value;
    const priority = document.getElementById("priority").value;

    // Comprobamos si el titulo esta rellenado
    if (!title) {
        return alert("Debe completar el campo Titulo.");
    }

    
    // Añadir elementos
    addTarea(title, description, priority);


});


/* Función Añadir */
function addTarea(title, desc, priority) {
    const task = new Tarea(title, desc, priority);
    arrayTasks.push(task);
    storage.save(arrayTasks);
    mostrarElementos();

}
/* Función Borrar */
function deleteTarea(id) {
    /* Funcion Eliminar */
  arrayTasks.forEach((t) => {
    if (id) {
      arrayTasks.pop(t.id);
    }
    storage.save(arrayTasks);
    mostrarElementos();
  });
}




function mostrarElementos(filtro = () => true) {
    listaTotal.innerHTML = ""; // Limpiar
    arrayTasks
    .filter(filtro) // aplicamos el filtro
    .forEach((task) => {
        const div = document.createElement("div");
        div.classList.add("task-item");
        
        // Elementos en el DOM
        div.innerHTML = `
            <p><strong>ID:</strong> ${task.id}</p>
            <p><strong>Título:</strong> ${task.title}</p>
            <p><strong>Descripción:</strong> ${task.description}</p>
            <p><strong>Prioridad:</strong> ${task.priority}</p>
            <button class="complete-btn" data-id="${task.id}">Completada</button>
            <button class="delete-btn" data-id="${task.id}">Eliminar</button>
        `;
        listaTotal.appendChild(div);
        // Borrar Tarea
        const btnDelete = div.querySelector(".delete-btn");
        btnDelete.addEventListener("click", function () {
            const id = btnDelete.dataset.id;
            deleteTarea(id);
        });

        // Completar Tarea
        const btnCompletar = div.querySelector(".complete-btn");
        btnCompletar.addEventListener("click", function () {
            task.complete();
            mostrarElementos();
            storage.save(arrayTasks);
        });
    });
}
// Filtramos en prioridad
filterPriority.addEventListener("change", function (e) {

    const prioridad = filterPriority.value;
    
    mostrarElementos(task => {
        if (prioridad == "todas") return true;
        return task.priority === prioridad;
    });
});
storage.load();
mostrarElementos();
