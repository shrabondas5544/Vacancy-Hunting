<p align="center">
  <img src="public/assets/images/VH%20logo.png" width="200" alt="Vacancy Hunting Logo">
</p>

<h1 align="center">Vacancy Hunting</h1>

<p align="center">
  <strong>A Modern Job Portal Platform Connecting Talent with Opportunity</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/Tailwind-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind CSS">
</p>

<p align="center">
  <img src="https://img.shields.io/badge/License-MIT-green.svg?style=flat-square" alt="License">
  <img src="https://img.shields.io/badge/Status-In%20Development-yellow?style=flat-square" alt="Status">
</p>

---

## 📋 Table of Contents

- [About](#-about)
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Database Structure](#-database-structure)
- [User Roles](#-user-roles)
- [Screenshots](#-screenshots)
- [Contributing](#-contributing)
- [License](#-license)

---

## 🎯 About

**Vacancy Hunting** is a comprehensive job portal platform built with Laravel, designed to bridge the gap between job seekers and employers. The platform provides an intuitive interface for candidates to showcase their skills and for employers to find the perfect talent for their organizations.

### 🌟 Why Vacancy Hunting?

- **Seamless Experience**: Modern, responsive UI with glassmorphism design
- **Role-Based Access**: Distinct portals for candidates, employers, and administrators
- **Comprehensive Profiles**: Rich profile features including education, experience, certifications, and portfolio
- **Blog Platform**: Share industry insights through the integrated blogging system
- **Admin Dashboard**: Complete control for administrators with approval workflows

---

## ✨ Features

### 👤 For Candidates
- **Rich Profile Management**
  - Professional summary & bio
  - Education history with timeline view
  - Work experience tracking
  - Skills & certifications showcase
  - Portfolio project gallery
  - Multiple language proficiencies
  - Professional references
  - Social media integration (LinkedIn, GitHub, Twitter, etc.)
- **Profile Completion Tracker** - Visual progress indicator
- **Blog Publishing** - Share articles and industry insights
- **Responsive Mobile Design** - Access from any device

### 🏢 For Employers
- **Company Profile**
  - Detailed company information
  - Mission, Vision & Values
  - Company history timeline
  - Employee benefits showcase
  - Team member highlights
  - Media gallery
  - Multiple office locations with map integration
- **Approval Workflow** - Verified employer accounts
- **Blog Publishing** - Share company news and insights

### ⚙️ For Administrators
- **Admin Dashboard** - Overview of platform statistics
- **User Management**
  - View and manage all candidates
  - Employer approval/rejection workflow
  - Password reset capabilities
- **Content Moderation**
  - Blog article management
  - User account controls

### 📝 Blog Platform
- Create and publish articles
- Multiple categories (IT/Software, Marketing/Sales, Finance/Banking, Education, Other)
- Rich text content
- Reactions system (like, love, insightful, celebrate)
- Nested comment system
- Author profiles with role badges
- Featured images

---

## 🛠 Tech Stack

| Category | Technologies |
|----------|-------------|
| **Backend** | ![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=flat-square&logo=laravel&logoColor=white) Laravel 12.x, PHP 8.2+ |
| **Frontend** | ![Blade](https://img.shields.io/badge/Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white) Blade Templates, Custom CSS, JavaScript |
| **Styling** | ![Tailwind](https://img.shields.io/badge/Tailwind-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white) Tailwind CSS 4.x, Glassmorphism Design |
| **Build Tool** | ![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white) Vite 7.x |
| **Database** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) MySQL / SQLite |
| **Authentication** | Laravel Built-in Auth |
| **Testing** | PHPUnit 11.x, Laravel Pint |

---

## 🚀 Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- MySQL or SQLite

### Quick Start

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/vacancy-hunting.git
   cd vacancy-hunting
   ```

2. **Run the setup script**
   ```bash
   composer setup
   ```
   This will:
   - Install PHP dependencies
   - Copy `.env.example` to `.env`
   - Generate application key
   - Run database migrations
   - Install NPM dependencies
   - Build frontend assets

3. **Configure your database** (optional - defaults to SQLite)
   
   Edit `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=vacancy_hunting
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

4. **Start the development server**
   ```bash
   composer dev
   ```
   This starts:
   - 🌐 Laravel Server
   - 📋 Queue Worker
   - 📜 Log Viewer (Pail)
   - ⚡ Vite Dev Server

5. **Access the application**
   - Main App: `http://localhost:8000`
   - Admin Panel: `http://localhost:8000/adminview/login`

### Manual Installation

```bash
# Install dependencies
composer install
npm install

# Environment setup
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate

# Build assets
npm run build

# Start server
php artisan serve
```

---

## 🗄 Database Structure

### Core Tables

```
┌─────────────────────────────────────────────────────────────────┐
│                          USERS                                   │
│  id | email | password | role (admin/candidate/employer)        │
└─────────────────────────────────────────────────────────────────┘
           │                    │                    │
           ▼                    ▼                    ▼
    ┌──────────┐        ┌─────────────┐       ┌───────────┐
    │  ADMINS  │        │ CANDIDATES  │       │ EMPLOYERS │
    └──────────┘        └─────────────┘       └───────────┘
                               │                    │
                    ┌──────────┼──────────┐         │
                    ▼          ▼          ▼         ▼
              ┌──────────┐ ┌────────┐ ┌─────┐  ┌──────────┐
              │EDUCATION │ │EXPERIEN│ │CERTS│  │LOCATIONS │
              └──────────┘ └────────┘ └─────┘  └──────────┘
                    │          │          │         │
              ┌─────┼──────────┼──────────┤         │
              ▼     ▼          ▼          ▼         ▼
         ┌─────────────────────────────────────────────────┐
         │  PORTFOLIO | LANGUAGES | REFERENCES | TEAM | MEDIA │
         └─────────────────────────────────────────────────┘
```

### Blog Tables

```
┌───────────────────┐
│   BLOG_ARTICLES   │──────┬──────────────────────┐
│ (title, content)  │      │                      │
└───────────────────┘      ▼                      ▼
                    ┌─────────────┐      ┌─────────────────┐
                    │  REACTIONS  │      │    COMMENTS     │
                    │  (like,love)│      │ (nested replies)│
                    └─────────────┘      └─────────────────┘
```

---

## 👥 User Roles

### 🎓 Candidate
- Can register and login immediately
- Manage personal & professional profile
- Add education, experience, certifications
- Publish blog articles
- React and comment on articles

### 🏢 Employer
- Registration requires admin approval
- Complete company profile with rich details
- Add team members and office locations
- Publish company blog articles
- Upload media gallery

### 👑 Administrator
- Full access to admin dashboard
- Approve or reject employer registrations
- Manage all users (view, edit, delete)
- Moderate blog content
- Password management for all users

---

## 📸 Screenshots

> *Screenshots demonstrate the user interface. Please add images to `public/screenshots/`.*

### Landing Page
![Landing Page](public/screenshots/landing.png)
*The landing page features a stunning hero section with gradient overlays and modern navigation.*

### Candidate Profile
![Candidate Profile](public/screenshots/candidate-dashboard.png)
*Rich, tabbed profile interface with education timeline, skills showcase, and portfolio gallery.*

### Employer Dashboard
![Employer Dashboard](public/screenshots/employer-dashboard.png)
*Comprehensive company profile with team members, locations map, and media gallery.*

### Admin Panel
![Admin Panel](public/screenshots/admin-dashboard.png)
*Clean, efficient dashboard for managing users and content.*

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

**Shrabon Das**

- GitHub: [@shrabondas5544](https://github.com/shrabondas5544)

---

<p align="center">
  <strong>⭐ Star this repository if you find it helpful!</strong>
</p>

<p align="center">
  Made with ❤️ using Laravel
</p>
