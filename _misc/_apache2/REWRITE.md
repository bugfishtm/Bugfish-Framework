# Configuring Apache with mod_rewrite for URL Rewriting

This guide explains how to configure Apache with `mod_rewrite` to perform URL rewriting. `mod_rewrite` is a powerful module that allows you to manipulate and modify URLs to achieve various purposes, such as redirecting, rewriting, or custom routing.

## Prerequisites

Before you proceed, ensure the following prerequisites are met:

- Apache web server is installed and running.
- The `mod_rewrite` module is enabled.

## Procedure

Follow these steps to configure Apache with `mod_rewrite` for URL rewriting:

1. **Enable the `rewrite` Module:**

   Ensure that the `rewrite` module is enabled. You can enable it using the following command:

   ```bash
   sudo a2enmod rewrite
   ```

2. **Create or Edit the VirtualHost Configuration File:**

   Locate the VirtualHost configuration file for your website or application. This file is typically found in the `/etc/apache2/sites-available/` directory and has a `.conf` extension. You can create a new one if it doesn't exist.

3. **Edit the VirtualHost Configuration:**

   Inside the VirtualHost configuration file, add the `RewriteEngine On` directive to enable URL rewriting and define your rewrite rules:

   ```apache
   <VirtualHost *:80>
       ServerName your.domain.com
       DocumentRoot /var/www/yourwebsite

       RewriteEngine On

       # Example rewrite rules
       RewriteRule ^old-page$ new-page [L]
       RewriteRule ^category/([a-zA-Z0-9-]+)$ category.php?category=$1 [L,QSA]

       # Additional VirtualHost configurations
   </VirtualHost>
   ```

   - Replace `your.domain.com` with your website's domain name.
   - Update `DocumentRoot` to the actual path of your website files.
   - Customize the `RewriteRule` directives to achieve your specific URL rewriting requirements.

4. **Save and Close the Configuration File.**

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

7. **Testing:**

   Test the setup by accessing URLs that should be affected by your rewrite rules. The URLs should be rewritten or redirected according to your configuration.

That's it! You've successfully configured Apache with `mod_rewrite` for URL rewriting. This module is a versatile tool for achieving various URL manipulation tasks and custom routing for your web application.

This README file provides a step-by-step guide to configure Apache with `mod_rewrite` for URL rewriting. Customize the rewrite rules as needed for your specific URL manipulation and routing requirements.