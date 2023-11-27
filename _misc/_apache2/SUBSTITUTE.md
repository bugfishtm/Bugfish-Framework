# Configuring Apache with mod_substitute for Content Substitution

This guide explains how to configure Apache with `mod_substitute` directives to substitute content within specific files. The `mod_substitute` module allows you to replace text or patterns within response content served by Apache.

## Prerequisites

Before you proceed, ensure the following prerequisites are met:

- Apache web server is installed and running.
- The `mod_substitute` module is enabled.

## Procedure

Follow these steps to configure Apache with `mod_substitute` for content substitution:

1. **Enable the `substitute` Module:**

   Ensure that the `substitute` module is enabled. You can enable it using the following command:

   ```bash
   sudo a2enmod substitute
   ```

2. **Create or Edit the VirtualHost Configuration File:**

   Locate the VirtualHost configuration file for your website or application. This file is typically found in the `/etc/apache2/sites-available/` directory and has a `.conf` extension. You can create a new one if it doesn't exist.

3. **Edit the VirtualHost Configuration:**

   Inside the VirtualHost configuration file, add the `mod_substitute` directives to specify which files should have content substitution and define the substitutions:

   ```apache
   <VirtualHost *:80>
       ServerName your.domain.com
       DocumentRoot /var/www/yourwebsite

       Substitute "s/REPLACE/WITHTHISSTRING/ni"

       <Directory /var/www/yourwebsite>
           <Files "FILEPATHTOSUBSTITUTE">
               RequestHeader unset Accept-Encoding
               AddOutputFilterByType SUBSTITUTE text/html
               AddOutputFilterByType SUBSTITUTE text/css
               AddOutputFilterByType SUBSTITUTE text/javascript
               AddOutputFilterByType SUBSTITUTE text/plain
               AddOutputFilterByType SUBSTITUTE text/xml
           </Files>
       </Directory>

       # Additional VirtualHost configurations
   </VirtualHost>
   ```

   - Replace `your.domain.com` with your website's domain name.
   - Update `DocumentRoot` to the actual path of your website files.
   - Modify the `Substitute` directive to define the content substitutions you want.

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

   Test the setup by accessing the website or content specified in the `FILEPATHTOSUBSTITUTE`. The specified content substitutions should be applied as configured.

That's it! You've successfully configured Apache with `mod_substitute` directives to substitute content within specific files. Customize the paths and configurations as needed for your specific content replacement needs.

This README file provides a step-by-step guide to configure Apache with `mod_substitute` directives for content substitution within specific files. Customize the paths and substitutions as needed for your specific use case.