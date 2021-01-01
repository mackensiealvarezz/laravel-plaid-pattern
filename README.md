# Plaid Pattern - TALL Stack

This web application is a copy of Plaid demo application but written using the TALL stack. (Laravel, Livewire, Tailwind and Alpine). I couldn't find any good demos that were using Laravel as the backend, so I decided to recreate Plaid demo application. This application uses **Laravel echo and Pusher** to update the frontend.

## Installing

After cloning this project, make sure to add these values to your .env file

    PUSHER_APP_ID="your_pusher_app_id"
    PUSHER_APP_KEY="your_pusher_key"
    PUSHER_APP_SECRET="your_pusheer_secret"
    PUSHER_APP_CLUSTER="your_cluster"
    MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
    MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
    
    PLAID_CLIENT_ID="your_client_id"
    PLAID_SECRET="your_secret"
    PLAID_ENV="sandbox"
    MIX_PLAID_CLIENT_ID="${PLAID_CLIENT_ID}"
    MIX_PLAID_SECRET="${PLAID_SECRET}"

After adding your secrets make sure to reset the config cache

    php artisan cache:clear
    php aritsan config:clear
    php artisan config:cache

## Run migrations
Make sure to run migrations before running the application. This will setup all the tables needed to run the application.

    php artisan migrate

## Important
This application uses Web-hooks to update the frontend and display alerts once transactions have been updated. You will need to expose the application to the public in order for this to work. I recommend using [Expose](https://github.com/beyondcode/expose) to do this. 

After installing expose, just run

    # in the root of your project :) 
    expose

## Todo
Testing for the livewire components. 

## Contribute
Feel free to create a pull-request :) 
