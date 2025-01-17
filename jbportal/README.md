# Online Job Portal

## Table of Contents
- [Overview](#overview)
- [Motivation](#motivation)
- [Features](#features)
- [Technologies Used](#technologies-used)
- [Database Relations](#database-relations)
- [How to Run the Project](#how-to-run-the-project)
- [Future Enhancements](#future-enhancements)
- [License](#license)

---

## Overview
The **Online Job Portal** is a web application designed to bridge the gap between job seekers and employers. It allows users to register as either job seekers or employers, post and apply for jobs, and track application statuses seamlessly.

---

## Motivation
The main motivation of this project is to create a simple and efficient job portal where:
- Users can post jobs as employers.
- Users can apply for jobs as job seekers.
- Both employers and job seekers can easily track job postings and application statuses.

---

## Features

### User Features
- **Registration & Login**: Secure user authentication.
- **Employer/Job Seeker Roles**: Option to register as an employer or job seeker.
- **Profile Management**: Edit and update user profiles.
- **Dashboard Access**: Personalized dashboard for each user type.

### Job Management
#### For Employers:
- Post job openings.
- Track applications submitted by job seekers.

#### For Job Seekers:
- Apply to available jobs.
- Track application statuses.
- Upload resumes/CVs.
- Search and filter job listings.

### Core Search Features
- **Keyword Search**: Find jobs using specific keywords.
- **Location Filter**: Search jobs based on location.
- **Category Filter**: Narrow down jobs by categories.
- **Job Type Filter**: Filter jobs by types (Full-time, Part-time, etc.).

### Categories & Types
- Job Categories (e.g., IT, Healthcare, Education, etc.)
- Job Types (e.g., Full-time, Part-time, Freelance, etc.)
- Featured and latest job postings.

### Application System
- Submit online applications.
- Upload resumes.
- Track application status.
- Receive email notifications.

---

## Technologies Used
- **Backend**: Laravel 11
- **Database**: MySQL (via XAMPP server)
- **Frontend**: HTML, CSS, JavaScript
- **Server**: Apache (via XAMPP)

---

## Database Relations

### User Table
Stores user information including roles (Employer/Job Seeker).

### Job Table
Stores details of job postings.

### Category Table
Contains job categories.

### Job Types Table
Defines job types (e.g., Full-time, Part-time, etc.).

### Job Application Table
Tracks job applications submitted by job seekers.

---

## How to Run the Project
1. Clone the repository:
   ```bash
   git clone https://github.com/your-username/online-job-portal.git
   ```
2. Navigate to the project directory:
   ```bash
   cd online-job-portal
   ```
3. Install dependencies:
   ```bash
   composer install
   npm install
   ```
4. Set up the `.env` file:
   - Copy the `.env.example` file to `.env`.
   - Update the database credentials.
5. Run migrations:
   ```bash
   php artisan migrate
   ```
6. Start the local server:
   ```bash
   php artisan serve
   ```
7. Open the application in your browser:
   ```
   http://localhost:8000
   ```

---

## Future Enhancements
- Add an admin panel for managing users, jobs, and applications.
- Integrate payment options for featured job postings.
- Implement AI-based job recommendations.
- Add multi-language support.



