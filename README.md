# PROYECTO_VETHACHE
TFG DAW 2º CURSO Helena Fuentenebro Delgado
# VETHACHE - Ecosistema Digital de Gestión Veterinaria Híbrida

Vethache es una plataforma web modular diseñada para optimizar la gestión clínica presencial y la atención remota de pacientes veterinarios. El sistema integra un tarificador dinámico de planes de salud y un módulo asíncrono para la gestión reactiva de citas y triaje de urgencias.

## 🚀 Características Principales
* **Triaje Inteligente (CU-01):** Algoritmo en JavaScript para la evaluación de síntomas en tiempo real.
* **Gestión Asíncrona (CU-02):** Sistema de comunicación y envío de formularios mediante Fetch API y persistencia en servidor PHP.
* **Diseño Adaptativo:** Interfaz Mobile-First optimizada para intervenciones rápidas desde smartphones.

## 🛠️ Stack Tecnológico (LAMP)
* **Frontend:** HTML5 Semántico, CSS3 (Flexbox/Variables nativas), JavaScript ES6+.
* **Backend:** PHP 8 (Arquitectura modular).
* **Persistencia:** MySQL (Gestión relacional mediante PDO para mitigar inyecciones SQL).
* **Servidor Local:** Apache integrado a través de entorno XAMPP.
* **Mensajería:** Protocolo de correo SMTP gestionado con PHPMailer.

## 📋 Requisitos Previos e Instalación
Para desplegar un entorno de desarrollo local, asegúrese de cumplir con los siguientes requisitos:
1. XAMPP (con soporte para PHP 8.0 o superior).
2. Gestor de base de datos compatible con MySQL/MariaDB.

### Pasos para la Configuración Local:
1. Clone este repositorio en el directorio raíz de su servidor local (ej. `htdocs` en XAMPP):
   ```bash
   git clone [https://github.com/vethache-dev/vethache.git](https://github.com/vethache-dev/vethache.git)

Acceda a su panel de phpMyAdmin y cree una base de datos limpia con el nombre vethache_db.

Importe el esquema relacional inicial ubicado en la carpeta de base de datos del proyecto: vethache/db/db_schema.sql

Ajuste las credenciales de conexión al servidor y los parámetros del servidor de correo SMTP en el archivo de configuración global:

Bash
vethache/config/config.php
Inicie los servicios de Apache y MySQL desde su panel de control local y acceda a la plataforma mediante la URL: http://localhost/vethache.

⚙️ Pruebas y Validación (QA)
Para validar la integridad del sistema, ejecute la suite de pruebas de caja negra y compatibilidad multi-dispositivo detallada en la memoria técnica:

Bash
# Validación de la persistencia de datos local
php backend/tests/DbConnectionTest.php
📄 Licencia
Este proyecto ha sido desarrollado exclusivamente con fines académicos como Trabajo de Fin de Grado (TFG) para el Ciclo Formativo de Grado Superior en Desarrollo de Aplicaciones Web (DAW), año 2026.


---

## 4.8. Estrategia de Control de Versiones (GIT)

Para garantizar la trazabilidad del desarrollo, asegurar el código ante posibles fallos y permitir una auditoría técnica transparente por parte del tribunal, se ha empleado la herramienta de control de versiones **Git** sincronizada con un repositorio remoto privado.

La gestión del repositorio se ha estructurado bajo una metodología simplificada basada en **Git Flow**, adaptada estrictamente al flujo de trabajo individual y vinculada de manera directa con los hitos temporales establecidos en el diagrama de Gantt del proyecto.

### 4.8.1. Estructura de Ramas (*Branching Strategy*)
Se han establecido dos ramas principales de desarrollo para segmentar el código estable del código en fase de producción:
* **Rama `main` (Producción):** Contiene exclusivamente el código fuente completamente depurado, testeado en entornos multi-dispositivo y listo para su despliegue final en el servidor de alojamiento real. Cada fusión en esta rama representa un hito clave del TFG.
* **Rama `develop` (Desarrollo):** Funciona como el tronco de trabajo diario. En ella se han integrado de forma progresiva los diferentes componentes interactivos, módulos de backend PHP y formularios asíncronos antes de ser validados por las pruebas de QA.

### 4.8.2. Historial de Commits y Etiquetas (*Tags*) Significativas
Con el propósito de mantener un registro limpio y contrastable, cada confirmación de código (*commit*) ha seguido una nomenclatura descriptiva asociada a los requisitos funcionales. Se han establecido **etiquetas de versión (*tags*)** inmutables para marcar la consecución de los grandes bloques de la planificación:

1. **`git tag v0.1.0-alpha` (Hito de Análisis e Infraestructura Base):** * *Fecha asociada en Gantt:* Octubre 2025.
   * *Contenido:* Confirmación del esquema relacional inicial (`db_schema.sql`), configuración del entorno local Apache/XAMPP y arquitectura de carpetas base del proyecto.
2. **`git tag v0.5.0-beta` (Hito de Diseño y Frontend Core):** * *Fecha asociada en Gantt:* Diciembre 2025.
   * *Contenido:* Maquetación completa de las interfaces en formato elástico (Desktop y Mobile-First), desarrollo del menú hamburguesa y resolución de la visualización de datos.
3. **`git tag v0.9.0-rc` (Hito de Integración de Componentes):** * *Fecha asociada en Gantt:* Abril 2026.
   * *Contenido:* Cierre del desarrollo de backend en PHP 8, pasarelas asíncronas con Fetch API y lógica del tarificador de planes de salud (Casos de Uso CU-01 y CU-02).
4. **`git tag v1.0.0-final-release` (Hito de Entrega):** * *Fecha asociada en Gantt:* Mayo 2026.
   * *Contenido:* Cierre de la suite de pruebas de caja negra, optimización final de rendimiento y metadatos SEO
