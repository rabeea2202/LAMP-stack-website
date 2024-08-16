# LAMP Stack Sneaker Gallery

## Overview

This project is a simple web application built using the LAMP stack (Linux, Apache, MySQL, PHP). The website allows users to upload sneaker images along with their names and comments. Users can view uploaded images in a gallery, and the site also includes a contact form for user inquiries.

### Features

- **Image Upload:** Users can upload sneaker images with a name, sneaker name, and comment.
- **Gallery:** Displays uploaded images along with their names, sneaker names, and comments.
- **About Page:** Provides information about the project and its purpose.
- **Contact Page:** Users can send contact information and messages, stored in a MySQL database.

## Installation

### Prerequisites

- **Apache:** Web server to host the PHP files.
- **MySQL:** Database server to store data.
- **PHP:** Server-side scripting language.
- **XAMPP:** Optional, for local development on Windows.
- **EC2 Instance:** For hosting the website.

### Local Development (Using XAMPP)

1. **Download and Install XAMPP:**
   - [XAMPP Download](https://www.apachefriends.org/index.html)

2. **Start Apache and MySQL:**
   - Launch XAMPP Control Panel and start Apache and MySQL services.

3. **Setup Project:**
   - Place your project files in the `htdocs` directory of your XAMPP installation.
   - Example path: `C:\xampp\htdocs\your-project`

4. **Configure Database:**
   - Open phpMyAdmin (usually available at `http://localhost/phpmyadmin`).
   - Create a new database for your project.
   - Import any provided SQL schema to set up the necessary tables.

5. **Configure PHP Files:**
   - Edit database connection settings in your PHP files to match your local MySQL setup.

### Deploying to EC2

1. **Launch an EC2 Instance:**
   - Choose an Ubuntu AMI and configure security groups to allow HTTP (port 80) and SSH (port 22) access.

2. **Install LAMP Stack:**
   - Connect to your EC2 instance via SSH.
   - Install Apache, PHP, and MySQL:
     ```bash
     sudo apt update
     sudo apt install apache2 php php-mysql mysql-server
     ```

3. **Upload Project Files:**
   - Use SCP or another method to transfer your project files to the `/var/www/html/` directory on the EC2 instance.

4. **Configure Apache:**
   - Ensure that Apache is configured to serve your project from `/var/www/html/`.

5. **Setup Database:**
   - Access MySQL and create a database for your project.
   - Import your database schema if provided.

6. **Adjust Permissions:**
   - Set appropriate permissions for the Apache user:
     ```bash
     sudo chown -R www-data:www-data /var/www/html/
     sudo chmod -R 755 /var/www/html/
     ```

## Usage

1. **Access the Website:**
   - Open a web browser and navigate to your EC2 instance’s public IP address or domain.

2. **Upload Sneakers:**
   - Use the `index.php` page to upload sneaker images with a name, sneaker name, and comment.

3. **View Gallery:**
   - Visit the `gallery.php` page to see all uploaded images, names, sneaker names, and comments.

4. **Contact Form:**
   - Use the `contact.php` page to send contact information. Messages are stored in the MySQL database.

5. **About Page:**
   - The `about.php` page provides information about the project.

## Contributing

If you wish to contribute to this project, please fork the repository and submit a pull request with your changes. Ensure that any modifications adhere to the project's coding standards and include appropriate documentation.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Acknowledgements

- XAMPP for local development.
- Amazon EC2 for cloud hosting.
- Apache, MySQL, and PHP for the LAMP stack.

