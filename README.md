# Meme Generator

Este proyecto es una aplicación de Generador de Memes que permite a los usuarios crear memes, almacenarlos en una base de datos o descargarlos. Los memes generados se mostrarán en una vista de galería al acceder a la aplicación. Fue desarrollado como parte del proceso de selección para el puesto de Desarrollador Junior en Unnaki, utilizando principalmente Laravel y Postgres.

## Demostración de Características

A continuación se muestran GIFs que ilustran las principales funcionalidades de la aplicación de generación de memes:

1. **Imagen Adaptable**

![1 15 fps](https://github.com/canteroaa/canteroaa/assets/111013326/c84ca538-f11f-48e3-88ff-d0f62da410d9)

2. **Texto Personalizable y Editable**

![2 15 fps](https://github.com/canteroaa/canteroaa/assets/111013326/09e5fe81-7ef2-4da5-8b1a-0ce292ad0717)

3. **Modo de Dibujo y Formas**

![3 15 fps](https://github.com/canteroaa/canteroaa/assets/111013326/149d1479-f75f-450d-b88e-81c21dde9dc8)

4. **Descarga y Almacenamiento de Memes**

![4 15fps](https://github.com/canteroaa/canteroaa/assets/111013326/915ad97b-86d0-4369-a996-824d04a36008)


5. **Visualización en la Galería**

![5 15fps](https://github.com/canteroaa/canteroaa/assets/111013326/9892ee89-39fd-4563-b28f-7710a3b36e67)

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
