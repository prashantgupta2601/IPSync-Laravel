# 🚀 IPSync - Laravel Based Management System

A full-stack **Intellectual Property Facilitation Centre (IPFC) Management System** built using Laravel.  
This platform helps streamline IP-related processes, manage records, and improve operational efficiency.

---

## 📌 Features

- 🔐 User Authentication (Login / Register)
- 👨‍💼 Role-Based Access Control (Admin / User)
- 📂 IP Record Management System
- 📊 Dashboard with Insights
- 📝 Form Handling & Data Validation
- ⚡ Fast & Scalable Backend APIs
- 🗃️ MySQL Database Integration

---

## 🛠️ Tech Stack

- **Backend:** Laravel (PHP)
- **Frontend:** Blade / HTML / CSS / JavaScript
- **Database:** MySQL
- **Version Control:** Git & GitHub

---

## 📂 Project Structure
IPSync-Laravel/
│── app/
│── routes/
│── resources/
│── database/
│── public/
│── .env.example
│── composer.json


# IP Management System - How to Run

Here are the steps to follow once the setup is complete:

1. **Install PHP and Node dependencies**:
   ```bash
   composer install
   npm install
   ```
2. **Setup your environment**:
   Make sure to have your MySQL server running. The project is configured to use the `ipf_laravel` database on `127.0.0.1:3306` with user `root` and no password.
3. **Generate App Key and Migrate**:
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
4. **Run the Development Servers**:
   You need two terminal windows:
   ```bash
   # Terminal 1: Run the backend
   php artisan serve
   ```
   ```bash
   # Terminal 2: Run the frontend toolchain
   npm run dev
   ```

You can then access the project at `http://127.0.0.1:8000`.
