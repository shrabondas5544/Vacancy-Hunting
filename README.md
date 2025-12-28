<p align="center">
  <img src="public/assets/images/VH%20logo.png" width="200" alt="Vacancy Hunting Logo">
</p>

<h1 align="center">Vacancy Hunting</h1>

<p align="center">
  <strong>A Modern Job Portal & Internship Platform Connecting Talent with Opportunity</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Vite-7.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
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
- [License](#-license)

---

## 🎯 About

**Vacancy Hunting** is a comprehensive job portal and internship management platform built with Laravel, designed to bridge the gap between job seekers, employers, and students. The platform provides an intuitive interface for candidates to showcase their skills, for employers to find the perfect talent, and for administrators to manage internship programs seamlessly.

### 🌟 Why Vacancy Hunting?

- **Seamless Experience**: Modern, responsive UI with glassmorphism design
- **Role-Based Access**: Distinct portals for candidates, employers, and administrators
- **Comprehensive Profiles**: Rich profile features including education, experience, certifications, and portfolio
- **Blog Platform**: Share industry insights through the integrated blogging system
- **Internship Management**: Dynamic Campus Bird Internship program with customizable application forms
- **Admin Dashboard**: Complete control for administrators with approval workflows and form builder

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
  - Job preferences & availability
  - Social media integration (LinkedIn, GitHub, Twitter, etc.)
- **Profile Completion Tracker** - Visual progress indicator
- **Campus Bird Internship** - Apply for department-specific internships
- **Blog Publishing** - Share articles and industry insights
- **Responsive Mobile Design** - Access from any device

### 🏢 For Employers
- **Company Profile**
  - Detailed company information
  - Mission, Vision & Values
  - Company history timeline
  - Employee benefits showcase
  - Team member highlights
  - Media gallery (images & videos)
  - Multiple office locations with map integration
  - Social media & website links
- **Approval Workflow** - Verified employer accounts with admin approval
- **Blog Publishing** - Share company news and insights
- **Excel Export** - Download complete employer data

### 🎓 Campus Bird Internship
- **Public Application Portal**
  - Department selection modal with availability status
  - Dynamic application forms per department
  - Custom field support (text, date, radio, select, file upload)
  - "Program Not Available" messaging for inactive departments
- **For Applicants**
  - Apply to various departments (IT, HR, Marketing, Finance, etc.)
  - Upload required documents (CV, cover letter, certificates)
  - Track application status
- **Social Media Integration**
  - Updates about program availability on social platforms

### ⚙️ For Administrators
- **Admin Dashboard** - Overview of platform statistics
- **User Management**
  - View and manage all candidates (with Excel export)
  - Employer approval/rejection workflow (with Excel export)
  - Password reset capabilities
  - User account deletion
- **Campus Bird Internship Management**
  - **Dynamic Form Builder**
    - Create custom application forms for each department
    - Multiple field types: text, date, radio buttons, single/multiple select, file upload
    - Drag-and-drop field ordering
    - Toggle form active/inactive status
    - Department assignment from predefined list
  - **Applicant Management**
    - View all applications by department
    - Update application status (pending/reviewed/accepted/rejected)
    - Export applicant data
    - View detailed application submissions
- **Content Moderation**
  - Blog article management
  - User account controls
- **Role Management**
  - Admin, Moderator, and Chairman roles
  - Profile management with password change

### 📝 Blog Platform
- **For All Users**
  - Create and publish articles
  - Multiple categories (IT/Software, Marketing/Sales, Finance/Banking, Education, Other)
  - Rich text content with featured images
  - Reactions system (like, love, insightful, celebrate)
  - Nested comment system with replies
  - Author profiles with role badges (Admin, Candidate, Employer)
- **My Articles Dashboard**
  - Card-based layout matching main blog
  - Edit and manage your own articles
  - Delete posts with confirmation

---

## 🛠 Tech Stack

| Category | Technologies |
|----------|-------------|
| **Backend** | ![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white) Laravel 12.x, PHP 8.2+ |
| **Frontend** | ![Blade](https://img.shields.io/badge/Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white) Blade Templates, Custom CSS, JavaScript |
| **Styling** | Custom CSS with Glassmorphism Design, Google Fonts (Inter, Roboto) |
| **Build Tool** | ![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white) Vite 7.x |
| **Database** | ![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white) MySQL / SQLite |
| **Authentication** | Laravel Built-in Auth with Role-based Middleware |
| **Testing** | PHPUnit 11.x, Laravel Pint |
| **Data Export** | Laravel Excel (Maatwebsite) |

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
   git clone https://github.com/shrabondas5544/Vacancy-Hunting.git
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
   - 🌐 Laravel Server (http://localhost:8000)
   - 📋 Queue Worker
   - 📜 Log Viewer (Pail)
   - ⚡ Vite Dev Server

5. **Access the application**
   - **Main App**: `http://localhost:8000`
   - **Admin Panel**: `http://localhost:8000/adminview/login`
   - **Campus Bird**: `http://localhost:8000/services/campus-bird-internship`

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
    │(role:str)│        │(enhanced)   │       │(approved) │
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
         │ PORTFOLIO | LANGUAGES | REFERENCES | TEAM | MEDIA│
         └─────────────────────────────────────────────────┘
```

### Blog & Internship Tables

```
┌───────────────────┐                  ┌─────────────────────┐
│   BLOG_ARTICLES   │──────┬───────┐   │  INTERNSHIP_FORMS   │
│ (title, content)  │      │       │   │ (dept, is_active)   │
└───────────────────┘      ▼       ▼   └─────────────────────┘
                    ┌─────────┐ ┌────────┐          │
                    │REACTIONS│ │COMMENTS│          ▼
                    └─────────┘ └────────┘   ┌──────────────┐
                                             │ SUBMISSIONS  │
                                             │ (form data)  │
                                             └──────────────┘
```

### Campus Bird Departments

The following departments are available for internship applications:
- **Information Technology (IT)**
- **Human Resources (HR)**
- **Marketing**
- **Finance & Accounting**
- **Sales**
- **Operations**
- **Customer Service**
- **Research & Development (R&D)**
- **Legal**
- **Business Development**
- **Product Management**
- **Quality Assurance (QA)**
- **Supply Chain Management**
- **Public Relations (PR)**
- **Data Analytics**

---

## 👥 User Roles

### 🎓 Candidate
- Can register and login immediately (no approval needed)
- Manage comprehensive personal & professional profile
- Add education, experience, certifications, portfolio, languages, references
- Set job preferences and availability
- Apply for Campus Bird internships
- Publish blog articles
- React and comment on articles
- Upload profile picture

### 🏢 Employer
- **Registration requires admin approval** (pending until verified)
- Cannot access platform features until approved by administrator
- Complete company profile with rich details
- Add team members and office locations
- Multiple locations with full addresses
- Publish company blog articles
- Upload media gallery (images & videos)
- Showcase company culture, values, and benefits

### 👑 Administrator (Admin/Moderator/Chairman)
- Full access to admin dashboard at `/adminview`
- **User Management**
  - View all candidates with detailed profiles
  - Approve or reject employer registrations
  - Reset passwords for any user
  - Delete user accounts
  - Export data to Excel
- **Campus Bird Management**
  - Create and edit application forms for each department
  - Add custom fields (text, date, radio, select, file upload)
  - Toggle form availability (active/inactive)
  - View all internship applications
  - Update application status (pending/reviewed/accepted/rejected)
  - Export applicant data
- **Content Moderation**
  - Manage and delete blog articles
  - Monitor user activity
- **Profile Management**
  - Change own password
  - Update admin profile

---

## 📸 Screenshots

> *Screenshots demonstrate the user interface. Add images to `public/screenshots/` directory.*

### Landing Page
![Landing Page](public/screenshots/landing.png)
*Modern hero section with glassmorphism navbar and gradient overlays*

### Campus Bird Internship
![Campus Bird](public/screenshots/campus-bird.png)
*Department selection modal with dynamic application forms*

### Candidate Profile
![Candidate Profile](public/screenshots/candidate-dashboard.png)
*Rich, tabbed profile with education timeline, skills showcase, and portfolio gallery*

### Employer Dashboard
![Employer Dashboard](public/screenshots/employer-dashboard.png)
*Comprehensive company profile with team, locations map, and media gallery*

### Admin Panel
![Admin Panel](public/screenshots/admin-dashboard.png)
*Clean dashboard for managing users, internships, and content*

### Blog Platform
![Blog](public/screenshots/blog.png)
*Card-based article layout with categories, reactions, and nested comments*

### Form Builder
![Form Builder](public/screenshots/form-builder.png)
*Dynamic form builder with drag-and-drop fields for internship applications*

---

## 🚀 Key Features Highlights

### ✨ Modern UI/UX
- **Glassmorphism Design**: Translucent cards with blur effects
- **Responsive Navigation**: Mobile-friendly hamburger menu
- **Smooth Animations**: Hover effects and transitions throughout
- **Premium Typography**: Google Fonts integration (Inter, Roboto)
- **Dark Theme Support**: Eye-friendly color palette

### 🔒 Security & Authentication
- Laravel's built-in authentication system
- Role-based middleware protection
- Password hashing with bcrypt
- CSRF protection on all forms
- Admin approval workflow for employers

### 📊 Data Management
- Excel export for candidates and employers
- Rich data filtering and search
- Comprehensive profile fields
- File upload support (images, documents, media)
- Database migrations for easy deployment

### 🎨 Dynamic Content
- Custom form builder for internship applications
- Multiple field types with validation
- Active/inactive status toggling
- Department-based form routing
- Real-time availability checking

---

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 👨‍💻 Author

**Shrabon Das**

- GitHub: [@shrabondas5544](https://github.com/shrabondas5544)
- Project: [Vacancy Hunting](https://github.com/shrabondas5544/Vacancy-Hunting)

---

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check the [issues page](https://github.com/shrabondas5544/Vacancy-Hunting/issues).

---

<p align="center">
  <strong>⭐ Star this repository if you find it helpful!</strong>
</p>

<p align="center">
  Made with ❤️ using Laravel
</p>
