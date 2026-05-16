# Vivid Vibes

Vivid Vibes is a PHP + MySQL social-media style web app that demonstrates a complete flow from frontend pages to database-driven content.

This Project was built upon a youtube tutorial by EGATOR, which provided the UI design and some implementation guidance. Then we built up on Egator's work by adding more features, improving the database structure, and implementing additional pages and interactions. This Project served a great amount into understanding how to build a full-stack web application using PHP and MySQL, and how to structure the code and database for a social media style app.

## What this project includes

- User authentication (signup, login, logout)
- Session-protected app pages (`home.php`, `explore.php`, `profile.php`)
- Feed rendering with DB-backed captions/likes
- Notifications, messages, friend requests (database-driven UI blocks)
- Contact form submission into the database
- Theme and layout interactions using vanilla JavaScript (`index.js`)

## Tech stack

- **Backend:** PHP (procedural), MySQL (via `mysqli`)
- **Frontend:** HTML, CSS, JavaScript
- **Runtime environment:** XAMPP (Apache + MySQL recommended)

## Project layout

- `index.php` - Signup page
- `login.php` - Login page
- `logout.php` - Session destroy + redirect
- `home.php` - Main feed page (authenticated)
- `explore.php` - Explore feed page (authenticated)
- `profile.php` - User profile page (authenticated)
- `connection.php` - Central database connection
- `submit_contact_form.php` - Handles contact form POST
- `style.css`, `signup.css`, `index.js` - Shared UI and behavior
- `feeds/`, `images/` - Static media assets

## How it works (high-level)

1. User signs up from `index.php` or logs in through `login.php`.
2. On login success, session variables are set and user is redirected to `home.php`.
3. Authenticated pages verify `$_SESSION['loggedin']` before rendering.
4. Each page runs its own SQL queries and renders rows inline using `mysqli_fetch_assoc`.
5. Contact form posts to `submit_contact_form.php`, which inserts form data into `contact`.

## Prerequisites

- XAMPP (or any Apache + PHP + MySQL setup)
- PHP 7.4+ recommended
- MySQL/MariaDB server
- A browser

## Setup and run

1. Copy this project folder into your web server root (for XAMPP: `htdocs/`).
2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Open phpMyAdmin and create a database named:
   - `vividvibes`
4. Create/import the tables expected by queries in code:
   - `users`
   - `notifications`
   - `posts`
   - `post_stats`
   - `messages`
   - `requests`
   - `profile`
   - `contact`
5. Confirm DB credentials in `connection.php`:
   - host: `localhost`
   - user: `root`
   - password: ``
   - database: `vividvibes`
6. Open in browser:
   - `http://localhost/Vivid-Vibes/index.php`

## How to use

1. Register a user from `index.php`.
2. Login from `login.php`.
3. Navigate:
   - **Home**: stories + multiple feed cards
   - **Explore**: alternating feed image set logic by user
   - **Profile**: profile card + activity blocks
4. Use **Contact** page to submit feedback; entry is saved into `contact`.

## Notes for contributors

- This repository currently has **no build system, test suite, or linter configuration**.
- Assets are referenced directly in templates/CSS by filename.
- Database access is inline in page files (no ORM or repository layer).

## Credits

Original UI inspiration from EGATOR:
https://youtu.be/AiFfDjmd0jU?si=t8mND9XWrtfaZXoS
