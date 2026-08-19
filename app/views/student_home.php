<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <title><?= $title ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', 'Segoe UI', Arial, sans-serif;
            background: #f4f5f7;
            color: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 48px 44px;
            width: 380px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
        }
        .badge {
            display: inline-block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4f46e5;
            background: #eef2ff;
            padding: 4px 10px;
            border-radius: 20px;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 6px;
            letter-spacing: -0.3px;
        }
        p {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 28px;
        }
        nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        nav a {
            display: block;
            text-decoration: none;
            color: #111827;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 14px;
            font-weight: 500;
            text-align: left;
            transition: all 0.15s ease;
        }
        nav a:hover {
            background: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="card">
        <span class="badge"> BAGOT</span>
        <h1>Welcome to My Student Page</h1>
        <p>Student Information System</p>
        <nav>
            <a href="<?= site_url('student') ?>">Home</a>
            <a href="<?= site_url('student/profile') ?>">Student Profile</a>
            <a href="<?= site_url('student/grant_access') ?>">Grant Access</a>
        </nav>
    </div>
</body>
</html>