# University

This app allows students to add data on the site. 


## Requirements

* PHP ^7.3|^8.0"
* Composer

## How to Deploy

1. Cloning repository: `git clone https://github.com/0Jac0k19D01rupal0/Organizer.git`
2. Create your own database and config .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

3. Create your own OneSignal account on https://app.onesignal.com/signup and config .env:

ONESIGNAL_APP_ID=your_APP_ID
USER_AUTH_KEY=your_AUTH_KEY
ONESIGNAL_REST_API_KEY=your_REST_API_KEY

4. Run `npm run install && npm run dev`
5. Update composer `composer update`
6. Installing composer packages `composer install`
7. Make migrate `php artisan migrate`
8. Start local server and start scripts: 

`php artisan serve`
`npm run watch`

10. Go to your site.


## How load fixtures

`php artisan tinker`
`\App\Models\EventFactory::factory()->times(10)->create();`
