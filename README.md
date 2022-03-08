# Laravel e-commerce
![Status](https://img.shields.io/badge/Status-5%25-orange)

Laravel e-commerce project

## Stack
- [Laravel](https://laravel.com/)
- [PostgreSQL](https://www.postgresql.org/)
- [PEST](https://pestphp.com/)
# Getting Started
### Prerequisites
- [Composer](https://getcomposer.org/)
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

### Installation
Clone repository:
```
git clone https://github.com/ocania/laravel-ecommerce.git
cd laravel-ecommerce
```

Create .env file and edit
```
cp .env.example .env
```

Run composer install:
```
composer install
```

### 🚀 Start app

Run sail:
```
vendor/bin/sail up -d
```

Run:
```
vendor/bin/sail artisan key:generate
vendor/bin/sail npm i && dev
```

**App will be available on `localhost:80`**

### 🛑 Stop app
Stop sail:
```
vendor/bin/sail down
```


### Recommended alias
```
alias sail="[ -f sail ] && bash sail || bash vendor/bin/sail"
```
