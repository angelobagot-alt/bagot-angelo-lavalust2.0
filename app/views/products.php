<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$products = $products ?? [];
$flash = $flash ?? '';
$isAdmin = ($_SESSION['auth_user']['role'] ?? '') === 'admin';
$esc = static fn ($value) => htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | Stockroom</title>
    <style>
        :root { font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #ededed; background: #050505; }
        * { box-sizing: border-box; }
        body { min-height: 100vh; margin: 0; background: #050505; background-image: linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px); background-size: 32px 32px; }
        header { height: 68px; display: flex; align-items: center; justify-content: space-between; padding: 0 max(24px, calc((100% - 1120px) / 2)); border-bottom: 1px solid #202020; background: rgba(5,5,5,.9); }
        .brand { display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 650; letter-spacing: -.02em; }
        .mark { width: 28px; height: 28px; display: grid; place-items: center; border-radius: 8px; background: #fff; color: #050505; font-weight: 900; }
        .userbar { display: flex; align-items: center; gap: 16px; color: #888; font-size: 13px; }
        .logout { padding: 7px 11px; border: 1px solid #303030; border-radius: 6px; color: #ccc; background: transparent; cursor: pointer; font: inherit; }
        .logout:hover { border-color: #666; color: #fff; }
        main { width: min(100% - 48px, 1120px); margin: 0 auto; padding: 72px 0; }
        .heading { display: flex; align-items: end; justify-content: space-between; gap: 24px; margin-bottom: 34px; }
        .eyebrow { margin: 0 0 10px; color: #777; font-size: 12px; letter-spacing: .12em; text-transform: uppercase; }
        h1 { margin: 0; font-size: clamp(32px, 5vw, 52px); letter-spacing: -.06em; line-height: 1; }
        .subtle { margin: 14px 0 0; color: #888; font-size: 14px; }
        .primary { display: inline-flex; align-items: center; gap: 8px; padding: 11px 15px; border-radius: 7px; color: #050505; background: #fff; text-decoration: none; font-size: 14px; font-weight: 650; white-space: nowrap; }
        .primary:hover { background: #d9d9d9; }
        .alert { margin-bottom: 20px; padding: 12px 14px; border: 1px solid #235b3b; border-radius: 7px; color: #a6e3bc; background: #0c2417; font-size: 13px; }
        .table-wrap { overflow-x: auto; border: 1px solid #242424; border-radius: 10px; background: rgba(10,10,10,.9); }
        table { width: 100%; min-width: 720px; border-collapse: collapse; }
        th, td { padding: 17px 20px; text-align: left; border-bottom: 1px solid #202020; }
        th { color: #777; font-size: 11px; font-weight: 600; letter-spacing: .1em; text-transform: uppercase; }
        td { color: #c7c7c7; font-size: 14px; }
        tr:last-child td { border-bottom: 0; }
        .name { color: #fff; font-weight: 600; }
        .description { max-width: 340px; color: #888; }
        .price { color: #fff; font-variant-numeric: tabular-nums; }
        .stock { display: inline-block; min-width: 30px; padding: 4px 7px; border-radius: 5px; background: #1c1c1c; color: #ddd; text-align: center; font-size: 12px; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .action { color: #aaa; text-decoration: none; font-size: 13px; }
        .action:hover { color: #fff; }
        .delete { padding: 0; border: 0; color: #a76a6a; background: transparent; cursor: pointer; font: inherit; }
        .empty { padding: 50px; color: #777; text-align: center; }
        @media (max-width: 640px) { header { padding: 0 18px; } .userbar span { display: none; } main { width: min(100% - 32px, 1120px); padding: 48px 0; } .heading { align-items: start; flex-direction: column; } }
    </style>
</head>
<body>
    <header>
        <div class="brand"><span class="mark">S</span> Stockroom</div>
        <div class="userbar"><span><?= $esc($_SESSION['auth_user']['identity'] ?? 'Authenticated user') ?> · <?= $isAdmin ? 'Administrator' : 'Read only' ?></span><form method="post" action="<?= site_url('logout') ?>"><button class="logout" type="submit">Sign out</button></form></div>
    </header>
    <main>
        <div class="heading">
            <div><p class="eyebrow">Inventory / Products</p><h1>Product management</h1><p class="subtle">Keep your catalog accurate and ready to ship.</p></div>
            <?php if ($isAdmin): ?><a class="primary" href="<?= site_url('products/create') ?>"><span>+</span> Add product</a><?php endif; ?>
        </div>
        <?php if ($flash): ?><div class="alert" role="status"><?= $esc($flash) ?></div><?php endif; ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Stock</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!$products): ?><tr><td class="empty" colspan="5">No products yet. Add your first item to begin.</td></tr>
                <?php else: foreach ($products as $product): ?>
                    <?php $id = is_array($product) ? ($product['id'] ?? '') : ($product->id ?? ''); $name = is_array($product) ? ($product['product_name'] ?? '') : ($product->product_name ?? ''); $description = is_array($product) ? ($product['description'] ?? '') : ($product->description ?? ''); $price = is_array($product) ? ($product['price'] ?? 0) : ($product->price ?? 0); $quantity = is_array($product) ? ($product['quantity'] ?? 0) : ($product->quantity ?? 0); ?>
                    <tr><td class="name"><?= $esc($name) ?></td><td class="description"><?= $esc($description) ?></td><td class="price">$<?= number_format((float) $price, 2) ?></td><td><span class="stock"><?= $esc($quantity) ?></span></td><td><?php if ($isAdmin): ?><div class="actions"><a class="action" href="<?= site_url('products/edit/' . (int) $id) ?>">Edit</a><form method="post" action="<?= site_url('products/delete/' . (int) $id) ?>" onsubmit="return confirm('Delete this product?');"><button class="action delete" type="submit">Delete</button></form></div><?php else: ?><span class="action">View only</span><?php endif; ?></td></tr>
                <?php endforeach; endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>