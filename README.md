# DrPet - SSPIS (Secure Software Pet's Integral System)

![](public/img/DrPetLogo.png)

---

## ¿Qué es Dr. Pet - SSPIS?

DrPet es una aplicación web que permite gestionar los elementos básicos de una veterinaria. Es un gestor de uso interno, por lo que ningun usuario ajeno al negocio podrá tener acceso a información sensible para este. Por otro lado, para promover el negocio, cualquier usuario podrá acceder a la landing page de este. Dentro del sistema se pueden gestioanr las mascotas atendidas en la veterinaria asi como asignarles tratamientos, también se puede gestionar el inventario de la veterinaria, gestionar los tratamientos disponibles para las mascotas y como un añadido extra, se puede llevar un control de mascotas disponibles para adoción dentro de la propia veterinaria.

---
## Información del desarrollador

Alejandro Domínguez

---

## Consideraciones previas a la instalación

-Deberá tener instalado el software de Laragon. Si no lo tiene o nunca ha trabajado con este, entre al siguiente link: [Laragon.org](https://laragon.org/)

-Deberá contar con la versión 7.3.27 de PHP o alguna versión superior. (De preferencia la indicada para evitar conflictos de compatibilidad)

-Deberá tener instalada y configurada en la ruta "PATH" la versión de node 14.17.0 (o alguna otra versión reciente) puesto que pueden existir conflictos si se trabaja con la versión predterminada de Laragon.


## Instrucciones de instalación 

1. Clonar proyecto `https://github.com/AlexDominguez18/PPI-Proyecto-Final.git` en su carpeta de www.
2. Cambiarse a directorio correspondiente.
3. Instalar dependiencias mediante composer: `composer install`
4. Crear archivo de variables de entorno: `cp .env.example .env`
5. Crear llave: `php artisan key:generate`
6. Configurar nombre de base de datos en .env'
7. Configurar el apartado de correo en .env para poner sus datos de mailtrap o cualquier otro servicio que use.
8. Ejecutar las migraciones junto con el seeder para generar el usuario administrador y llenar las tablas necesarias: `php artisan migrate --seed`. 
9. Linkear storage con el public, para mostrar imágenes: `php artisan storage:link`

### Instrucciones para montar las vistas

- npm install.
- npm run dev.

## Para iniciar sesión con el usuario admin

Para poder a comenzar a utilizar el sistema, tendrá que logearse con las siguientes credenciales
- Correo: admin@drpet.com
- Contraseña: 1823admin


## Extra

- Si desea tener algunos dueños de prueba, existe una factory para ello. Ejecute el comando: `php artisan db:seed --class=OwnersTestSeeder`

---

## Herramientas de Desarrollo

- Laravel (v8)
- Bootstrap 4
- Plantilla SB-ADMIN-2

*Derechos reservados.*
