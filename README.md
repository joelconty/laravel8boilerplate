# laravel8withusernameandspatie

laravel8withusernameandspatie  is a laravel v8 boilerplate featuring username as the main user identifier instead of email. It also provides and implementation of the spatie permissions system. Additionally to the username field, it also handles first name and last name of users.

##Instructions
- Clone the project with git.
- Run composer install
- Rename the .env.example file to .env and edit it to set the proper values of variables
- Run php artisan key:generate
- (optional) If you are on linux, go to the root of the project and find  the fixdev.sh script. If you run it, it will fix permissions and ownerships of all files and directories of your project so that laravel runs just fine. Before running it, you just need to adjust a couple of variables at the beginning of the script that contain your username and your local web server group. Set those variables and then just run sudo ./fixdev.sh
- (optional) Also if you are on linux, find the clear.sh script and run it. It will clean all laravel caches. 
- Run  php artisan migrate:fresh
- Finally run php artisan create:admin. This command will create an administrator user for you. You will be asked for username, password and email.
- Login and start creating something!

Thanks



