# 🧪 Random Test Project

A small, PSR-compliant PHP project using Symfony components to generate random strings and arrays, encode them using ROT13, and output the results via both a command-line interface (CLI) and a web interface. Fully test-covered and ready to extend.

---

## 🚀 Features

- 🔠 Random string generator (a–z, 0–9)
- 🧮 Random array generator
- 🔁 ROT13 encoding (string and array)
- ⚙️ Dependency Injection via Symfony DI component
- ✅ Unit-tested with PHPUnit
- 🌐 Web UI with Twig templating

---

## ⚙️ Requirements

- PHP 8.1 or higher
- Composer 2.5 or newer
- Web server (optional: for testing web output)

---

## 📦 Installation

```bash
git clone https://github.com/Konservin/random_test.git
cd random_test
composer install
```

## Usage
php bin/console random [length] [count]
## Example
php bin/console random 20 5

## Usage (web)
php -S localhost:8000 -t public
## Then visit:
http://localhost:8000

## tests
vendor/bin/phpunit --testdox

