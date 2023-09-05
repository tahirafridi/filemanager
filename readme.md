[![N|Solid](https://filemanager.tahirafridi.com/images/logo-wide.svg)](https://filemanager.tahirafridi.com/)
# TK File Manager
## A self-host file manager
A self-host file manager built for file hosting.

## Features
- Self hosted and independent file manager.
- Unlimited file uploads/downloads accordingly to your server specs.
- Manual and remote uploads.
- Signed sharing temporary URLs, after certain time(minutes) it will be expired and can not be use anymore.
- You can create folders and upload files there.
- Your bandwidth will be no more stolen by your competitors due to singed URLs, no more hot-link protection.

## Tech
TK file manager uses a number of open source projects to work properly:

- [Laravel] - The PHP Framework
for Web Artisans.
- [Livewire] - A full-stack framework for Laravel that takes the pain out of building dynamic UIs.
- [Admin LTE] - AdminLTE Bootstrap Admin Dashboard Template.
- [Bootstrap] - Build fast, responsive sites with Bootstrap.
- [Alpine.js] - Your new, lightweight, JavaScript framework.
- [jQuery] - jQuery is a fast, small, and feature-rich JavaScript library.

## Installation

You can install TK Filemanger easily by following the below simple steps;

Navigate to your working/project directory
```sh
cd /home/username/public_html
OR 
cd  /home/username/wwww
```

Clone the project from GitHub using the following command, notice the period (.) in the end, it means the project will be cloned in the current directory without creating a project directory again.
```sh git  
clone https://github.com/tahirafridi/filemanager.git .
```

Rename .env.sample file to .env
```sh
mv .env.sample .env
```

Edit .env file using nano command and update the following details;
```sh
nano .env
```
Change APP_URL to your project base URL.
Update the database details.

Run composer update
```sh
composer update
```

Generate APP_KEY by using below command;
```sh
php artisan key:generate
```

Run migration command to generate database tables and seed data
```sh
php artisan migrate --seed
```

Go to your project URL for example http://filemanager.test/login
Use below credentials to login
Email: admin@example.com
Password: 123123

## License

MIT

**Free Software, Hell Yeah!**

   [Laravel]: <https://laravel.com>
   [Livewire]: <https://livewire.laravel.com>
   [Admin LTE]: <https://adminlte.io>
   [Bootstrap]: <https://getbootstrap.com>
   [Alpine.js]: <https://alpinejs.dev>
   [jQuery]: <http://jquery.com>
