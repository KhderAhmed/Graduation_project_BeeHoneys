# 🐝 BeeHoney

### An AI-Driven E-Commerce and Trading Platform

BeeHoney is an integrated digital platform designed for the **e-commerce and management of honey and beekeeping products**.

The platform combines e-commerce features, user management, administrative dashboards, beekeeper services, and an AI-powered question-answering system to provide an interactive digital environment for customers, beekeepers, and administrators.

> 🎓 Graduation Project — Information Technology Engineering
> Tartous University — Faculty of Information and Communication Technology Engineering
> Academic Year: 2025–2026

---

## 📌 Project Overview

BeeHoney is developed as a specialized **B2C e-commerce and information platform** for the honey and beekeeping sector.

The system provides:

* 🛒 E-commerce and shopping cart management.
* 🍯 Buying and selling different honey products.
* 🐝 Beekeeping and bee-related products.
* 👤 User and subscriber management.
* 🧑‍🌾 Dedicated beekeeper interaction.
* 🛠️ Advanced administration dashboards.
* 📦 Product preparation and shipping management.
* 💬 Interactive communication and question answering.
* 🤖 AI-powered intelligent question answering.
* 🔐 Authentication and security mechanisms.
* 📄 PDF document generation.
* 🌐 Responsive and interactive web interfaces.

The project documentation describes the system as an integrated commercial information system containing multiple subsystems for shopping, subscribers, administration, and intelligent interaction.

---

## ✨ Main Features

### 👤 User Interface

The user interface allows customers to:

* Browse available products.
* View honey and beekeeping products.
* Add products to the shopping cart.
* Manage shopping operations.
* Interact with the platform.
* Ask questions related to honey and bees.
* Receive intelligent answers from the AI system.

---

### 🧑‍🌾 Beekeeper Interface

The platform provides a dedicated interface for beekeepers who want to interact with the platform and benefit from its services.

The project documentation identifies three main interfaces:

1. **User**
2. **Admin**
3. **Beekeeper**

---

### 🛠️ Admin Dashboard

The administration system provides tools for managing the platform and its users.

Main responsibilities include:

* Product management.
* User/subscriber management.
* Orders and shopping operations.
* Preparing and shipping orders.
* Platform administration.
* Dashboard and data management.

---

## 🤖 Artificial Intelligence

BeeHoney integrates an AI-powered question-answering system based on **BERT / Transformers** and a Python processing environment.

The AI subsystem works independently from the Laravel application and communicates with it as a separate processing component.

### AI Processing Pipeline

```text
User Question
      ↓
Laravel / AI Controller
      ↓
Cache Check
      ↓
Python AI Engine
      ↓
Language Detection
      ↓
Dataset / Knowledge Base
      ↓
BERT Embeddings
      ↓
Cosine Similarity
      ↓
Answer / Suggested Question
      ↓
Cache
      ↓
User Interface
```

The documented architecture separates Laravel, which handles the web application, authentication, database, and request flow, from the AI engine responsible for semantic analysis and returning the appropriate result.

The documented AI workflow includes language detection, reading the local JSON dataset, generating embeddings, calculating cosine similarity, and caching the result for subsequent requests.

---

## 🏗️ Architecture

The application follows a structured web architecture based on **MVC** and separation of concerns.

Main Laravel components include:

* **Models** — Data and business-related database representation.
* **Controllers** — Request processing and application logic.
* **Routes** — URL and request routing.
* **Middleware** — Authentication, authorization, and request filtering.
* **Migrations** — Database schema versioning.
* **Services** — Isolated business logic.
* **Livewire Components** — Interactive web components.
* **Blade Views** — User interface rendering.

The documented architecture describes Laravel's Model, Controller, Route, Middleware, Migration, Components, Services, and IoC/Dependency Injection mechanisms.

---

## 🧰 Technology Stack

### Backend

* **PHP**
* **Laravel 12**
* **Eloquent ORM**
* **Livewire**
* **Filament**

Laravel 12 is the main backend framework used to implement the application's MVC architecture, routing, database interaction, authentication, and application logic.

### Frontend

* **Blade**
* **Tailwind CSS**
* **HTML**
* **CSS**
* **JavaScript**
* **Vite**

Tailwind CSS is used to build responsive and interactive user interfaces, while Vite handles frontend development and asset compilation.

### Database

* **SQLite**
* **Eloquent ORM**
* **Laravel Migrations**

SQLite was selected as the project's database because of its serverless architecture, portability, self-contained database file, and ACID support.

### Administration

* **Filament**

Filament is used to build the administrative interface, including forms, tables, CRUD operations, filtering, dashboards, and interactive administration components.

### AI

* **Python**
* **BERT**
* **Transformers**
* **JSON Dataset**
* **Cosine Similarity**

The project uses Python as the AI processing environment and integrates the AI engine with Laravel.

### PDF

* **mPDF**

The documentation describes mPDF as the PDF generation library used for converting HTML/CSS content into PDF documents with support for Arabic and RTL content.

---

## 🗄️ Database Architecture

The project uses **SQLite** as a serverless relational database.

Database schema management is handled through Laravel Migrations, allowing the database structure to be maintained and versioned through code.

```text
Laravel Application
       │
       ▼
Eloquent ORM
       │
       ▼
SQLite Database
       │
       ├── Users
       ├── Products
       ├── Orders
       ├── Cart
       └── Other Application Data
```

The documented implementation uses Eloquent ORM together with SQLite and Laravel Migrations to maintain database consistency and portability.

---

## 🔐 Security

The application includes several security mechanisms provided through Laravel and the implemented system architecture, including:

* Authentication.
* Authorization.
* Session management.
* CSRF protection.
* Password hashing.
* Middleware-based access control.
* CAPTCHA protection.
* Environment-based configuration.

The project documentation specifically discusses CAPTCHA and session-based protection as a mechanism for reducing automated malicious requests targeting backend resources and the AI engine.

---

## ⚡ Installation

### Requirements

Before running the project, make sure the following are installed:

* PHP
* Composer
* Node.js
* NPM
* Python
* SQLite

---

### 1. Clone the Repository

```bash
git clone https://github.com/KhderAhmed/Graduation_project_BeeHoneys.git
cd Graduation_project_BeeHoneys
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Frontend Dependencies

```bash
npm install
```

The project documentation specifies installing the frontend packages using `npm install`.

### 4. Configure Environment

Create your environment file:

```bash
cp .env.example .env
```

On Windows:

```cmd
copy .env.example .env
```

Configure the database and other environment variables inside `.env`.

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Run Database Migrations and Seeders

```bash
php artisan migrate --seed
```

These commands are also specified in the project's documented operating procedure.

### 7. Start Vite

```bash
npm run dev
```

Vite is responsible for monitoring and compiling the frontend assets during development.

### 8. Start Laravel Server

Open another terminal and run:

```bash
php artisan serve
```

The documented project startup procedure uses `php artisan serve` to launch the local PHP web server.

---

## 🚀 Running the Project

After starting the application, access the local Laravel server through the URL displayed by:

```bash
php artisan serve
```

Keep Vite running during development:

```bash
npm run dev
```

---

## 📁 Project Structure

```text
BeeHoney/
│
├── app/
│   ├── Http/
│   ├── Livewire/
│   ├── Models/
│   └── Services/
│
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
│
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
├── storage/
├── tests/
│
├── .env.example
├── artisan
├── composer.json
├── package.json
└── README.md
```

---

## 🔄 Development Methodology

The project was developed using the **Agile methodology**, which was selected because of the project's iterative nature and its need for continuous testing and interaction between users and the AI system.

---

## 🎯 Project Goals

BeeHoney aims to:

* Digitize aspects of the honey and beekeeping sector.
* Provide a specialized e-commerce environment.
* Facilitate buying and selling honey and bee-related products.
* Improve interaction between customers and beekeepers.
* Provide centralized administration.
* Provide intelligent answers to user questions.
* Reduce response time through AI processing and caching.
* Provide a modern and interactive user experience.

---

## 📚 Documentation

The full academic documentation of the project covers:

* Web application concepts.
* Technologies and programming languages.
* Laravel architecture.
* Tailwind CSS.
* Filament.
* Livewire.
* mPDF.
* Transformers and BERT.
* System architecture.
* Database design.
* System interfaces.
* Operating procedures.
* Challenges and recommendations.

---

## 👨‍💻 Project Team

**BeeHoney Graduation Project — Information Technology Engineering**

* Khder Jaber Ahmed

**Supervisor:**
Dr. Engineer Ragheb Othman

**Tartous University**
Faculty of Information and Communication Technology Engineering
Information Technology Engineering Department
**2025–2026**

---

## 📄 License

This project was developed as an academic graduation project.

Please contact the project authors before reusing, distributing, or commercially using the source code.
