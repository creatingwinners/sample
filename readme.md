<p align="center"><img src="https://www.creatingwinners.com/assets/templates/img/logo-fc.svg" width="240"></p>

## About this sample application

This is a sample application build with Laravel 5.7. It can be used for serving and managing one or more promotional websites where participants have a chance to win a price after entering a voucher code. Depending on the configuration settings the system determines if the participant has a chance to win and will randomly choose one of the prices available for that day.

- Win ratio: every X-th voucher code entry has a chance to win
- Price quantity: available amount of a certain price / day
- IP restriction:
    - IP limit: number of IP occurrences
    - IP limit duration: number of hours

## Job interview information

After receiving the URL to this repository we would like you to:

- send a screenshot of the admin environment as soon as possible
- send remarks within 4 hours with repsect to:
  - bugs
  - possible improvements
  - anything else you have to say

Thank you very much for the effort and time.


## Installation

### 1. Download
Download the files above and place on your server.

### 2. Environment Files
This package ships with a **.env.example** file in the root of the project.

You must rename this file to just **.env**

**Make** sure you have hidden files shown on your system.

### 3. Composer
Laravel project dependencies are managed through the [PHP Composer tool](http://getcomposer.org/). The first step is to install the depencencies by navigating into your project in terminal and typing this command:

``` bash
composer install
```

### 4. NPM
In order to install the Javascript packages for frontend development, you will need the [Node Package Manager](https://www.npmjs.com/). After installing NPM run:

``` bash
npm install
```

### 5. Create Database
You must create your database on your server and on your .env file update the following lines:

``` bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

Change these lines to reflect your new database settings.

### 6. Artisan Commands
The first thing we are going to so is set the key that Laravel will use when doing encryption.

``` bash
php artisan key:generate
```

You should see a green message stating your key was successfully generated. As well as you should see the **APP_KEY** variable in your **.env** file reflected.

It's time to see if your database credentials are correct.

We are going to run the built in migrations to create the database tables:

``` bash
php artisan migrate
```

You should see a message for each table migrated, if you don't and see errors, than your credentials are most likely not correct.

Now seed the database with:

``` bash
php artisan db:seed
```

You should get a message for each file seeded, you should see the information in your database tables.

### 7. NPM Run *
Now that you have the database tables and default rows, you need to build the styles and scripts.

These files are generated using [Laravel Mix](https://laravel.com/docs/5.7/mix), which is a wrapper around many tools, and works off the **webpack.mix.js** in the root of the project.

You can build with:

``` bash
npm run <command>
```

The available commands are listed at the top of the package.json file under the 'scripts' key.

You will see a lot of information flash on the screen and then be provided with a table at the end explaining what was compiled and where the files live.

At this point you are done, you should be able to hit the project in your local browser and see the project, as well as be able to log in with the administrator and view the backend.

### 8. Storage:link
After your project is installed you must run this command to link your public storage folder for user avatar uploads:

``` bash
php artisan storage:link
```

### 9. Login
After your project is installed and you can access it in a browser. To access the backend, go to domain.tld/admin:

Administrator credentials:
- Username: admin@admin.com
- Password: admin

Supervisor credentials are:
- Username: user@user.com
- Password: user
