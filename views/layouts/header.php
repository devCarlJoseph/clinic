<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dental Clinic Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0284c7;
            --primary-dark: #0369a1;
            --bg: #f8fafc;
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --dentist-badge: #0d9488;
            --patient-badge: #3b82f6;
            --receptionist-badge: #8b5cf6;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-dark);
            line-height: 1.6;
        }

        .navbar {
            background: #ffffff;
            border-bottom: 1px solid var(--border);
            padding: 16px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        .container {
            max-width: 1120px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .page-header {
            margin-bottom: 32px;
        }

        .page-header h1 {
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-dark);
        }

        .page-header p {
            color: var(--text-muted);
            margin-top: 4px;
        }

        .filter-bar {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
            flex-wrap: wrap;
            align-items: center;
        }

        .filter-btn {
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--border);
            background: #ffffff;
            color: var(--text-muted);
            transition: all 0.2s;
        }

        .filter-btn:hover, .filter-btn.active {
            background: var(--primary);
            color: #ffffff;
            border-color: var(--primary);
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
            margin-bottom: 48px;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 24px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
        }

        .badge {
            font-size: 0.75rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-dentist { background: #ccfbf1; color: var(--dentist-badge); }
        .badge-patient { background: #dbeafe; color: var(--patient-badge); }
        .badge-receptionist { background: #ede9fe; color: var(--receptionist-badge); }

        .card h3 {
            font-size: 1.15rem;
            margin-bottom: 6px;
        }

        .role-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 16px;
            min-height: 42px;
        }

        .details-box {
            background: #f1f5f9;
            padding: 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .details-row {
            display: flex;
            justify-content: space-between;
        }

        .details-label {
            color: var(--text-muted);
            font-weight: 500;
        }

        .details-value {
            font-weight: 600;
            color: var(--text-dark);
        }

        .form-section {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--border);
            padding: 28px;
            margin-top: 32px;
        }

        .form-section h2 {
            font-size: 1.25rem;
            margin-bottom: 16px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 9px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn-submit {
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
        }
    </style>
</head>
<body>

<header class="navbar">
    <div class="brand">
        DentalClinic
    </div>
    <span style="font-size: 0.85rem; color: #64748b;">OOP 2 Midterm Project</span>
</header>

<main class="container">