# Knowledge City Test Sunny

Main technologies used: `PHP, MySQL, JSON Web Tokens`

## QUICK INSTALL:

### Pre Requisite:

- PHP.
- MySQL.
- JWT

### configure base URL:

Edit and complete configuration file: api/config/core.php Below lines For example:

```
$siteURL = "http://localhost/kc-test-task";
```

### Configure the connection data with MySQL.

Edit and complete configuration file: api/config/database.php Below lines For example:

```
$host = '127.0.0.1'
$db_name = 'citytest_db'
$username = 'root'
$password = ''
```
### Dummy User Credentials.

```
$username = 'sunny91189'
$password = '12345'
```

## API DOCUMENTATION:

### ENDPOINTS:

- Validate Token: `POST /validate_token.php`

- Login User: `POST /login.php`

- User List: `POST /liststudents.php`