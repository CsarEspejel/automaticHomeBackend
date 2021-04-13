# Automatic Home Project

## Instalación

1. Requerimientos
	* Tener instalado Composer
	* Tener instalado PHP (Puede ser con xampp) versión 7.3
	* Tener instalado Git
2. Descarga del proyecto
	* Crear la carpeta donde se va a descargar el repositorio
	* Clonar el repositorio dentro de la carpeta desde la línea de comandos (cmd)
		* Usando el comando " git clone %url del proyecto% " 
3. Instalar paquetes o dependencias
	* Desde la ventana de comandos (CMD) ubicados dentro de la carpeta del proyecto ejecutar el comando "composer install"
	* Clonar contenido del archivo ".env.example" haciendo uso del comando "cp .env.example .env"
		* Dentro del archivo ".env" buscar las líneas que tienen como prefijo "DB", es donde se van a configurar las credenciales para acceder a la base de datos. 
	* Generamos la APP_KEY con el comando "php artisan key:generate"
	* (Nuevo) Para utilizar la funcionalidad de Passport se debe ejecutar el comando "php artisan passport:install" (Para esto ya se deben de tener en mysql las nuevas tablas, mismas que están en el .sql que les mandé la vez pasada)
4. Prueba
	* Probamos que el proyecto se ejecute correctamente
		* Desde el cmd ejecuta el comando "php artisan serve", esto es para iniciar el servidor de Laravel
		* Abre el navegador y escribe la dirección "localhost:8000"

***
## Uso de las ramas

Ya teniendo instalado el proyecto se van a crear ramas alternas para la realización de las distintas funcionalidades de la aplicación.  
Ejemplo: Si vas a realizar la funcionalidad de Dispositivos, va a crear la rama "dispositivos".

***
## Probar la API para registro e inicio de sesión
* Requisitos:
	* Tener instalado Postman (Herramienta que permite hacer peticiones REST hacia una api).
	* Tener iniciado el servidor de Laravel y el servidor de XAMPP (o cualquiera que use para iniciar Apache y Mysql)
* Procedimiento:
	* Teniendo abierto Postman, en el apartado donde viene el método HTTP a utilizar selecciona "POST" y la dirección URL a utilizar será "localhost:8000/api/register", este enlace es para registrar un nuevo usuario, en el apartado de parametros se van a escribir los siguientes (anexo imagen):
        * ![image](https://user-images.githubusercontent.com/18290558/114481188-ae4dd400-9bc9-11eb-8416-619663d9ed1b.png)

		* "rol, name, email y password" son obligatorios y pueden ser datos cualesquiera
		* "phone y email_master" pueden ser opcionales, el número de teléfono son 10 dígitos.

		* NOTA 2: en todas las peticiones en la pestaña de "Headers" agregaremos uno nuevo el cual su key será "Accept" y su value será "application/json", esto para que las respuestas nos las devuelva en formato Json.

	* Para la acción de iniciar sesión, igualmente dentro de postman especificamos un envío de tipo "POST" y la dirección a utilizar será "localhost:8000/api/login", nos movemos a la pestaña que dice "Body" y seleccionamos la opción de "form-data", las credenciales serán las siguientes:
		* "email" aquí se escribe el correo electrónico que se registró anteriormente
		* "password" aquí se escribe la contraseña
	* A momento de que se inicia sesión en la respuesta de la petición se devuelven varios parametros dentro de los cuales se encuentra el Token (tiene por nombre Access Token) que se usará para acceder a las distintas partes del sistema (anexo imagen):
	    * ![image](https://user-images.githubusercontent.com/18290558/114448898-c0178300-9b99-11eb-80f3-7ee62e974059.png)

## Probar la API para la funcionalidad de inmuebles

* Requisitos
	* Haber iniciado sesión previamente con tu email y contraseña
	* Tener el token generado al momento de iniciar sesión
* Procedimiento
	* Obtener Inmuebles:

		* Estando en la aplicación Postman especificamos el envío de tipo **GET** y la dirección url a utilizar será **"http://localhost:8000/api/inmueble"**. Nos ubicaremos en la pestaña de "Headers o Cabeceras", crearemos una nueva, en la columna *KEY* escribiremos la palabra **Authorization** y en la columna *VALUE* escribiremos la palabra **Bearer**, un espacio y pegaremos el token que obtuvimos al iniciar sesión "Bearer (token)" **(Anexo imagen)**. Al enviar la petición obtendremos como respuesta un JSON con los inmuebles asociados al usuario.
		* NOTA: Si envías la petición sin haber puesto el token, te devolvera una respuesta de **Unauthorized**
		*  ![image](https://user-images.githubusercontent.com/18290558/114449058-f2c17b80-9b99-11eb-884d-848629f17b06.png)
	
    * Crear un nuevo inmueble
    	* El tipo de envío que utilizaremos será **POST** y la dirección url a utilizar será **"localhost:8000/api/inmueble"**. Aquí vamos a utilizar 3 parametros los cuales son:
    		* nombre_inmueble
    		* direccion
    		* idUsuario
    		* token
    	* Los 3 primeros los enviaremos a través de la pestaña *Params*, en la columna *KEY* escribiremos el nombre de cada parametro en una fila cada uno, en la columna *VALUE* el valor correspondiente a cada parametro, **OJO**: el parametro de idUsuario debe de ser el ID de un usuario existente en la base de datos. El parametro de **token** se enviará de la misma forma que en la petición de *Obtener Inmuebles* (Anexo imagen). Al enviar la petición nos devolverá como respuesta un JSON con un SUCCESS y el mensaje de Creado con éxito.
    	* ![image](https://user-images.githubusercontent.com/18290558/114449267-2b615500-9b9a-11eb-8c78-5e913530dc41.png)

     * Eliminar un inmueble

     	* El tipo de envío que utilizaremos será **DELETE** y la dirección url a utilizar será **"localhost:8000/api/inmueble/{id}"**. En esta petición de igual manera se utilizará el **token** el cual se va a enviar como *Header* al igual que en las peticiones anteriores. En esta petición el único parametro que enviaremos será el ID del inmueble que queremos eliminar, pero este se enviará directamente en la URL **(Anexo imagen)**.
     	* ![image](https://user-images.githubusercontent.com/18290558/114449382-4a5fe700-9b9a-11eb-8bcd-b70b7b2e89c1.png)

