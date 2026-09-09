<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$error = $error ?? '';
$identity = $identity ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in | Stockroom</title>
    <style>
        :root { font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #ededed; background: #050505; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; display: grid; place-items: center; background: #050505; background-image: linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px); background-size: 32px 32px; }
        .shell { width: min(100% - 32px, 440px); }
        .brand { display: flex; align-items: center; gap: 10px; margin-bottom: 28px; font-size: 15px; font-weight: 650; letter-spacing: -.02em; }
        .mark { width: 28px; height: 28px; display: grid; place-items: center; border-radius: 8px; background: #fff; color: #050505; font-weight: 900; }
        .card { padding: 36px; border: 1px solid #262626; border-radius: 12px; background: rgba(12,12,12,.94); box-shadow: 0 24px 80px rgba(0,0,0,.35); }
        h1 { margin: 0 0 9px; font-size: 28px; letter-spacing: -.04em; }
        .subtle { margin: 0 0 28px; color: #8a8a8a; line-height: 1.55; font-size: 14px; }
        label { display: block; margin: 17px 0 8px; color: #b8b8b8; font-size: 13px; }
        input { width: 100%; padding: 12px 13px; border: 1px solid #303030; border-radius: 7px; background: #0b0b0b; color: #fff; outline: 0; font: inherit; }
        input:focus { border-color: #fff; box-shadow: 0 0 0 3px rgba(255,255,255,.1); }
        button { width: 100%; margin-top: 24px; padding: 12px 14px; border: 0; border-radius: 7px; background: #fff; color: #050505; cursor: pointer; font: inherit; font-weight: 650; }
        button:hover { background: #d9d9d9; }
        .alert { margin-bottom: 16px; padding: 11px 12px; border: 1px solid #6d3030; border-radius: 7px; color: #ffb4b4; background: #261010; font-size: 13px; }
        .hint { margin: 22px 0 0; color: #666; font-size: 12px; text-align: center; }
    </style>
</head>
<body>
    <main class="shell">
        <div class="brand"><span class="mark">S</span> Stockroom</div>
        <section class="card">
            <h1>Welcome back.</h1>
            <p class="subtle">Sign in to manage your product inventory.</p>
            <?php if ($error): ?><div class="alert" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
            <form method="post" action="<?= site_url('login') ?>">
                <label for="identity">Email or username</label>
                <input id="identity" name="identity" type="text" value="<?= htmlspecialchars($identity, ENT_QUOTES, 'UTF-8') ?>" placeholder="admin@example.com or viewer" required autofocus>
                <label for="password">Password</label>
                <input id="password" name="password" type="password" placeholder="Your password" required>
                <button type="submit">Sign in</button>
            </form>
            <p class="hint">Protected inventory workspace</p>
        </section>
    </main>
</body>
</html>