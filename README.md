Secure User Authentication System
This project is a Secure User Authentication System with a sleek, modern design using PHP, MySQL, HTML, and CSS. It features a standard registration and login system, enhanced with a unique 4-digit passcode login option for an extra layer of security.

Features
User Registration:

Users can sign up by providing a username, email, and password.
Upon successful registration, the system generates a unique 4-digit passcode, displayed in a popup with a "copy" button for convenience.
Email validation ensures that each email is unique, and prompts are shown if the email is already used.
Login System:

Users can log in with their email and password.
A passcode login option is available, allowing users to log in using the 4-digit passcode they received during registration.
Upon successful login, the user is redirected to the dashboard.
Security:

Passwords are securely hashed using BCRYPT before storing them in the database.
Passcodes are generated randomly and stored securely.
UI/UX Design:

Modern and attractive design with a gradient background, soft shadows, hover effects, and a responsive layout for a polished look and feel.
The registration and login pages are user-friendly and visually appealing.
Technologies Used
Frontend:

HTML5, CSS3 (including responsive design techniques)
Backend:

PHP (server-side scripting)
MySQL (database)
Security:

Password hashing using BCRYPT
Installation and Setup
Prerequisites
XAMPP or WAMP (or any LAMP stack) to run PHP and MySQL.
A web browser to access the project.
Steps
Clone the repository:

bash :
git clone https://github.com/your-username/secure-auth-system.git

Move the project to your server's root directory:

For XAMPP: Move the folder to htdocs.
For WAMP: Move the folder to www.

Database Setup:
Open phpMyAdmin and create a new database (e.g., user_auth).
Import the provided user_auth.sql file into the database.
The users table will have the following structure:
id (Primary key, auto-increment)
username (varchar)
email (varchar, unique)
password (varchar, hashed)
passcode (int)
Configure Database Connection:

Open the config.php file (if exists) or locate the database connection section in the PHP files and adjust the following parameters:

php :
$conn = new mysqli('localhost', 'root', '', 'user_auth');

Run the Project:

Open your web browser and navigate to:
http://localhost/secure-auth-system/

You should now see the registration page.
