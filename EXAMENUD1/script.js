// VARIABLES
const msg = document.createElement("span");
const pagina = document.getElementById("container");
let entrada = prompt("Introduce numeros separados por (p.ej.1,2,3,1,1,3).: ");
// Convertir STRING ==> ARRAY
let nums = entrada.split(",");
if (nums.length <= 0) {
    mostrarError();
}
const size = nums.length;

// Detectar letras / Valores Inválidos
const numeros = nums.map((e) => parseInt(e));
const hayLetras = numeros.some((n) => isNaN(n));
if (hayLetras) {
    title.textContent = "Error.";
} else {
    countGoodPairs(nums);
}

function countGoodPairs(nums) {
    let paresBuenos = [];
    for (let i = 0; i < size; i++) {
        for (let j = i + 1; j < size; j++) {
            if (nums[i] === nums[j]) {
                paresBuenos.push({
                    i: i,
                    j: j,
                    valores: [nums[i], nums[j]]
                });
            }
        }
    }
    return paresBuenos;
}
function mostrarEnLaPagina() {
    const pares = countGoodPairs(nums);
    pagina.textContent = "";
    const title = document.createElement("h3");
    title.classList.add("card");
    const lnumeros = document.createElement("p");
    const li = document.createElement("li");
    const ul = document.createElement("ul");
    title.textContent = "Resultado:";
    lnumeros.textContent = `${nums}`;
    pares.forEach(par => {
        const li = document.createElement("li");
        li.textContent = `(${par.i}, ${par.j}) => Valores: ${par.valores}`;
        ul.appendChild(li);
    });
    pagina.appendChild(lnumeros);
    pagina.appendChild(title);
    pagina.appendChild(ul);
}
function mostrarError() {
    pagina.textContent = " ";
    const div = document.createElement("div");
    div.classList.add("msg");
    msg.textContent =
        "El Array de números esta vacío o no contiene números reales.";
    pagina.appendChild(msg);
}
mostrarEnLaPagina();
