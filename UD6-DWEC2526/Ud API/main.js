const apitUrl = "https://jsonplaceholder.typicode.com/users/1";


// Función para obtener

fetch(apitUrl)
.then(response => response.json())
.then(datos => {
    document.getElementById("nombre-user").textContent = datos.name
    document.getElementById("correo-usuario").textContent = datos.email
});
