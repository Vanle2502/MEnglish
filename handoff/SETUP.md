# Local setup

> Dev mới nên đọc [PROJECT-CONTEXT.md](PROJECT-CONTEXT.md) trước để nắm cấu trúc source, animation hiện có và những khu vực không nên sửa.

1. Clone the repository into the local web root.
2. Create a MySQL database named `m-english` using `utf8mb4`.
3. Import `handoff/database.sql` into that database.
4. Copy `handoff/wp-config.local.example.php` to the project root as `wp-config.php`.
5. Replace the placeholder authentication salts in `wp-config.php` for any shared environment.
6. Start Apache and MySQL, then open `http://localhost/wordpress/`.
7. Open **Settings > Permalinks** and save once.

Local administrator:

```text
Username: admin
```

The handoff database does not contain a usable shared password. After importing it, set your own local password in phpMyAdmin or MySQL, then sign in:

```sql
UPDATE wp_users
SET user_pass = MD5('replace-with-your-own-local-password')
WHERE user_login = 'admin';
```

WordPress will automatically upgrade this temporary MD5 hash after the first successful login. Do not reuse a personal or production password.

The handoff database excludes Fluent Forms submissions, logs, scheduler history, webhook authentication and transient cache. Google Sheets credentials are not included and must be configured separately.
