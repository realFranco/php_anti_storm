# php_anti_storm


## Description
A uncomplete REST-API to learn php! 
Follow the UML-ERD ot the folder *utils/* and watch the target.

## Development Stack
For this "future" REST-API I will this set of tecnologies:

- PostgresSQL
- PHP
- Nginx


## Instructions

**Before start:** if you have not set the development stack described bellow
watch this [link](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-20-04#step-6-—-testing-database-connection-from-php-(optional)]) in case that you miss some configurations.
<br>

1. Clone the repo.
2. If you clone this repo outside of the folder to serve flies using nginx.

        # The folder /var/www/html it is my actual folder to listen the localhost 
        $ sudo cp -r php_anti_storm/ /var/www/html # or mv instead of cp
        #
        # This command will let you use your code editor without sudo requirements
        # after editions on the project files
        $ sudo chown -R $USER:$USER php_anti_storm/

3. Copy this tiny config file for nginx or follow the exact same config file 
        described at the **Before start** link.

        $ cd /etc/nginx/sites-avaliable/
        $ sudo nano local_php
        # And paste this tiny config:

        server {
            listen 80;

            root /var/www/html;
            server_name localhost;

            index index.php index.html index.htm;

            location ~ \.php$ {
                include snippets/fastcgi-php.conf;
                fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
            } 
        }

        # Save and close the file

        # Make a link between files
        sudo ln -s /etc/nginx/sites-available/local_php /etc/nginx/sites-enabled/

4. Af the same folder, edit a file named default

        # If you watch this config. section, 
        # pass PHP scripts to FastCGI server
        #
        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
        
            # With php-fpm (or other unix sockets):
            fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
            # With php-cgi (or other tcp sockets):
            # fastcgi_pass 127.0.0.1:9000;
        }

5. Active your nginx reverse-server

        # I not enjoy apache2, so
        $ sudo service nginx start | restart | stop 

6. Ready to go (finally).

    Wath the index file at [localhost/php_anti_storm](http://localhost/php_anti_storm)

## Note:

For some reasong that I do not well (for the moment). 
The config file present in this readme, it is not working well on 
*Vivaldi Web Browser* when i request .php files.

