# Project Brief: Sports Equipment Inventory Management Website

## 📌 Background
A school requires a web-based system to manage the inventory of sports equipment efficiently. This system will help administrators manage the inventory and allow users to borrow equipment. The application will be built using the **Laravel framework**.

## 🎯 Project Objectives
- Develop a web-based inventory management system for sports equipment.
- Provide different access rights for Admin and Users.
- Enable borrowing and returning of equipment with approval features.
- Deliver an attractive and responsive interface.

## 👥 User Roles
### 1. Admin
- Login to the system using username and password.
- Manage sports equipment data (CRUD).
- View and manage borrowing requests (approve/decline).

### 2. Regular User
- View the available sports equipment in card layout.
- Submit borrowing requests by filling out a form.

## ⚙️ Key Features
### 1. Authentication
- Login form for Admin only.
- Redirect Admin to dashboard after successful login.
- Logout functionality.

### 2. Admin Features
- **Dashboard**
  - Display table of sports equipment with details (ID, name, status, image, quantity).
- **CRUD Operations**
  - Add new equipment.
  - Edit equipment details.
  - Delete equipment.
- **Borrowing Management**
  - Display table of borrowing requests with details (borrower name, item, quantity, borrow date, return date).
  - Approve or decline requests.

### 3. User Features
- **Browse Equipment**
  - Display available sports equipment in **card format** with details (image, status, quantity).
- **Borrowing Form**
  - Input fields: borrower name, item name, quantity, borrow date, return date.
  - Submit form to create borrowing request.

### 4. Database Design
Database name: `db_alatolahraga`

#### Table: `admin`
- id
- username
- password

#### Table: `users`
- id
- name
- email
- password

#### Table: `sports_equipment`
- id
- item_name
- item_status
- item_image
- item_quantity

#### Table: `borrow_requests`
- id
- borrower_name
- item_name
- quantity
- borrow_date
- return_date
- status (approve/decline)

## 🎨 Design Guidelines
- Responsive layout for both desktop and mobile.
- Admin dashboard uses a structured table view.
- User interface displays sports equipment in **card style**.
- Reference design inspiration from external sources (e.g., Pinterest).
- Do **not** use Laravel default template.
- Provide a clean, modern, and user-friendly design.

## 📦 Deliverables
- Complete Laravel source code.
- Database `db_alatolahraga` with required tables.
- Documentation for setup and usage.
- GitHub repository containing the final project.

## 🔔 Reminder (Technical Requirements)
- Project must use **Laravel 12** (latest version).
- Styling should use the **latest TailwindCSS** version.
- Authentication system must be implemented using **Laravel Breeze**.

## ✅ Conclusion
This project aims to build a sports equipment inventory management system using Laravel. The system will support admin login, equipment management, borrowing requests, and approval workflow, all presented in a responsive and visually appealing design. The final deliverables include the source code, database, documentation, and GitHub repository.
