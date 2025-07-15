# Worklink


## Project Overview
WorkLink is a web application that connects customers with skilled workers for various services like plumbing, electrical work, carpentry, and more. The platform facilitates finding, hiring, and communicating with workers in your local area.

## Key Features

1. **User Roles**:
   - Workers: Can register, create profiles, and receive job requests
   - Customers: Can search for workers and send messages/requests

2. **Core Functionalities**:
   - Worker registration with profile details and work images
   - Customer registration
   - Search functionality to find workers by type and location
   - Messaging system between customers and workers
   - Profile management for workers

## Database Structure
The system uses MySQL with tables for:
- Users (both workers and customers)
- Messages
- Reviews
- Job requests

## File Structure and Flow

### Main Entry Points
1. **index.php** - Landing page with role selection (worker/customer)
2. **login.php** - Login page for both roles
3. **login_process.php** - Handles authentication and redirects to appropriate dashboard

### Registration Flow
1. **register_worker.php** - Worker registration form
2. **register_worker_process.php** - Processes worker registration
3. **register_customer.php** - Customer registration form
4. **register_customer_process.php** - Processes customer registration
5. **registration_success.php** - Shows success message after registration

### Worker Flow
1. **worker_dashboard.php** - Main dashboard for workers
2. **worker_profile.php** - Worker profile page
3. **view_messages.php** - Worker message inbox and reply system

### Customer Flow
1. **customer_search.php** - Search interface for finding workers
2. (Additional customer features would be implemented here)

### Shared Components
1. db.php - Database connection class
2. **style.css** - Main stylesheet
3. **database.sql** - Database schema

## How to Set Up

1. **Database Setup**:
   - Create MySQL database using `database.sql` or `databse.txt`
   - Configure connection details in `db.php`

2. **File Structure**:
   - Ensure all PHP files are in the root directory
   - Create an `uploads/` directory for profile and work images

3. **Requirements**:
   - PHP 7.0+
   - MySQL 5.7+
   - Web server with PHP support (Apache, Nginx)


# WorkLink - Worker-Customer Connection Platform

WorkLink is a web application that connects customers with skilled workers for various services.

## Features

- Worker registration with detailed profiles
- Customer registration
- Search workers by type and location
- Messaging system
- Profile management

## Technologies Used

- PHP
- MySQL
- HTML5
- CSS3
- JavaScript

## Installation

1. Clone the repository
2. Import the database schema from `database.sql`
3. Configure database connection in `db.php`
4. Set up web server to point to project directory

## Usage

1. Access the application through your web server
2. Register as either a worker or customer
3. Workers can manage their profiles
4. Customers can search for and contact workers





### Project Structure

WorkLink/
├── css/
│   └── style.css
├── uploads/          # For storing uploaded images
├── index.php         # Landing page
├── login.php         # Login page
├── login_process.php # Login handler
├── register_worker.php
├── register_worker_process.php
├── register_customer.php
├── register_customer_process.php
├── registration_success.php
├── worker_dashboard.php
├── worker_profile.php
├── view_messages.php
├── customer_search.php
├── db.php            # Database connection
├── database.sql      # Database schema
└── README.md


