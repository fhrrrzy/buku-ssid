---
title: Introduction
icon: heroicon-o-book-open
---

## Introduction

Welcome to the documentation for our application. This guide will help you understand the features, structure, and usage of the app.

## Features

-   **User Management**: Manage users, roles, and permissions seamlessly.
-   **WiFi Management**: Keep track of WiFi devices, their configurations, and assignments.
-   **OPD & Bidang Structure**: Organize data efficiently within departments and sections.
-   **Filament Integration**: A powerful admin panel powered by Filament.
-   **Logging & Activity Tracking**: Monitor changes and actions in real-time.

## Getting Started

To get started with the application, ensure you have the following installed:

-   PHP > 8.3
-   Composer
-   Laravel 11.x
-   MySQL or PostgreSQL database
-   Node.js & NPM

### Installation

1. Clone the repository:

```bash
 git clone https://github.com/your-repo/your-app.git
 cd your-app
```

2. Install dependencies:

```bash
composer install
```

3. Set up environment variables:

```bash
cp .env.example .env
```

4. Generate application key:

```bash
php artisan key:generate
```

5. Run migrations and seed database:

```bash
php artisan migrate --seed
```

6. Install frontend dependencies:

```bash
npm install
```

7. Build frontend assets or start development server:

```bash
npm run build # For production
npm run dev # For development
```

8. Start the backend server:

```bash
php artisan serve
```

## Usage

### Admin Panel

Access the Filament admin panel via:

```bash
http://127.0.0.1:8000/admin
```

Use the default credentials (if applicable) or create an admin user.

### Managing WiFi Records

> ⚠️ **Warning:** Make sure that the name is unique!

1. Navigate to the **WiFi** section.
2. Add, edit, or delete WiFi devices.
3. Assign devices to OPD and Bidang.

## Clearing Cache & Maintenance

If you face any issues, try clearing cache:

```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear
```

## Conclusion

This documentation covers the essentials of our application. For further support, contact the development team or visit our repository.
