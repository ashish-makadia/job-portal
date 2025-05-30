# Laravel 12.x Web Application

This is a dynamic web application built with **Laravel 12.x**, leveraging **Blade templates**, **jQuery with AJAX**, and clean **HTML/CSS** for an interactive and responsive user experience.

## 🔧 Technologies Used

- **Backend:** PHP 8.2+, Laravel 12.x
- **Frontend Templating:** Blade (files)
- **Frontend Scripting:** jQuery + AJAX
- **Markup & Styling:** HTML5, CSS3 (optionally Bootstrap/Tailwind CSS)
- **Database:** MySQL/MariaDB
- **Version Control:** Git

---

## 📂 Features

- User Authentication (Login/Register)
- Role-based Access (Admin/User/Employer)
- Dynamic data handling with AJAX (no full-page reloads)
- Responsive UI with Blade, HTML 5, CSS 3 & Bootstrap5/tailwind CSS
- Admin, User & Employer Dashboard

---

## 🚀 Getting Started

### Prerequisites

- PHP >= 8.2+
- Composer
- MySQL or MariaDB
- Blade files (for frontend asset building)
- Git

---

### 🛠️ Installation

'''bash
Option 1:
# 1. Clone the repository
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name

Option 2:
# 1. Download the JobPoral.zip file 
- Extract it into your XAMPP/htdocs/<extract> | Wamp64 or wamp/www/<extract>
 
# 2. Install PHP dependencies
- composer global require laravel/installer
- composer require laravel/sanctum
- php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
- php artisan migrate

# 3. Copy and configure environment variables
cp .env.example .env
php artisan key:generate

# 4. Set up your database
# Edit the .env file and update DB credentials
php artisan migrate --seed || php artisan db:seed (if your database name match with .env file database name)

# 5. Start the development server
php artisan serve
