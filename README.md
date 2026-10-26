# Soluna Solar Supply & Installation — TFA6

IT0049 Technical Formative Assessment 6: **From Arrays to Eloquent**. I continued my TFA5 four-page Laravel application in a separate project and replaced its customer and user controller arrays with database records. The Soluna branding, solar imagery, colors, layouts, search, filters, and explainers are retained.

**Student:** Jian Edward A. Acob · **Section:** BSITBA - TW32
**Course:** IT0049 - Web System Technologies · **Professor:** Mr. Von Erick Magbitang

## Requirements and local setup

PHP 8.3+ with PDO SQLite, Composer, and Git. Developed with PHP 8.5.10 and Laravel 13.37.0. SQLite is a database stored in one local file; no database server or password is needed. The supplied CSS and JavaScript are served directly from `public/assets`, so npm is not required to run these pages.

```bash
git clone https://github.com/Jiyaannnn/TFA6_ACOB_IT0049.git
cd TFA6_ACOB_IT0049
composer install
cp .env.example .env
php artisan key:generate
php -r "touch('database/database.sqlite');"
php artisan migrate --seed
php artisan serve --host=127.0.0.1 --port=8086
```

Open http://127.0.0.1:8086. On the prepared local copy:

```bash
cd "/Users/jiyan/School Files/WebSys Tech/TFA6_ACOB_IT0049"
php artisan serve --host=127.0.0.1 --port=8086
```

## Pages and data flow

| Route | Controller | View |
| --- | --- | --- |
| `/` | `PageController@home` | `pages.home` |
| `/about` | `PageController@about` | `pages.about` |
| `/customers` | `CustomerController@index` | `pages.customers` |
| `/users` | `UserController@index` | `pages.users` |

A route calls a controller. `Customer::orderBy('id')->get()` or `User::orderBy('id')->get()` retrieves Eloquent models. The controller passes the collection to Blade, whose `@foreach` loop displays escaped values. Both banner counts and rows use that collection. Browser search and filters hide or show those rendered rows without modifying the database.

## Schema and sample records

| Table | TFA2 core schema | Soluna display fields retained from TFA5 |
| --- | --- | --- |
| `customers` | unsigned auto-increment `id`; `full_name` VARCHAR(100); `email` VARCHAR(100); nullable `phone` VARCHAR(20); `created_at` DATETIME | `code`, `location`, `project`, `capacity`, `status` |
| `users` | unsigned auto-increment `id`; unique `username` VARCHAR(50); `full_name` VARCHAR(100); `created_at` DATETIME | `code`, `role`, `team`, `location`, `status` |

The migration definitions follow the original TFA2 migration's field lengths, nullable phone, unique username, and created_at-only convention. SQLite does not enforce VARCHAR lengths as MySQL does. Each Eloquent model sets `UPDATED_AT = null` to match that schema. These directory records have no password or authentication functionality.

`DatabaseSeeder` supplies five customers and five users. Stable customer codes and usernames make repeated `php artisan db:seed` runs update the samples instead of duplicating them. Contacts use reserved example.com addresses and fictitious phone values. The retained rooftop photograph is an AI-generated illustrative asset; the evidence screenshots are real browser captures.

Migrations and the seeder are the reproducible database submission; no database export is needed. The local SQLite file is deliberately ignored.

## Verification actually performed

```bash
php artisan route:list --except-vendor
php artisan test --compact
vendor/bin/pint --dirty --format agent
```

- 8 tests passed, 33 assertions: four routes, missing-page 404, five rows per table, reseeding, database updates reflected in Blade, escaped HTML, null phone display, required name rejection, unique username rejection, and migration rollback/rebuild. Automated database tests use isolated in-memory SQLite.
- Browser checks: matching and nonmatching searches in both directories, customer Quotation and user Sales filters, toggling the selected team back to all rows, rooftop Crew and About Inverter explainers, mobile menu open and Escape close.
- All four pages checked at 390, 768, and 1440 pixels with no horizontal overflow; no uncaught browser errors were reported.
- Forms, uploads, checkout, authentication, and user-facing editing are outside this activity. Database insert/update/delete behavior was tested through Eloquent in the automated suite.

See [screenshot checklist](docs/SCREENSHOT_CHECKLIST.md), [presentation guide](docs/PRESENTATION_GUIDE.md), and the report in `docs/`.

## Publishing and submission

Repository: https://github.com/Jiyaannnn/TFA6_ACOB_IT0049

This submission follows the student's GitHub-only publishing instruction. The activity handout separately requests a hosted working link; no hosted application has been deployed for this submission. The local address is not a public website.

Do not commit `.env`, passwords, application keys, database files, `vendor`, `node_modules`, or runtime caches. `.env.example` contains placeholders only.
