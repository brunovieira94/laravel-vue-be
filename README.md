# Backend Laravel Task Manager - JWT, Mail Notifications

<table>
    <tr>
        <td>
            <a href="https://laravel.com"><img src="https://i.imgur.com/pBNT1yy.png" /></a>
        </td>
        <td>
            <img src="https://i.imgur.com/Kp5kTUp.png" />
        </td>
    </tr>
</table> 


## Requirements
You need to have PHP version **8.0** or above. 

## Installation and usage
1. Clone the project
2. Go to the project root directory
3. Run `composer install`
4. Create database
5. Copy `.env.example` into `.env` file and adjust parameters
6. Run `php artisan migrate`
7. Run `php artisan jwt:secret`
8. Run `php artisan serve` to start the project at http://localhost:8000
9. Run `php artisan queue:listen` to listen to the queued notifications
10. Create admin user trough CLI:
Run `php artisan tinker` and `\App\Models\User::create(['name' => 'Admin', 'email' => 'admin@admin.com', 'password' => bcrypt('password'), 'admin' => 1]);`
11. configure .env to send mail notifications (Outlook): 
MAIL_MAILER=smtp
MAIL_HOST=smtp-mail.outlook.com
MAIL_PORT=587
MAIL_USERNAME=mail@live.com
MAIL_PASSWORD=********
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="mail@live.com"
MAIL_FROM_NAME="${APP_NAME}"
QUEUE_CONNECTION=database
