# Pharmacy Management System

A comprehensive solution for managing pharmacy operations, including inventory, sales, and reporting.

## Features

1. Medicine Database
2. Point of Sales (POS)
3. Listing of all expenses
4. Invoicing
5. Reporting
6. Dynamic Dashboard
7. Alert Stock Management
8. Dynamic Language (Available in English, Spanish and French)
9. Profit Calculation in Reporting
10. Big data Handling by medicine list and sales list pagination
11. Easy medicine search by Name or Company
12. Easy Invoice / sale search by Invoice Id
13. And many more...

## Installation Instructions

### Prerequisites

- PHP 5.6 or higher
- MySQL 5.6 or higher
- Apache/Nginx web server

### Setup Steps

1. **Database Setup**
   - Create a new MySQL database named `pharmacy`
   - Import the `pharmacy.sql` file located in the root directory of this project
   - The SQL file contains all necessary tables and initial data

2. **Database Configuration**
   - Open `application/config/database.php`
   - Update the database connection settings with your credentials:
     ```php
     $db['default']['hostname'] = 'localhost'; // Your database server hostname
     $db['default']['username'] = 'root';      // Your database username
     $db['default']['password'] = '';          // Your database password
     $db['default']['database'] = 'pharmacy';  // Keep this as 'pharmacy'
     ```

3. **Web Server Configuration**
   - Place the entire `pharmacy` folder in your web server's document root
   - For Apache: Ensure mod_rewrite is enabled
   - For Nginx: Configure URL rewriting to support CodeIgniter

4. **Access the System**
   - Open your web browser and navigate to: `http://localhost/pharmacy/`
   - Default login credentials:
     - Username: admin
     - Password: admin123

## Troubleshooting

### Access Forbidden Error
If you encounter an "Access Forbidden" error:
1. Check that your web server has proper permissions to access the files
2. Ensure .htaccess files are properly configured and allowed in your Apache configuration
3. Verify that mod_rewrite is enabled in Apache

### Database Connection Issues
If you cannot connect to the database:
1. Verify your database credentials in `application/config/database.php`
2. Ensure MySQL service is running
3. Check that the database 'pharmacy' exists and has been properly imported

## Support

For any issues or questions, please open an issue in the repository or contact the maintainers.