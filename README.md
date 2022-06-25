# Trial Crawler

## Requirement

- php: 8.1.
- mysql
- [PageSpeed Insights API](https://developers.google.com/speed/docs/insights/v5/get-started).

## Step

1. register a key for PageSpeed Insights API
2. Copy env.example to .env
3. Set Settings in .env file
    - DB_HOST
    - DB_PORT
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
    - PAGESPEED_INSIGHTS_API_KEY
4. Input Command
    - composer install
    - php artisan key:generate
    - php artisan migrate
    - php artisan storage:link
    - php artisan serve --host=0.0.0.0
6. Visit 127.0.0.1:8000

