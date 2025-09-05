# 📚 Sistema de Biblioteca (CodeIgniter 4)

Aplicación web desarrollada en **PHP 8.1+** con el framework **CodeIgniter 4**, orientada a la gestión de una biblioteca.  
El sistema actualmente permite administrar libros mediante operaciones CRUD y cuenta con la base estructurada para el área de gestión de personas.

---

## 🚀 Funcionalidades Implementadas

### 📖 Módulo de Libros
- Registro de libros (alta)
- Edición de datos de un libro
- Eliminación de registros
- Listado de todos los libros

### 👥 Módulo de Personas (en progreso)
- Controlador y modelo iniciales
- Preparación para CRUD de usuarios/lectores

---

## 🛠️ Tecnologías y Dependencias
- **PHP 8.1+**  
- **CodeIgniter 4** (App Starter)  
- **Composer** (gestión de dependencias)  
- **MySQL/MariaDB** (base de datos)  

---

## 📂 Estructura Principal del Proyecto
- `app/Controllers` → Lógica de negocio (ej: `LibroController`, `PersonaController`)  
- `app/Models` → Acceso a base de datos (`LibroModel`, `PersonaModel`)  
- `app/Views` → Interfaces de usuario (formularios, listados, etc.)  
- `public/` → Carpeta pública (punto de entrada `index.php`)  
- `writable/` → Archivos de logs, sesiones, caché  

---

## ⚙️ Requisitos del Servidor
- PHP 8.1 o superior  
- Extensiones: `intl`, `mbstring`, `json`, `mysqlnd`, `libcurl`  
- Servidor web configurado para apuntar a la carpeta **public/**