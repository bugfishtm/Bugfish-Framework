
# Enabling HTTP/2 (h2) and HTTP/1.1 in Apache VirtualHost

This guide explains how to enable HTTP/2 (h2) and configure HTTP/1.1 for an Apache VirtualHost. HTTP/2 is a major revision of the HTTP network protocol and offers significant performance improvements compared to its predecessor, HTTP/1.1.

## Prerequisites

Before you proceed, ensure that you meet the following prerequisites:

- Apache web server is installed and running.
- SSL/TLS is configured on your server (HTTP/2 typically requires HTTPS).
- You have root or sudo access to your server.

## Procedure

Follow these steps to enable HTTP/2 and configure HTTP/1.1 for an Apache VirtualHost:

1. **Create or Edit the VirtualHost Configuration File:**

   Locate the VirtualHost configuration file for your website or application. This file is typically found in the `/etc/apache2/sites-available/` directory and has a `.conf` extension. You can create a new one if it doesn't exist.

2. **Edit the VirtualHost Configuration:**

   Inside the VirtualHost configuration file, add the following directives to enable HTTP/2 and configure HTTP/1.1:

   <VirtualHost *:443>
       ServerName your.domain.com
       DocumentRoot /var/www/yourwebsite

       SSLEngine on
       SSLCertificateFile /path/to/your/certificate.crt
       SSLCertificateKeyFile /path/to/your/privatekey.key

       Protocols h2 http/1.1
       # Additional VirtualHost configurations
   </VirtualHost>

   - Replace `your.domain.com` with your website's domain name.
   - Update `DocumentRoot` to the actual path of your website files.
   - Specify the paths to your SSL certificate and private key files.

3. **Save and Close the Configuration File.**

4. **Enable the HTTP/2 Module:**

   Ensure that the `http2` module is enabled. You can enable it using the following command:

   ```bash
   sudo a2enmod http2
   ```

5. **Check Configuration Syntax:**

   Before applying the changes, it's essential to check the Apache configuration for any syntax errors. Use the following command:

   ```bash
   sudo apachectl configtest
   ```

6. **Reload Apache:**

   If the configuration test passes without errors, reload Apache to apply the changes:

   ```bash
   sudo systemctl reload apache2
   ```

7. **Verify HTTP/2:**

   You can use online tools or browser developer tools to verify that HTTP/2 is enabled on your website.

That's it! You've successfully enabled HTTP/2 (h2) and configured HTTP/1.1 for your Apache VirtualHost. This should improve your website's performance and security.

Feel free to adjust the paths and configurations as needed for your specific environment. This README file provides a step-by-step guide to enable HTTP/2 and configure your VirtualHost for better web performance.