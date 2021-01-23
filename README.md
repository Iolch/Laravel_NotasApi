# About this repository 

## How to get it running

To run this project, you will need php on your machine! Also composer. You can checkout how to install all you need to run a laravel project in [here](https://laravel.com/docs/8.x/installation). With that out of the way, you only need to follow these steps:

```
composer install
cp .env.example .env
php artisan key:generate
```
### Setup your .env file

Now you can specify your database and a project name. Besides that, since this project uses spotify and genius api, you need to add some extra information. Make sure to add `SPOTIFY_CLIENT_ID`, `SPOTIFY_CLIENT_SECRET`, `SPOTIFY_REDIRECT_URL`, `GENIUS_CLIENT_ID`, `GENIUS_CLIENT_SECRET`, `GENIUS_ACCESS_TOKEN` to your .env. You can get a hold of those tokens [here](https://developer.spotify.com/documentation/general/guides/authorization-guide/) for spotify and [here](https://docs.genius.com/) for genius.


### Final steps

Just run your migrations and you're free to serve your project!

```
php artisan migrate
php artisan serve
```
