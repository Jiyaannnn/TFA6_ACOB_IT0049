# TFA6 presentation guide

1. Open Overview. Say: “I continued my TFA5 Soluna application in a separate TFA6 folder. I kept its design and replaced the directory arrays with database records.”
2. Show `database/migrations/0001_01_01_000000_create_users_table.php` and the customer migration. Explain: “A migration describes the table in PHP. The up method creates it and down reverses it. I matched TFA2's core fields and kept extra fields for the existing Soluna interface. The username has a unique index.”
3. Show `database/seeders/DatabaseSeeder.php`. Say: “The seeder creates five sample records in each table. updateOrCreate uses a stable key so running it again does not duplicate the samples.”
4. Show `app/Models/Customer.php` and `User.php`. Say: “Eloquent maps each model to its database table. I disable updated_at because the earlier schema only has created_at.”
5. Show both account controllers. Explain `orderBy('id')->get()`: “It retrieves database rows in a consistent order. The controller sends that collection to the view. The counts come from the same records.”
6. Open Customer Accounts. Show the five rows, email and phone; search for Bayanihan; clear it; select Quotation; try a nonmatching search. Explain: “Blade renders escaped values. Search and stage filters only affect the displayed rows.”
7. Open User Accounts and select Sales. Point out full names and unique usernames. There is no login or password storage in this directory activity.
8. Open About and demonstrate Inverter. Switch to mobile width and open Menu. Explain that the four existing routes and responsive design were preserved.
9. Run `php artisan test --compact`. Explain that tests use an isolated in-memory database and cover seeding, constraint errors, escaped output, database changes, and rollback/rebuild. Do not run migrate:reset against a database you want to keep.
10. Show the GitHub README, migrations, seeder, report, and evidence. Explain that publishing was limited to GitHub by your submission scope; the handout also lists hosting, so confirm the exception with the instructor if needed.

## Commands before presenting

```bash
cd "/Users/jiyan/School Files/WebSys Tech/TFA6_ACOB_IT0049"
php artisan serve --host=127.0.0.1 --port=8086
```

Open http://127.0.0.1:8086. If the server is already running there, use the existing process. Run tests in a second terminal.

## Submission checklist

- Review your name, section, course, and professor in the report.
- Open the GitHub link and confirm the source, README, migrations, and seeder are visible.
- Submit the repository link through your class submission channel.
- Attach the DOCX report if your instructor accepts or requests supporting documentation.
- Confirm the GitHub-only exception because the supplied handout also asks for a hosted working link.
