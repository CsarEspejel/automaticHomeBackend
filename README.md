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
        * ![image](https://user-images.githubusercontent.com/18290558/109432392-849d6c80-79d0-11eb-97da-146beebeb389.png)

		* "rol" sólo puede ser 1 (Para especificar un administrador) o 2 (Para especificar un invitado)
		* "name, email y password" son obligatorios y pueden ser datos cualesquiera
		* "phone" puede ser opcional (10 dígitos)
		* "email_master" este parametro es opcional y se usa cuando el rol es de invitado, así especificando al usuario administrador al que pertenece, si se selecciona un rol de tipo administrador este campo se debe dejar vacío
		* NOTA: para poder registrar un usuario la tabla de "roles" debe de contener los dos registros correspondientes, esto se puede hacer desde phpmyadmin (o tu gestor de base de datos), en una actualización se añadirá un Seeder para rellenar esta tabla automaticamente.
		* NOTA 2: en todas las peticiones en la pestaña de "Headers" agregaremos uno nuevo el cual su key será "Accept" y su value será "application/json", esto para que las respuestas nos las devuelva en formato Json.

	* Para la acción de iniciar sesión, igualmente dentro de postman especificamos un envío de tipo "POST" y la dirección a utilizar será "localhost:8000/api/login", nos movemos a la pestaña que dice "Body" y seleccionamos la opción de "form-data", las credenciales serán las siguientes (anexo imagen):
        * ![image](https://user-images.githubusercontent.com/18290558/109432417-aac30c80-79d0-11eb-8f95-35761145a0be.png)
		* "username" aquí se escribe el correo electrónico que se registró anteriormente
		* "password" aquí se escribe la contraseña
	* A momento de que se inicia sesión en la respuesta de la petición se devuelven varios parametros dentro de los cuales se encuentra el Token (tiene por nombre Access Token) que se usará para acceder a las distintas partes del sistema (anexo imagen), para verificar su función podemos hacer lo siguiente:
	    * ![image](https://user-images.githubusercontent.com/18290558/109432432-c8907180-79d0-11eb-9d6d-193956e13250.png)
		* Estando en la aplicación Postman especificamos el envío de tipo "GET" y la dirección url a utilizar será "http://localhost:8000/api/usuario" y enviar la petición, si todo va bien veremos como respuesta la palabra "unauthorized", para cambiar esto nos moveremos a la pestaña "Authorization", en el tipo selecciona "Bearer Token" y en el campo introduciremos el token que nos devolvío la petición de Inicio de Sesión y volvemos a enviar la petición, de modo que ahora estamos autenticados y nos deverá de devolver la información de los usuarios registrados.
