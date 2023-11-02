# Meme Generator

Este proyecto es una aplicación de Generador de Memes que permite a los usuarios crear memes, almacenarlos en una base de datos o descargarlos. Los memes generados se mostrarán en una vista de galería al acceder a la aplicación. Fue desarrollado como parte del proceso de selección para el puesto de Desarrollador Junior en Unnaki, utilizando principalmente Laravel y Postgres.

## Demostración de Características

A continuación se muestran GIFs que ilustran las principales funcionalidades de la aplicación de generación de memes:

1. **Imagen Adaptable**

![Imagen adaptable](https://github.com/canteroaa/gestionproyectos/assets/111013326/ac5013f8-90ce-4ce2-b6fe-35aeaf72169a)

2. **Texto Personalizable y Editable**

![Texto personalizable y editable](https://github.com/canteroaa/gestionproyectos/assets/111013326/5ade5fa0-7547-4a91-80fb-8d92d968884e)

3. **Modo de Dibujo y Formas**

![Modo de dibujo y formas](https://github.com/canteroaa/gestionproyectos/assets/111013326/ca13c74b-8b7b-4850-892f-e33c79a6b555)

4. **Descarga y Almacenamiento de Memes**

![Desacargar Meme o Guardarlo en la BD](https://github.com/canteroaa/gestionproyectos/assets/111013326/9d33833b-dcb3-4379-9bcf-1e8f2cdd3541)


5. **Visualización en la Galería**

![Visualización en Galería](https://github.com/canteroaa/gestionproyectos/assets/111013326/d4d7390c-1e55-482e-83bc-f4ae5e12b97a)

Cada GIF representa una característica clave de la aplicación y demuestra su funcionalidad de manera concisa.

## Características

- **Creación de Memes:** Los usuarios pueden generar memes personalizados utilizando una interfaz fácil e intuitiva de usar.
- **Almacenamiento:** Se utiliza PostgreSQL para la gestión de la base de datos, asegurando un almacenamiento confiable.
- **Exploración:** Posibilidad de explorar la galería de memes que fueron generados y guardados en la base de datos.
- **Descarga:** Funcionalidad que permite a los usuarios descargar los memes generados para compartirlos donde deseen.
- **Eliminación:** Permite a los usuarios borrar los memes de la galería.

##  Tecnologías y Librerías  Utilizadas 

- **Laravel:** Framework de desarrollo web en PHP.
- **PostgreSQL:** Sistema de gestión de base de datos relacional.
- **Vue:** Framework progresivo de JavaScript para la construcción de interfaces de usuario en el lado del cliente.
- **InertiaJS:** Biblioteca que permite a Vue.js trabajar sin problemas con aplicaciones de servidor renderizadas. Facilita la comunicación entre el frontend Vue.js y el backend Laravel.
- **Fabric.js:** Biblioteca de JavaScript para la manipulación de gráficos y la edición de imágenes en tiempo real en el navegador.

## Instalación

Para ejecutar este proyecto localmente, sigue estos pasos:

1. **Clona este repositorio:**
    ```bash
    git clone https://github.com/canteroaa/memegenerator.git
    ```

2. **Instala las dependencias del proyecto:**
    ```bash
    composer install
    ```

3. **Instala las dependencias del lado del cliente:**
    ```bash
    npm install
    ```

4. **Genera la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```

5. **Configura el archivo `.env`:**

   Configura los datos de tu base de datos **PostgreSQL** en el archivo `.env`.

6. **Ejecuta las migraciones para crear la estructura de la base de datos:**
    ```bash
    php artisan migrate
    ```

7. **Inicia el servidor local:**
    ```bash
    php artisan serve
    ```

## Contacto

Si tenés consultas adicionales, no dudes en contactarme:

- **Correo Electrónico:** [ocampocanteroaaron@fpuna.edu.py](mailto:ocampocanteroaaron@fpuna.edu.py)
- **LinkedIn:** [linkedin.com/in/canteroaa/](https://www.linkedin.com/in/canteroaa/)

¡Estoy emocionado por compartir más detalles sobre el proyecto y estoy abierto a cualquier pregunta o discusión adicional! No dudes en contactarme por cualquiera de los medios mencionados anteriormente.
