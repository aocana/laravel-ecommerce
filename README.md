# Laravel e-commerce

![Status](https://img.shields.io/badge/Status-80%25-orange)

Laravel e-commerce project implementing Stripe's payment gateway.
We use Meilisearch as search engine.
[View project](http://aurena.ovh:8089/)

## Technologies

- [Laravel](https://laravel.com/)
- [PostgreSQL](https://www.postgresql.org/)
- [Meilisearch](https://www.meilisearch.com/)
- [Stripe](https://stripe.com/en-es)

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

Execute script.sh:

```
./script.sh
```

**App will be available on `localhost:8089`**

### 🛑 Stop app

Stop docker:

```
docker-compose down
```
