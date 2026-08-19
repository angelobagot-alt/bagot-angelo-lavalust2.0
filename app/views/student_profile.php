<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <style>
        :root {
            --bg: #ffffff;
            --line: #1a1a1a;
            --muted: #8a8a8a;
            --accent: #ff5a1f;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: var(--bg);
            color: #111;
            min-height: 100vh;
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 22px 48px;
            border-bottom: 2px solid var(--line);
        }
        .brand {
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .brand span { color: var(--accent); }
        nav a {
            margin-left: 20px;
            text-decoration: none;
            color: #111;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding-bottom: 4px;
            border-bottom: 2px solid transparent;
        }
        nav a:hover,
        nav a.active {
            border-bottom-color: var(--accent);
        }

        main {
            display: flex;
            justify-content: center;
            padding: 60px 20px;
        }
        .sheet {
            width: 440px;
        }
        .tag {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 10px;
        }
        .name {
            font-size: 30px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }
        .sub {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 32px;
        }
        .field {
            display: flex;
            padding: 14px 0;
            border-top: 1px solid #eaeaea;
        }
        .field:last-of-type {
            border-bottom: 1px solid #eaeaea;
        }
        .field .k {
            width: 130px;
            flex-shrink: 0;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--muted);
            padding-top: 2px;
        }
        .field .v {
            font-size: 15px;
            font-weight: 500;
        }
        .actions {
            margin-top: 32px;
            display: flex;
            gap: 12px;
        }
        .actions a {
            text-decoration: none;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            padding: 12px 22px;
            border: 2px solid var(--line);
            color: var(--line);
        }
        .actions a:hover {
            background: var(--line);
            color: #fff;
        }
        .actions a.primary {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
        }
        .actions a.primary:hover {
            background: #e64f16;
            border-color: #e64f16;
        }
    </style>
</head>
<body>
    <header>
        <div class="brand">Student<span>.ANGELO</span></div>
        <nav>
            <a href="<?= site_url('student') ?>">Home</a>
            <a class="active" href="<?= site_url('student/profile') ?>">Profile</a>
        </nav>
    </header>

    <main>
        <div class="sheet">
            <div class="tag">Student Record</div>
            <div class="name"><?= $name ?></div>
            <div class="sub"><?= $course ?> — <?= $year ?></div>

            <div class="field"><div class="k">Student ID</div><div class="v"><?= $student_id ?></div></div>
            <div class="field"><div class="k">Course</div><div class="v"><?= $course ?></div></div>
            <div class="field"><div class="k">Year Level</div><div class="v"><?= $year ?></div></div>
            <div class="field"><div class="k">Section</div><div class="v"><?= $section ?></div></div>
            <div class="field"><div class="k">Email</div><div class="v"><?= $email ?></div></div>

            <div class="actions">
                <a href="<?= site_url('student') ?>">Home</a>
                <a class="primary" href="<?= site_url('student/grant_access') ?>">Grant Access</a>
            </div>
        </div>
    </main>
</body>
</html>