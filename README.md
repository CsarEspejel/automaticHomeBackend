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
	* Desde la cmd ubicados dentro de la carpeta del proyecto ejecutar el comando "composer install"
	* Clonar contenido del archivo ".env.example" haciendo uso del comando "cp .env.example .env"
	* Generamos la APP_KEY con el comando "php artisan key:generate"
4. Prueba
	* Probamos que el proyecto se ejecute correctamente
		* Desde el cmd ejecuta el comando "php artisan serve"
		* Abre el navegador y escribe la dirección "localhost:8000"

## Uso de las ramas

Ya teniendo instalado el proyecto se van a crear ramas alternas para la realización de las distintas funcionalidades de la aplicación.  
Ejemplo: Si vas a realizar la funcionalidad de Dispositivos, va a crear la rama "dispositivos".