

function esPrimo(number) {


    if (number < 2) {
        return false;
    }
    for (let i = 2; i < number; i++) { // For
        if (number % i === 0) {
            return false;
        }
    }
    return true;
}

console.log("1 ===> " + esPrimo(1));
console.log("2 ===> " + esPrimo(2));
console.log("3 ===> " + esPrimo(3));
console.log("4 ===> " + esPrimo(4));
console.log("5 ===> " + esPrimo(5));


