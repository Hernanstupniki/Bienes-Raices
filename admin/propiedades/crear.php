<?php
    session_start(); // Iniciar la sesión

    require '../../includes/config/database.php';
    $db = conectarDB();

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta); 

    // Arreglo con mensajes de errores
    $errores = [];

    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $wc = '';
    $estacionamiento = '';
    $vendedorID = '';
    $creado = date('Y/m/d');

    
    // Ejecutar el codigo despues de que se envie el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        $titulo = mysqli_real_escape_string( $db, $_POST['titulo']) ;
        $precio = mysqli_real_escape_string( $db, $_POST ['precio']) ;
        $descripcion = mysqli_real_escape_string( $db, $_POST ['descripcion']) ;
        $habitaciones = mysqli_real_escape_string( $db, $_POST['habitaciones']) ;
        $wc = mysqli_real_escape_string( $db, $_POST ['wc']) ;
        $estacionamiento = mysqli_real_escape_string( $db, $_POST ['estacionamiento']) ;
        $vendedorID = mysqli_real_escape_string( $db, $_POST ['vendedores_id']) ;

        // Asignar files hacia una variable
        $imagen = $_FILES['imagen'];

        // Validar que no haya campos vacios

        if(!$titulo) {
            $errores[] = "Debes añadir un título";
        }

        if(!$titulo) {
            $errores[] = "El precio es obligatorio";
        }

        if(strlen($descripcion) < 50) {
            $errores[] = "La descripcion es obligatoria, debe tener almenos de 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "El número de habitaciones es obligatorio";
        }

        if(!$wc) {
            $errores[] = "El número de baños es obligatorio";
        }

        if(!$estacionamiento) {
            $errores[] = "El número de estacionamientos es obligatorio";
        }

        if(!$vendedorID) {
            $errores[] = "Elige un vendedor";
        }

        if(!$imagen['name'] || $imagen['error']) {
            $errores[] = "La imagen es obligatoria";
        }

        // Validar tamaño de la imagen (1mb maximo)
        do {
 
            if(!($imagen['type'] == "image/jpeg" || $imagen['type'] == 'image/png')){
                $errores[] = "Debes elegir una Imagen jpg/png, no un Archivo";
                break;
            }
            //Validar imagen por tamaño (100 KB máximo)
         
            $medida = 1000 * 1000;
         
            if($imagen['size'] > $medida) {
                $errores[] = 'La Imagen es muy pesada';
            break;
            }
         
        }while(0);

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
        
        if (empty($errores)) {

            //Subida de archivos
            $carpetaImagenes = '../../imagenes/';

            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            // Generar un nombre unicio para la imagen
            $nombreImagen = md5( uniqid( rand(), true ) );

            // Subir imagen
    
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen . ".jpg");
            $imagenSubida = $imagen['name'];

        // Insertar en la base de datos
        $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, credo, vendedores_id) VALUES ('$titulo', '$precio', 'nombreImagen',  '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorID')";

        $resultado = mysqli_query($db, $query);

        if($resultado) {
            $_SESSION['exito'] = "Se añadió una propiedad correctamente";
            // Redireccionar al usuario
            header('Location: /admin');
        }
    }
}
    
    require '../../includes/funciones.php';
    incluirTemplate('header');
?>

    <main class="contenedor seccion">
        <h1>Crear</h1>


        <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            <fieldset>
                <legend>Información General</legend>

                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Título Propiedad" value="<?php echo $titulo; ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"> <?php echo $precio; ?> </textarea>
            </fieldset>

            <fieldset>
                <legend>Información Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="wc" placeholder="Ej: 2" min="1" max="9" value="<?php echo $wc; ?>">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 2" min="1" max="9" value="<?php echo $estacionamiento; ?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <select name="vendedores_id">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorID === $vendedor['id'] ? 'selected' : ''; ?> value="<?php echo $vendedor['id']; ?>">
                        <?php echo $vendedor['nombre'] . " " . $vendedor['apellido']; ?> 
                    </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
            <div class="botones-crear">
            <a href="/admin" class="boton boton-verde">Volver</a>
            <input type="submit" value="Crear Propiedad" class="boton boton-verde">
            </div>
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>

