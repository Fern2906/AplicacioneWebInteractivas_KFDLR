# Recetario App

Actividad 2

## Tecnologías utilizadas

Este proyecto utiliza:

* **Backend:** [Laravel](https://laravel.com/) (PHP 8.5)
* **Frontend:** [Inertia.js](https://inertiajs.com/) con [React](https://react.dev/) y TypeScript
* **Estilos y componentes:** [Tailwind CSS](https://tailwindcss.com/) y [Darwin UI](https://github.com/pikoloo/darwin-ui)
* **Empaquetador:** [Vite](https://vitejs.dev/)
* **Base de datos:** MySQL 8.4

## Guía de instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/tu-repositorio.git
cd tu-repositorio
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Configurar el entorno

Copia el archivo `.env.example` y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

> **Nota:** En el archivo `.env`, asegúrate de configurar:
>
> ```env
> SESSION_DRIVER=file
> ```

### 4. Ejecutar migraciones y seeders

Para crear las tablas y cargar los datos iniciales:

```bash
php artisan migrate:fresh --seed
```

> **Advertencia:** `migrate:fresh` elimina todas las tablas existentes de la base de datos antes de ejecutar las migraciones.

### 5. Instalar dependencias de Node.js

```bash
npm install
```

### 6. Compilar los assets

Durante el desarrollo, utiliza:

```bash
npm run dev
```

### 7. Levantar el servidor

En otra terminal, ejecuta:

```bash
php artisan serve
```

La aplicación estará disponible normalmente en:

```text
http://127.0.0.1:8000
```

