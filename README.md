# 📚 Sistema de Gestión de Recursos

Aplicación para la gestión de recursos académicos (libros físicos y digitales), organizada en **categorías, subcategorías y editoriales**, con funcionalidades de registro, edición, listado y administración.

---
## ⚠️ Advertencia sobre actualizaciones

Durante el desarrollo, se han identificado **problemas al subir actualizaciones a GitHub**.  

**Nota:**  
- No se está del todo seguro de que se haya subido correctamente la segunda parte.

---

## 🗄️ Estructura de Base de Datos

### Categorías
- Matemáticas  
- Comunicación  
- Computación  

### Subcategorías
- **Matemáticas** → Razonamiento Lógico Matemático, Álgebra, Trigonometría  
- **Comunicación** → Razonamiento Verbal, Composición, Redacción  
- **Computación** → Base de Datos, Sistemas Operativos, Lenguajes de Programación  

### Editoriales
- Nombre de la empresa editorial  
- Nacionalidad que conserva los derechos del material/libro  

### Recursos (tabla principal)

| Campo        | Tipo    | Descripción |
|--------------|---------|-------------|
| `idrecurso`  | INT PK AI | Identificador del recurso |
| `idsubcategoria` | FK | Relación con la subcategoría |
| `ideditorial` | FK | Relación con la editorial |
| `tipo` | ENUM (Físico/Digital) | Tipo de recurso |
| `titulo` | VARCHAR | Nombre o descripción |
| `apublicacion` | YEAR | Año de publicación |
| `isbn` | VARCHAR | Código internacional del libro |
| `numpaginas` | INT | Número de páginas |
| `rutaportada` | VARCHAR | Ruta de la imagen de portada |
| `rutarecurso` | VARCHAR | Ruta del archivo PDF si es digital |
| `estado` | ENUM (Bueno/Regular/Malo) | Estado del recurso |
| `creado` | DATETIME | Fecha de creación |
| `modificado` | DATETIME | Fecha de última modificación |

---

## 👁️ Vistas

1. **Listar recursos**  
   - JOIN con Editorial, Categoría y Subcategoría.  
   - Presenta la información en una tabla.

2. **Registrar recurso**  
   - Uso de `async/await` y `SweetAlert2` para confirmación.  
   - Validaciones de campos obligatorios.  
   - Notificación *toast* al guardar.  

3. **Editar recurso**  
   - Confirmación previa antes de actualizar.  
   - Notificación *toast* de éxito.  

---

## 🛠️ Tecnologías utilizadas

- **Backend**: PHP (CodeIgniter u otro framework similar)  
- **Frontend**: Bootstrap 5, SweetAlert2  
- **Base de Datos**: MySQL/MariaDB  

---
