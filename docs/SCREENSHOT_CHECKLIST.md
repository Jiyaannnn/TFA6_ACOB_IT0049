# TFA6 screenshot checklist

All figures are real captures from the application running at http://127.0.0.1:8086 on October 26, 2026. Desktop viewport: 1440 × 1000. Mobile viewport: 390 × 844. Scroll position intentionally focuses the relevant evidence.

| Figure | Page and source file | What must be visible | Caption | Explanation |
| --- | --- | --- | --- | --- |
| 1 | `/` · evidence/01-overview.png | Soluna navigation, hero, solar image | Overview page | I retained the TFA5 branding and four-page workspace. |
| 2 | `/customers` · evidence/02-customers.png | Five names, contact fields, project details | Customer accounts from Eloquent | I display the seeded database records through the Customer model and Blade. |
| 3 | `/users` · evidence/03-users.png | Five full names and unique usernames | User accounts from Eloquent | I retain the earlier users while retrieving their records from the database. |
| 4 | `/about` · evidence/04-about.png | Student profile and TFA6 explanation | About page and student profile | I identify the developer and explain migrations, seeders, and models. |
| 5 | `/customers` · evidence/05-stage-filter.png | Quotation result, one row and count | Customer stage filter | I filter the rendered database records to the matching project stage. |
| 6 | `/customers` · evidence/06-empty-search.png | Nonmatching search, zero count, empty message | Search with no matching accounts | I show a helpful empty result without changing stored data. |
| 7 | `/` · evidence/07-mobile-overview.png | Compact navigation and responsive hero | Mobile overview | I retain a readable layout at 390 pixels. |
| 8 | `/` · evidence/08-mobile-menu.png | Open menu with four links | Open mobile navigation | I can navigate between all four pages on a narrow screen. |

The handout does not require code screenshots. The report uses formatted source excerpts instead. Migrations, models, seeder, and automated tests are available as raw source in the repository.
