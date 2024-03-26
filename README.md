# Start
```
docker-compose up --build -d
```

```
docker-compose exec php composer install
```

```
cp .env.example .env
```

В .env заменить DB_* на
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=test_moonshine
DB_USERNAME=test_moonshine
DB_PASSWORD=secret
```

```
docker-compose exec php php artisan key:generate 
```

```
docker-compose exec php php artisan migrate --seed
```

# Create admin

```
docker-compose exec php php artisan moonshine:user
```

# Login
http://localhost:8080/admin
