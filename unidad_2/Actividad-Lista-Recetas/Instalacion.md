#Recetario App
---

Tecnologías Utilizadas

Este proyecto utiliza:

* **Backend:** [Laravel](https://laravel.com/) (PHP 8.5)
* **Frontend:** [Inertia.js](https://inertiajs.com/) con [React](https://react.dev/) (TypeScript)
* **Estilos y Componentes:** [Tailwind CSS](https://tailwindcss.com/) y [@pikoloo/darwin-ui](https://github.com/)
* **Empaquetador:** [Vite](https://vitejs.dev/)
* **Base de Datos:** MySQL 8.4 
---
## Guía de Instalación 

Sigue estos pasos para clonar y poner en marcha el proyecto en tu máquina local:

1. **Clonar el repositorio:**
   ```bash
   git clone [https://github.com/tu-usuario/tu-repositorio.git](https://github.com/tu-usuario/tu-repositorio.git)
2. **Instalar dependencias de PHP:**
   ```bash
   composer install
3. **Configurar el entorno:**
   ```bash
   cp .env.example .env
  php artisan key:generate

  *Nota: En el .env en la variable SESSION_DRIVER = file
4. **Correr migraciones y seedeers**
  ```bash
   php artisan migrate:fresh --seed
5. **Instalar dependencias de Node.js**
  ```bash
  npm install
6. **Compilar assets**
  ```bash
  npm run dev
7. **Levantar servidor con artisan**
  ```bash```
  php artisan dev

  
  
  
