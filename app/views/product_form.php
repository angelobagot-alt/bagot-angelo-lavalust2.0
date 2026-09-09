<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$product = $product ?? null;
$value = static function ($key) use ($product) { $value = is_array($product) ? ($product[$key] ?? '') : ($product->{$key} ?? ''); return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8'); };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?> | Stockroom</title>
    <style>
        :root { font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif; color: #ededed; background: #050505; } * { box-sizing: border-box; } body { min-height: 100vh; margin: 0; background: #050505; background-image: linear-gradient(rgba(255,255,255,.03) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.03) 1px, transparent 1px); background-size: 32px 32px; } header { height: 68px; display: flex; align-items: center; justify-content: space-between; padding: 0 max(24px, calc((100% - 1120px) / 2)); border-bottom: 1px solid #202020; } .brand { display: flex; align-items: center; gap: 10px; font-size: 15px; font-weight: 650; } .mark { width: 28px; height: 28px; display: grid; place-items: center; border-radius: 8px; background: #fff; color: #050505; font-weight: 900; } .back { color: #999; text-decoration: none; font-size: 13px; } .back:hover { color: #fff; } main { width: min(100% - 32px, 680px); margin: 0 auto; padding: 72px 0; } .eyebrow { margin: 0 0 10px; color: #777; font-size: 12px; letter-spacing: .12em; text-transform: uppercase; } h1 { margin: 0 0 34px; font-size: 42px; letter-spacing: -.06em; } .card { padding: 32px; border: 1px solid #242424; border-radius: 10px; background: rgba(10,10,10,.9); } label { display: block; margin: 0 0 8px; color: #b8b8b8; font-size: 13px; } .field { margin-bottom: 22px; } input, textarea { width: 100%; padding: 12px 13px; border: 1px solid #303030; border-radius: 7px; outline: 0; background: #0b0b0b; color: #fff; font: inherit; } textarea { min-height: 120px; resize: vertical; } input:focus, textarea:focus { border-color: #fff; box-shadow: 0 0 0 3px rgba(255,255,255,.1); } .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; } .error { margin-bottom: 20px; padding: 11px 12px; border: 1px solid #6d3030; border-radius: 7px; color: #ffb4b4; background: #261010; font-size: 13px; } .footer { display: flex; justify-content: flex-end; gap: 12px; margin-top: 28px; } .button { padding: 11px 15px; border-radius: 7px; cursor: pointer; font: inherit; font-size: 14px; font-weight: 650; } .cancel { border: 1px solid #303030; color: #bbb; background: transparent; text-decoration: none; } .submit { border: 0; color: #050505; background: #fff; } .submit:hover { background: #d9d9d9; } @media (max-width: 560px) { header { padding: 0 18px; } main { padding: 48px 0; } .card { padding: 22px; } h1 { font-size: 34px; } .grid { grid-template-columns: 1fr; gap: 0; } }
    </style>
</head>
<body>
    <header><div class="brand"><span class="mark">S</span> Stockroom</div><a class="back" href="<?= site_url('products') ?>">Back to products</a></header>
    <main><p class="eyebrow">Inventory / Products</p><h1><?= htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') ?></h1><section class="card">
        <?php if (!empty($error)): ?><div class="error" role="alert"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
        <form method="post" action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">
            <div class="field"><label for="product_name">Product name</label><input id="product_name" name="product_name" value="<?= $value('product_name') ?>" maxlength="100" required></div>
            <div class="field"><label for="description">Description</label><textarea id="description" name="description" required><?= $value('description') ?></textarea></div>
            <div class="grid"><div class="field"><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" value="<?= $value('price') ?>" required></div><div class="field"><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= $value('quantity') ?>" required></div></div>
            <div class="footer"><a class="button cancel" href="<?= site_url('products') ?>">Cancel</a><button class="button submit" type="submit"><?= htmlspecialchars($submitLabel, ENT_QUOTES, 'UTF-8') ?></button></div>
        </form>
    </section></main>
</body>
</html>