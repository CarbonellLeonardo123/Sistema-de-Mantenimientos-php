# Sistema de Gestión de Mantenimientos

Sistema web desarrollado en PHP que permite el registro y control de mantenimientos, basado en un caso práctico de la empresa Promart. Incluye conexión a base de datos MySQL y generación de reportes en PDF.

## Tecnologías utilizadas

- **Lenguaje:** PHP
- **Frontend:** HTML, CSS, JavaScript
- **Base de datos:** MySQL
- **Servidor local:** XAMPP
- **Reportes:** Librería FPDF
- **Entorno de desarrollo:** Visual Studio Code
- **Publicación temporal para pruebas:** Ngrok

## Funcionalidades

- Inicio de sesión y cierre de sesión de usuarios
- Menú de navegación del sistema
- Registro y control de mantenimientos
- Generación de reportes en formato PDF
- Conexión a base de datos MySQL para el registro y consulta de información

## Modelado

El sistema fue diseñado utilizando diagramas UML previos al desarrollo, para planificar la estructura y el flujo de la aplicación antes de programar.

## Estructura del proyecto

- `config/` — Configuración de conexión a la base de datos
- `css/` — Estilos del sistema
- `js/` — Scripts del lado del cliente
- `mantenimientos/` — Módulo principal de gestión de mantenimientos
- `informes/` — Módulo de generación de reportes
- `manual/` — Documentación del sistema
- `SQL/` — Script de la base de datos

## Cómo ejecutar el proyecto

1. Clonar este repositorio dentro de la carpeta `htdocs` de XAMPP
2. Iniciar los servicios de Apache y MySQL desde el panel de control de XAMPP
3. Importar el archivo de la carpeta `SQL/` en phpMyAdmin para crear la base de datos
4. Configurar los datos de conexión en la carpeta `config/`
5. Acceder al sistema desde el navegador en `localhost/Sistema-de-Mantenimientos-php`

## Autor

Leonardo Diego Carbonell Lopez — Estudiante de Ingeniería de Software con IA, SENATI
