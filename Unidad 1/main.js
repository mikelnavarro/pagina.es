function calcularFactorial(numero) {
  let result = 1;
  if (numero < 0) {
    return result;
  }
  for (let i = 1; i <= numero; i++) {
    result *= i;
  }
  return result;
}

console.log(calcularFactorial(3));

document.addEventListener("submit", function (e) {
    e.preventDefault();
    let number = parseInt(document.getElementById("number").value);
    let result = calcularFactorial(number);
    let etiq = document.getElementById("Factorial");
    etiq.innerHTML = "<p><strong>" + result + "</strong></p>";
  });
