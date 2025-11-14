 function generarNumeroUnico() {
            var numerosGenerados = [];
            return function() {
                var numeroLoteria;
                do {
                    numeroLoteria = Math.floor(Math.random() * 1000);
                } while (numerosGenerados.includes(numeroLoteria));

                numerosGenerados.push(numeroLoteria);
                return numeroLoteria;
            }
        }

        var generarNumeroLoteriaUnico = generarNumeroUnico();

        function generarDecimoLoteria() {
            // Obtener datos del formulario
            var nombre = document.getElementById("nombre").value;
            var apellidos = document.getElementById("apellidos").value;
            var dni = document.getElementById("dni").value;
            var provincia = document.getElementById("provincia").value;
            var correo = document.getElementById("correo").value;




            // Generar número de lotería aleatorio único del 0 al 999
            var numeroLoteria = generarNumeroLoteriaaleatorio
            var codigoSeguridad = Math.floor(Math.random() * 1000000);

            // Asignar estos valores a los campos ocultos del formulario
            document.getElementById("numeroSerie").value = numeroSerie;
            document.getElementById("decimo").value = numeroLoteria;
            document.getElementById("codigoSeguridad").value = codigoSeguridad;

            // Construir contenido del décimo de lotería
            var contenidoDecimo =
                "<html lang='es'>" +
                "<head>" +
                "<meta charset='UTF-8'>" +
                "<meta name='viewport' content='width=device-width, initial-scale=1.0'>" +
                "<title>LOTERÍA ONDA ESPAÑA</title>" +
                "<style>" +
                "body { font-family: 'Arial', sans-serif; text-align: center; }" +
                "h1 { color: #cc0000; margin-bottom: 10px; }" +
                "#decimoLoteria { margin-top: 20px; background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); position: relative; }" +
                "#imagenFondo { width: 100%; height: auto; position: absolute; top: 0; left: 0; z-index: -1; }" +
                "</style>" +
                "</head>" +
                "<body>" +
                "<div id='decimoLoteria'>" +
                "<img id='imagenFondo' src='imagen1.jpeg' alt='Imagen de Fondo'>" +
                "<h2>Felicidades, has participado en LOTERÍA ONDA ESPAÑA</h2>" +
                "<p>Te presentamos tu décimo de lotería:</p>" +
                "<h1 style='font-size: 40px; color: #cc0000; margin: 0;'>" + numeroLoteria + "</h1>" +
                "<p>Número de Serie: " + numeroSerie + " (nº " + numeroSerie + "/" + totalEnSerie + " en la serie)</p>" +
                "<p>Código de Seguridad: " + codigoSeguridad + "</p>" +
                "<p>Datos del Participante:</p>" +
                "<p><strong>Nombre:</strong> " + nombre + "</p>" +
                "<p><strong>Apellidos:</strong> " + apellidos + "</p>" +
                "<p><strong>DNI:</strong> " + dni + "</p>" +
                "<p><strong>Provincia/CCAA:</strong> " + provincia + "</p>" +
                "<p><strong>Correo Electrónico:</strong> " + correo + "</p>" +
                "</div>" +
                "</body>" +
                "</html>";

            // Crear un objeto Blob para el contenido del archivo HTML
            var blob = new Blob([contenidoDecimo], { type: "text/html;charset=utf-8" });

            // Crear un enlace de descarga y simular clic en él
            var enlaceDescarga = document.createElement("a");
            enlaceDescarga.href = URL.createObjectURL(blob);
            enlaceDescarga.download = "decimo_loteria.html";
            document.body.appendChild(enlaceDescarga);
            enlaceDescarga.click();
            document.body.removeChild(enlaceDescarga);

            // Enviar el formulario automáticamente
            document.getElementById('formularioDatos').submit();
        }