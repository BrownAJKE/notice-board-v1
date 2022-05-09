Laravel Notice boar project:

How to setup###
1. Clone the repo to your machine
2. Run compoer install to pull in all the required dependencies
3. Run cp .env.example .env
4. Set up database, pusher(required for realtime events) in the env
5. Run php artisan key:generate
6. Run php artisan migrate --seed 
7. Run php artisan serve to start the server and login with the below credentials as admin:
    Email: admin@admin.com
    Password: 12345678

Explore the app.
