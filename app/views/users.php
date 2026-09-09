<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$users = $users ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        :root { color-scheme: light; font-family: Arial, sans-serif; }
        body { margin: 0; background: #f3f4f6; color: #1f2937; }
        main { max-width: 1100px; margin: 48px auto; padding: 0 20px; }
        h1 { margin-bottom: 8px; }
        p { color: #6b7280; }
        .table-wrap { overflow-x: auto; background: #fff; border: 1px solid #d1d5db; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; min-width: 680px; }
        th, td { padding: 14px 16px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #111827; color: #fff; font-size: 13px; text-transform: uppercase; }
        tr:last-child td { border-bottom: 0; }
        tbody tr:hover { background: #f9fafb; }
        .empty { text-align: center; color: #6b7280; }
    </style>
</head>
<body>
    <main>
        <h1>User Management</h1>
        <p>Users retrieved from the database.</p>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr><td class="empty" colspan="5">No users found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $user): ?>
                            <?php
                            $userId = is_array($user) ? ($user['id'] ?? '') : ($user->id ?? '');
                            $firstname = is_array($user) ? ($user['firstname'] ?? '') : ($user->firstname ?? '');
                            $lastname = is_array($user) ? ($user['lastname'] ?? '') : ($user->lastname ?? '');
                            $email = is_array($user) ? ($user['email'] ?? '') : ($user->email ?? '');
                            $username = is_array($user) ? ($user['username'] ?? '') : ($user->username ?? '');
                            ?>
                            <tr>
                                <td><?= htmlspecialchars((string) $userId, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $firstname, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $lastname, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $email, ENT_QUOTES, 'UTF-8') ?></td>
                                <td><?= htmlspecialchars((string) $username, ENT_QUOTES, 'UTF-8') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
