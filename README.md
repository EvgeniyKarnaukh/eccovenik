# eccovenik

**Author:** Evgeniy (Yevhen) Karnaukh
**Created:** 2021
**Live demo** ➜ [eccovenik.great-site.net](http://eccovenik.great-site.net)

## Overview

**eccovenik** is a complete PHP landing page with an integrated lightweight CRM and a MySQL database.  
The landing page presents products and allows visitors to submit a request. All requests and visitor stats are stored and managed via a minimal admin panel.

The system is ideal for small businesses needing a simple, self-hosted CRM with no external dependencies.

---

## Features

- Responsive landing page with product catalog and request form
- Built-in admin panel (`/admin/`) to:
  - View customer orders and user messages
  - Monitor site statistics (views, visits, conversions)
  - Track UTM campaigns and traffic sources
- MySQL database with structured tables
- Works without frameworks — pure PHP

---

## Database

This project requires a MySQL database. Use the provided file `eccovenik.sql` to create the required tables.

### Main Tables:

| Table             | Description                             |
|-------------------|-----------------------------------------|
| `lan_orders`      | Stores customer orders                  |
| `lan_users`       | User records (name, phone, email, etc.) |
| `lan_prices`      | Product list with images and pricing    |
| `lan_counts`      | Site statistics                         |
| `lan_camps`       | UTM campaign tracking                   |
| `lan_visitors`    | Unique visitor log                      |

To import:
1. Create a database named `eccovenik`
2. Import `eccovenik.sql` using phpMyAdmin or MySQL CLI

---

## Installation

1. Clone the repo or upload the files to your server
2. Import the database (`eccovenik.sql`)
3. Set database credentials in the PHP config file (`lib/start.php`)
4. Open `index.php` in your browser
5. Go to `/admin/start.php` to access the CRM

---

## Requirements

- PHP 7.1 or higher
- MySQL (MariaDB compatible)
- Apache or Nginx server

---

## Project Structure

```
eccovenik/
├── admin/                → Admin panel
├── assets/               → CSS, JS, and image files
├── lib/                  → Server logic and DB config
├── index.php             → Main landing page
├── privacy.php           → Privacy policy page
├── sitemap.xml           → Sitemap for search engines
├── success.php           → Thank-you page after form submission
├── eccovenik.sql         → MySQL database dump
└── README.md
```


---

## License

This project is shared for personal or educational use only.  
For commercial use, please contact the author.

---

## Contact

Feel free to reach out via GitHub or by contacting the author directly.
