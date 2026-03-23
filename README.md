# IP Management System - How to Run

Since you asked how to run the project, here are the steps to follow once the setup is complete:

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
