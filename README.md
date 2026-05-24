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
