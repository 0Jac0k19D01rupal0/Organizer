# Organizer

This app allows users to create events on the site and get push notification when event start. 


## Requirements

* PHP 7.4
* Composer
* Node js 12.22.4
* NPM 6.14.14

## How to Deploy

1. Cloning repository: `git clone https://github.com/0Jac0k19D01rupal0/Organizer.git`
2. Rename .env.example: mv .env.example .env
3. Create your own database and config .env:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

4. Create your own OneSignal account on https://app.onesignal.com/signup, config OneSiganal by https://documentation.onesignal.com/docs/web-push-quickstart and config .env:

ONESIGNAL_APP_ID=your_APP_ID
USER_AUTH_KEY=your_AUTH_KEY
ONESIGNAL_REST_API_KEY=your_REST_API_KEY

5. Run `npm install && npm run dev`
6. Installing composer packages `composer install`
7. Make migrate `php artisan migrate`
8. Start local server and start scripts: 

`php artisan serve`
`npm run watch`

9. Go to your site.
http://127.0.0.1:8000

## How load fixtures

`php artisan tinker`
`\App\Models\Event::factory()->times(10)->create();`
`\App\Models\User::factory()->times(10)->create();`

