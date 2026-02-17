# 🚀 Smart AI Task Manager (LaraFlow AI ) (Laravel 12 + Gemini)

A modern **Project & Task Management Dashboard** built with **Laravel 12**, styled using **Tailwind CSS**, and enhanced with **Google Gemini AI** for smart task generation and improvement.

This project demonstrates real-world Laravel architecture combined with AI-powered productivity features.

---

## ✨ Features

### 📁 Project Management

-   Create, edit, delete projects
-   Soft delete support (Trash system)
-   Status tracking
-   Pagination workspace

### ✅ Task Management

-   Add tasks inside projects
-   Completion tracking
-   Progress visualization
-   Task summaries

### 🤖 AI Integration (Gemini 2.5 Flash)

-   Generate smart tasks automatically
-   Improve task descriptions using AI
-   Backend AI workflow integration

### 🗑 Trash Manager

-   Organized soft-deleted projects & tasks
-   Separate empty states

### 🎨 UI / UX

-   Tailwind dashboard layout
-   Responsive interface
-   Smooth interactions

---

## 🛠 Tech Stack

-   **Framework:** Laravel 12
-   **PHP:** 8.2+
-   **Frontend:** Blade + Tailwind CSS
-   **Authentication:** Laravel Breeze
-   **AI Engine:** Google Gemini 2.5 Flash
-   **Database:** MySQL
-   **Architecture:** MVC

---

## 📦 Installation Guide

### 1️⃣ Clone Repository

```bash
git clone https://github.com/khushboo-muliyana/smart-task-manager.git
cd smart-task-manager
```

---

### 2️⃣ Install PHP Dependencies

```bash
composer install
```

---

### 3️⃣ Install Breeze Authentication

```bash
composer require laravel/breeze --dev
php artisan breeze:install
```

---

### 4️⃣ Frontend Setup

```bash
npm install
npm run build
```

---

### 5️⃣ Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with database credentials.

---

### 6️⃣ Database Migration

```bash
php artisan migrate
```

---

### 7️⃣ Install Gemini AI

This project uses **Gemini 2.5 Flash** via Laravel integration.

```bash
php artisan gemini:install
```

Add your Gemini API key inside `.env`:

```
GEMINI_API_KEY=your_api_key_here
```

---

### 8️⃣ Run Development Server

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

## 🧠 AI Workflow

-   AI buttons trigger backend Gemini requests
-   Tasks are generated or improved
-   Results saved to database
-   Designed to simulate real productivity tools

## 🤝 Contribution

Fork and enhance freely. Suggestions welcome!

---

## 📜 License

MIT — open for learning and experimentation.

---

## 🚀 Project Status

✅ Core features complete
🔧 Ready for expansion

---

**Built to explore modern Laravel + AI productivity workflows.**
