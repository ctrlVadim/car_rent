# Car rent API

## Instalation
```
git clone git@github.com:ctrlVadim/car_rent.git
cd car_rent
composer install
cp .env.example .env
php artisan migrate --seed
docker-compose up -d
xdg-open http::127.0.0.1:50000
```


## API Documentation

### Possible responses
- 200 - success
- 404 - not found
- 403 - operation refused
- 422 - given data is not valid
- 500 - server error

### Routes

```
POST /api/car/rent - Rent car
DELETE /api/car/return - Return car
```

## Testing
Tests are requires DB connection, You should specify correct connection property in [.env](.env) file
- 127.0.0.1
```
php artisan test
```
