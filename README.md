# amba-news
lorem ipsu kolor

## Getting Started

### Step1: Clone Project
```bash
git clone https://github.com/Rizz404/amba-news
cd rekomendasi-laptop
```

### Step2: Install Dependencies
```bash
composer install
npm install
npm run build
```

### Step3: Add Requirement
```bash
copy .env.example .env
```
or
```bash
cp .env.example .env
```

```bash
php artisan key:generate
php artisan storage:link
php artisan migrate:fresh --seed
```

## How to Run
```bash
php artisan serve
```
or
```bash
composer run dev
```