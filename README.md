# Ecommerce
![Status](https://img.shields.io/badge/Status-5%25-orange)

Laravel Ecommerce project

## Stack
- [Nginx](https://www.nginx.com/)
- [Laravel](https://laravel.com/)
- [PostgreSQL](https://www.postgresql.org/)

# Getting Started
### Prerequisites
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

### 🚀 Start app

Run sail:
```
./vendor/bin/sail up -d
```

Run:
```
./vendor/bin/sail artisan key:generate
./vendor/bin/sail npm i & dev
```

**App will be available on `localhost:80`**

### 🛑 Stop app
Stop sail:
```
./vendor/bin/sail down
```
