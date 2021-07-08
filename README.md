# Demystify OAuth2

this application aims to help understand oAuth2.

## Deployment
1. Start the containers `docker-compose up -d`
2. If you plan to use the users dashboard, showing created authorization codes for demonstration: extend the `.env` file with your [pusher](https://dashboard.pusher.com/accounts/sign_in)  details.
```dotenv
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1
```
3. enter into docker shell: `docker-compose exec -it app` and run migrations `php artisan migrate`

## Development

### Tests
run `php artisan test`