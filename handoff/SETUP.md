# Local setup

1. Clone the repository into the local web root.
2. Create a MySQL database named `m-english` using `utf8mb4`.
3. Import `handoff/database.sql` into that database.
4. Copy `handoff/wp-config.local.example.php` to the project root as `wp-config.php`.
5. Replace the placeholder authentication salts in `wp-config.php` for any shared environment.
6. Start Apache and MySQL, then open `http://localhost/wordpress/`.
7. Open **Settings > Permalinks** and save once.

Temporary local administrator:

```text
Username: admin
Password: change-me-now
```

Change this password immediately after the first login.

The handoff database excludes Fluent Forms submissions, logs, scheduler history, webhook authentication and transient cache. Google Sheets credentials are not included and must be configured separately.
