# super-broccoli

## Nombre del proyecto Biblioteca Super-Brocoli
## Nombre de equipo Los secretarios de Super-Brocoli
## Nombre de los integrantes:
1. Alan Morales
2. Arturo Alfaro
3. Francisco Galindo
4. Heli Aguilar


## Guía de instalación del proyecto:
1. Clonar el repositorio en la carpeta htdocs dentro de una carpeta vacía
3. Crear una base de datos en mysql en la cual se va clonar el respaldo que venga en el repositorio
![imagen](https://user-images.githubusercontent.com/69480179/118084247-0113da80-b386-11eb-8713-df07b230b221.png)
El nombre de la base de datos será "biblioteca"

```
source <path de la base de datos que se encuentra en el repositorio>
```

5. Entrar en localhost e ingresar con una cuenta que se puede consultar correo y password en la base de datos


## Guía de configuración del proyecto:
Es necesario asegurarse de encender el servidor en XAAMP
De ser necesario, checar las contraseñas de los usuarios 
```
USE biblioteca
SELECT * FROM biblioteca;
```

## Características del proyecto:
Super-Brocolí es una biblioteca digital que cuenta con más de 20 libros de dominio público, en ella se pueden crear cuentas para los lectores que deseen acceder a nuestro 
contenido, Para poder crear cualquier cuenta con más permisos (biblotecario o administrador) deberá de hacerse a traves de una cuenta administrador.

El lector va a tener la capacidad de acceder a todo nuestro contenido, así como tener una descripción del libro para ver si le interesa la lectura y la capacidad de agregarlo
a su propia lista de favoritos, en donde una vez agregados podrá eliminarlos si decide que ya no son de su agrado. Con cada libro también tiene la capacidad de descargarlo o 
abrirlo en otra página para poder leerlo desde el navegador. En caso de tener algún conflicto con el contenido del texto va a poder reportarlo para que posteriormente este 
reporte sea revisado por un biblotecario o un administrador y quedará bajo criterio de este si tomará acción sobre el reporte o si no tiene sustento dicho reporte.

También como lector si se desea nos puede mandar sugerencias de libros que desearía agregar a nuestra biblioteca, con una razón por la cual crea que es necesario que lo 
incluyamos con el resto del contenido.

Los biblotecarios y administradores pueden ver reportes, las solicitudes y llevar una cuenta del historial de descargas además que contenga quien fue quien hizo dicha
descarga, también con los permisos de estas cuentas se puede agregar un libro desde cualquier página gracias al encabezado que tendrá para poder entrar a diferentes funciones 
sin tener que agregarlos desde la base de datos.

Todos los usuarios van a poder ver los datos de su perfil, y si así lo desean podrán eliminar su cuenta, eliminando con esta cualquier registro que haya habido de el usuario 
dentro de la base de datos.

Cabe aclarar que para crear una cuenta es necesario contar con un correo institucional de alumno o maestro de la ENP, en caso de no tenerlo no se podrá acceder a nuestro 
contenido.

En caso de que un administrador quiera eliminar una cuenta de cualquier tipo o crearla, este tipo de cuentas va a ser la única con los permisos para realizar dicha acción.

## Comentarios adicionales a su proyecto
