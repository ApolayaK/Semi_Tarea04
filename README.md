# 📚 Sistema de Biblioteca – CodeIgniter 4

Aplicación web desarrollada en **PHP 8.1+** con el framework **CodeIgniter 4**, enfocada en la **gestión de bibliotecas**.  
Inicialmente se implementó un CRUD de libros como prueba de concepto, y actualmente el proyecto se centra en estructurar y robustecer el área de **gestión de personas**.  

---

## 🚀 Avances Realizados

### 📖 Módulo de Libros (versión inicial)
- CRUD básico de libros (crear, editar, eliminar, listar).  
- Validaciones y conexión con base de datos.  

### 👥 Módulo de Personas (enfocado en esta fase)
- Creación del **PersonaController** y **PersonaModel**.  
- Estructura preparada para CRUD de usuarios/lectores.  
- Integración con vistas simples en CodeIgniter.  
- Configuración para extender las funcionalidades.  

---

## 📌 Desarrollo en la Rama `TASK4`

En esta fase, se incorporan **nuevas tablas** y la gestión de recursos de la biblioteca:

### 🗄️ Tablas por implementar
1. **Categorías**  
   - Matemáticas  
   - Comunicación  
   - Computación  

2. **Subcategorías**  
   - Matemáticas → Razonamiento Lógico Matemático, Álgebra, Trigonometría  
   - Comunicación → Razonamiento verbal, composición, redacción  
   - Computación → Base de datos, sistemas operativos, lenguajes de programación  

3. **Editoriales**  
   - Empresa propietaria  
   - Nacionalidad de la editorial  

4. **Recursos (tabla principal con vistas)**  
   - idrecurso (PK)  
   - idsubcategoria (FK)  
   - ideditorial (FK)  
   - tipo (Físico / Digital)  
   - título  
   - año de publicación  
   - ISBN  
   - número de páginas  
   - ruta portada (imagen)  
   - ruta recurso (PDF si es digital)  
   - estado (Bueno, Regular, Malo)  
   - creado / modificado  

---

## 🎨 Vistas a construir
- **Listar Recursos**  
  - JOIN con Editorial, Categoría y Subcategoría  
  - Presentación en tabla  
- **Registrar Recursos**  
  - Formularios con validaciones  
  - Manejo de alertas con **Toast** y **Sweet Alert**  
  - Uso de `async/await` para peticiones  

---

## 📊 Visualización de Tablas

![Diagrama de Tablas](./img/Modelo%20Tarea%2004%20-%20Biblioteca.png)

*(El diagrama refleja la relación entre Categorías, Subcategorías, Editoriales y Recursos)*

---

## 🛠️ Tecnologías Usadas
- **CodeIgniter 4 (PHP 8.1+)**  
- **MySQL/MariaDB**  
- **Composer**  
- **Bootstrap / JS (para vistas y validaciones)**  

---
> Proyecto académico en desarrollo, Apolaya Scharder Mariana.
