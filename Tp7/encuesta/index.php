<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Equipo Favorito - TP6</title>
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .element {
            display: block;
            margin-bottom: 10px;
        }
        .equipo {
            display: flex;
            margin-bottom: 10px;
            align-items: center;
        }
        .equipo img {
            width: 35px;
            height: auto;
        }

    </style>
    <script>
        function validarFormulario() {
            var email = document.getElementById("email").value;
            if (email == "") {
                alert("Por favor ingrese su correo electrónico.");
                return false;
            }

            var posicionArroba = email.indexOf("@");
            if(posicionArroba < 7) {
                alert("El mail debe tener al menos 7 caracteres");
                return false;
            }

            if(posicionArroba <= 0 || posicionArroba ===email.length - 1) {
                alert("El correo debe contener '@' pero no al principio ni al final");
                return false;
            }

            var opcionesEquipo = document.getElementsByName("equipo");
            var seleccionado = false;
            for (var i = 0; i < opcionesEquipo.length; i++) {
                if(opcionesEquipo[i].checked){
                    seleccionado = true;
                    break;
                }
            }
            if(!seleccionado){
                alert("Debe seleccionar un equipo");
                return false;
            }


        }
    </script>
</head>
<body>
    <div class="container">
        <div class= "element">
            <img src="https://escuelaverarenas.uncuyo.edu.ar/cache/unnamed2_546_966.jpg" alt="Logo" width="320">
            <br>
            <h1>Elija su equipo favorito</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validarFormulario()">
                <label for="email">Ingrese su e-mail:</label>
                <input type="email" id="email" name="email">
                <br><br>
                <div class="equipo">
                    <input type="radio" id="CABJ" name="equipo" value="CABJ">
                    <label for="CABJ"> Boca Juniors </label>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/41/CABJ70.png/640px-CABJ70.png">
                    
                </div>
                <div class="equipo">
                    <input type="radio" id="CARP" name="equipo" value="CARP">
                    <label for="CARP"> River Plate </label>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/3f/Logo_River_Plate.png">
                </div>
                <div class="equipo">
                    <input type="radio" id="CASLDEA" name="equipo" value="CASLDEA">
                    <label for="CASLDEA"> San Lorenzo </label>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/6/62/Escudo_del_Club_Atl%C3%A9tico_San_Lorenzo_de_Almagro.png">
                </div>
                <div class="equipo">
                    <input type="radio" id="RACING" name="equipo" value="RACING">
                    <label for="RACING"> Racing </label>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Escudo_de_Racing_Club.svg/1200px-Escudo_de_Racing_Club.svg.png">
                </div>
                <div class="equipo">
                    <input type="radio" id="CAI" name="equipo" value="CAI">
                    <label for="CAI"> Independiente </label>
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/Escudo_del_Club_Atl%C3%A9tico_Independiente.svg/474px-Escudo_del_Club_Atl%C3%A9tico_Independiente.svg.png">
                </div>
                <div class="equipo">
                    <input type="radio" id="otro" name="equipo" value="otro">
                    <label for="CARP"> Otro </label>
                </div>
                <br><br>
                <input type="submit" value="Enviar">
            </form>
        </div>
        

    </div>
    
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $archivo = 'respuestas_encuesta.txt';
        
        // Leer el archivo de respuestas
        $contenido = file($archivo, FILE_IGNORE_NEW_LINES);

        // Verificar si el correo ya ha respondido
        if(in_array($email, $contenido)) {
            echo "Ya respondió la encuesta";
        } else {
            // Si el correo no ha respondido, procesar la respuesta normalmente
            $equipo = $_POST["equipo"];

            // Guardar la respuesta en el archivo
            $respuesta = $email . ',' . $equipo . PHP_EOL;
            file_put_contents($archivo, $respuesta, FILE_APPEND);

            echo "Gracias por participar";
        }

        // Calcular los resultados de la encuesta
        $resultados = array();
        foreach($contenido as $linea) {
            $datos = explode(",", $linea);
            $equipo = trim($datos[1]);
            if (!isset($resultados[$equipo])) {
                $resultados[$equipo] = 1;
            } else {
                $resultados[$equipo]++;
            }
        }

        // Mostrar resultados de la encuesta
        echo "<h2> Resultados de la encuesta: </h2>";
        foreach($resultados as $equipo => $votos) {
            echo $equipo . ": " . $votos . " votos<br>";
        }
    }
    ?>

</body>
</html>
