# Technical task

## Technology

This project has been developed with:
 - Authentication (Fortify and Sanctum).
 - Some level of testing to demonstrate TDD testing ability.  
 - Custom abstracted filter for transaction list query strings.
 - Form Requests to validate inputs and check token abilities for security.
 - Events and Listeners that handle the emailing and logging of transaction. 
 - Transactional database interaction to prevent data corruption.
 - Minimal or no comments as a design chose as the code should be verbose and statically typed.

## Installation & setup

---
**NOTE**

This project depends on the host running a MacOS, Linux or WSL2 environment with PHP.

---

#### Clone the repository and change into the project directory
```
git clone git@github.com:nathandaly/accounting-api.git
cd accounting-api
```
Copy the example `.env`
```
cp .env.example .env
```
#### Installing dependencies
```
composer install
```

---
**NOTE**

If your host system is not running PHP 8 then you will need to add `--ignore-platform-reqs`. to the composer command.

---

Once the PHP and node dependencies have been resolved you can run the [Sail](https://laravel.com/docs/8.x/sail#introduction) containers.

```
export APP_PORT=8080 && ./vendor/bin/sail up -d
```
This command will normally take few minutes and will download and build the required containers.

### Database migration and seeding
The project contains migration for the database structure as well as a `DotFive` user and example data which you can seed.
```
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
```

### :tada: Up and running :tada:
That should be all that is necessary for the application to be usable.
A Postman collection has been provided at the root of the project for test purposes.
#### Test credentials
```
email: test@pilon.co.uk
password: password
```

### Testing

All tests have been written using PESTPHP which is compatible with PHPUnit.
```
sail artisan test
```
or
```
sail composer test
```

### Todos:

If I had more time:
- [ ] Implement additional tests for add and delete.
