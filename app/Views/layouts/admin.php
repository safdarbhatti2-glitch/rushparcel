<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($title ?? 'Rush Parcel — Admin Control Centre') ?></title>
    <style>
        :root {
            --n: #050d1b;
            --n2: #091a31;
            --b: #079df2;
            --c: #2bdcff;
            --i: #102036;
            --m: #71839a;
            --bg: #f4f7fb;
            --w: #fff;
            --l: #e1e8f0;
            --g: #16b98a;
            --o: #ff8a3d;
            --v: #8b62ff;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font: 13px Inter, system-ui, -apple-system, sans-serif; color: var(--i); background: var(--bg); }
        button, input, select, textarea { font: inherit; }
        a { color: inherit; text-decoration: none; }

        .app { min-height: 100vh; display: flex; }
        
        /* Sidebar Navigation */
        .side {
            width: 245px; position: fixed; inset: 0 auto 0 0;
            background: linear-gradient(180deg, #040b18, #091a30); color: #91a7bf;
            border-right: 1px solid #18314d; display: flex; flex-direction: column; z-index: 100;
        }
        .brand {
            height: 82px; padding: 0 23px; display: flex; align-items: center; gap: 10px;
            color: #fff; font-weight: 950; letter-spacing: -.04em; border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .logo {
            width: 38px; height: 38px; border-radius: 11px;
            background: linear-gradient(135deg, #12adff, #0759d5);
            display: grid; place-items: center; box-shadow: 0 0 28px rgba(7,157,242,0.27);
            font-size: 11px; font-weight: 900; color: #fff;
        }
        .brand small { display: block; color: #6184a8; font-size: 7px; letter-spacing: .14em; margin-top: 3px; }

        .nav { padding: 20px 13px; display: grid; gap: 6px; }
        .nav a, .nav button {
            border: 1px solid transparent; background: transparent; color: #91a7bf; text-align: left;
            padding: 12px 13px; border-radius: 10px; display: flex; gap: 12px; align-items: center;
            font-size: 11px; font-weight: 750; cursor: pointer; transition: 0.2s; text-decoration: none;
        }
        .nav a:hover, .nav button:hover { color: #fff; background: rgba(255,255,255,0.05); }
        .nav a.active, .nav button.active {
            color: #fff; background: rgba(11,157,242,0.09); border-color: rgba(11,157,243,0.18);
            box-shadow: inset 3px 0 var(--b);
        }
        .nav .icon { width: 19px; text-align: center; color: #5f8eb7; font-size: 14px; }
        .nav .active .icon { color: var(--c); }

        .user { margin-top: auto; padding: 16px; border-top: 1px solid rgba(255,255,255,0.08); }
        .userbox { display: flex; gap: 9px; align-items: center; padding: 10px; background: rgba(255,255,255,0.04); border-radius: 10px; }
        .ava { width: 32px; height: 32px; border-radius: 9px; background: #12304e; color: var(--c); display: grid; place-items: center; font-size: 10px; font-weight: 900; }
        .user b { font-size: 10px; color: #fff; display: block; }
        .user span { display: block; font-size: 8px; color: #6d86a0; margin-top: 2px; }

        /* Main Content Layout */
        .main { margin-left: 245px; width: calc(100% - 245px); min-height: 100vh; }
        .top {
            height: 80px; background: #fff; border-bottom: 1px solid var(--l);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 32px; position: sticky; top: 0; z-index: 50;
        }
        .title h1 { margin: 0; font-size: 20px; letter-spacing: -.04em; color: var(--n2); }
        .title p { margin: 4px 0 0; color: var(--m); font-size: 10px; }
        .topright { display: flex; gap: 10px; align-items: center; }
        .search { width: 220px; border: 1px solid var(--l); border-radius: 9px; background: #fafcff; padding: 10px 12px; outline: 0; font-size: 11px; }
        .search:focus { border-color: var(--b); background: #fff; }
        
        .btn { border: 0; border-radius: 9px; padding: 10px 16px; font-size: 11px; font-weight: 850; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: 0.2s; }
        .btn.btn-outline { background: #fff; border: 1px solid var(--l); color: var(--i); }
        .btn.btn-outline:hover { background: #f4f7fa; }
        .btn.primary { background: linear-gradient(135deg, #10a9fb, #075fd6); color: #fff; box-shadow: 0 10px 25px rgba(7,157,242,0.25); }
        .btn.primary:hover { transform: translateY(-1px); box-shadow: 0 14px 28px rgba(7,157,242,0.35); }

        .content { padding: 28px 32px; }

        .head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 18px; }
        .kick { font-size: 8px; color: #078fda; font-weight: 950; letter-spacing: .15em; text-transform: uppercase; }
        .head h2 { margin: 5px 0 0; font-size: 18px; color: var(--n2); }
        .muted { font-size: 10px; color: var(--m); }

        .cards { display: grid; grid-template-columns: repeat(4, 1fr); gap: 14px; margin-bottom: 20px; }
        .card { background: #fff; border: 1px solid var(--l); border-radius: 14px; box-shadow: 0 16px 45px rgba(7,24,48,0.04); }
        .metric { padding: 20px; position: relative; overflow: hidden; }
        .metric:after { content: ""; position: absolute; width: 65px; height: 65px; border-radius: 50%; right: -28px; top: -28px; background: rgba(7,157,242,0.05); }
        .metric label { font-size: 8px; color: #788ba0; letter-spacing: .08em; text-transform: uppercase; font-weight: 700; }
        .metric strong { display: block; font-size: 28px; letter-spacing: -.06em; margin-top: 8px; color: var(--n2); font-weight: 900; }
        .metric small { font-size: 9px; color: #8c9bab; margin-top: 4px; display: block; }
        .trend { float: right; color: var(--g); font-size: 9px; font-weight: 900; }

        .two { display: grid; grid-template-columns: 1.4fr .8fr; gap: 16px; margin-bottom: 20px; }
        .panel { padding: 22px; }
        .panel h3 { margin: 0; font-size: 13px; color: var(--n2); }
        
        .chart { height: 230px; display: flex; align-items: flex-end; gap: 14px; padding: 20px 8px 4px; }
        .bw { flex: 1; height: 100%; display: flex; align-items: center; flex-direction: column; justify-content: flex-end; gap: 6px; }
        .bar { width: 65%; max-width: 44px; border-radius: 7px 7px 2px 2px; background: linear-gradient(#25c9ff, #0878df); min-height: 8px; transition: 0.3s; }
        .bar:hover { filter: brightness(1.1); transform: scaleY(1.03); transform-origin: bottom; }
        .barlabel { font-size: 9px; color: #8b9aaa; font-weight: 700; }

        .ringbox { height: 230px; display: grid; place-items: center; position: relative; }
        .ring { width: 150px; height: 150px; border-radius: 50%; background: conic-gradient(var(--b) 0 48%, var(--v) 48% 77%, var(--o) 77%); display: grid; place-items: center; }
        .ring:after { content: ""; width: 100px; height: 100px; border-radius: 50%; background: #fff; }
        .ringtxt { position: absolute; text-align: center; }
        .ringtxt strong { font-size: 26px; display: block; color: var(--n2); font-weight: 900; }
        .ringtxt span { font-size: 8px; color: var(--m); letter-spacing: .08em; }

        .tablepanel { margin-top: 16px; }
        .table { width: 100%; border-collapse: collapse; }
        .table th { font-size: 8px; color: #8b9aaa; text-transform: uppercase; letter-spacing: .08em; text-align: left; padding: 12px 10px; border-bottom: 1px solid var(--l); font-weight: 800; }
        .table td { font-size: 11px; padding: 13px 10px; border-bottom: 1px solid #edf1f5; color: var(--i); }
        .ref { font-weight: 900; color: #087fce; }
        .status { font-size: 9px; font-weight: 900; border-radius: 99px; padding: 5px 10px; display: inline-block; }
        .ok { background: #e8faf4; color: #079b77; }
        .move { background: #eaf6ff; color: #087fce; }
        .wait { background: #fff3e7; color: #d97819; }

        .toolbar { display: flex; gap: 10px; margin-bottom: 16px; }
        .toolbar input, .toolbar select { border: 1px solid var(--l); background: #fff; border-radius: 9px; padding: 10px 14px; font-size: 11px; outline: 0; }
        .toolbar input { flex: 1; }
        .toolbar select:focus, .toolbar input:focus { border-color: var(--b); }

        .quotegrid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
        .quote { padding: 20px; }
        .quote .ref { font-size: 10px; }
        .quote h3 { font-size: 13px; margin: 9px 0 4px; color: var(--n2); }
        .quote p { font-size: 10px; color: var(--m); line-height: 1.6; margin: 0; }
        .price { font-size: 24px; font-weight: 950; margin: 14px 0 4px; color: var(--n2); }

        .settings { display: grid; grid-template-columns: 225px 1fr; gap: 16px; }
        .setnav, .setbody { padding: 12px; }
        .setnav button { width: 100%; border: 0; background: transparent; text-align: left; padding: 12px 14px; border-radius: 9px; color: var(--m); font-size: 11px; font-weight: 700; cursor: pointer; margin-bottom: 4px; }
        .setnav button.sel { background: #edf8ff; color: #078fda; font-weight: 900; }
        .setbody { padding: 25px; }
        .row { display: flex; justify-content: space-between; align-items: center; padding: 18px 0; border-bottom: 1px solid #edf1f5; }
        .row:last-child { border: 0; }
        .row b { font-size: 12px; color: var(--n2); }
        .row p { margin: 4px 0 0; font-size: 10px; color: var(--m); }
        
        .toggle { width: 40px; height: 22px; border: 0; border-radius: 20px; background: #cbd5df; position: relative; cursor: pointer; transition: 0.2s; }
        .toggle:after { content: ""; position: absolute; width: 16px; height: 16px; top: 3px; left: 3px; border-radius: 50%; background: #fff; transition: .2s; }
        .toggle.on { background: var(--b); }
        .toggle.on:after { left: 21px; }

        /* Flash Message Banner */
        .admin-alert { padding: 14px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 11px; font-weight: 700; display: flex; align-items: center; gap: 10px; }
        .admin-alert-success { background: #e8faf4; color: #079b77; border: 1px solid #b7f0de; }
        .admin-alert-error { background: #fef2f2; color: #dc2626; border: 1px solid #fecaca; }

        @media(max-width:1000px){
            .side { width: 70px; }
            .brand { padding: 0 15px; }
            .brandtext, .nav span:not(.icon), .usertext { display: none; }
            .nav button, .nav a { justify-content: center; }
            .main { margin-left: 70px; width: calc(100% - 70px); }
            .cards { grid-template-columns: 1fr 1fr; }
            .two { grid-template-columns: 1fr; }
            .settings { grid-template-columns: 1fr; }
        }
        @media(max-width:650px){
            .top { padding: 0 15px; }
            .search { display: none; }
            .content { padding: 20px 14px; }
            .cards, .quotegrid { grid-template-columns: 1fr; }
            .topright .primary { display: none; }
            .tablepanel { overflow: auto; }
            .table { min-width: 650px; }
        }
    </style>
</head>
<body>
<div class="app">
    <!-- Fixed Sidebar Navigation -->
    <aside class="side">
        <div class="brand">
            <span class="logo">RP</span>
            <div class="brandtext">
                RUSH PARCEL
                <small>ADMIN CONTROL CENTRE</small>
            </div>
        </div>

        <nav class="nav">
            <a href="<?= url('/admin') ?>" class="<?= ($active_page ?? '') === 'admin_dashboard' ? 'active' : '' ?>">
                <span class="icon">⌂</span>
                <span>Dashboard</span>
            </a>
            <a href="<?= url('/admin/shipments') ?>" class="<?= ($active_page ?? '') === 'admin_shipments' ? 'active' : '' ?>">
                <span class="icon">▣</span>
                <span>Shipments</span>
            </a>
            <a href="<?= url('/admin/quotations') ?>" class="<?= ($active_page ?? '') === 'admin_quotations' ? 'active' : '' ?>">
                <span class="icon">◇</span>
                <span>Quotations</span>
            </a>
            <a href="<?= url('/admin/invoices') ?>" class="<?= ($active_page ?? '') === 'admin_invoices' ? 'active' : '' ?>">
                <span class="icon">▤</span>
                <span>Receipts &amp; Invoices</span>
            </a>
            <a href="<?= url('/admin/settings') ?>" class="<?= ($active_page ?? '') === 'admin_settings' ? 'active' : '' ?>">
                <span class="icon">⚙</span>
                <span>Settings</span>
            </a>
        </nav>

        <div class="user">
            <div class="userbox">
                <div class="ava"><?= strtoupper(substr($user['name'] ?? 'System Admin', 0, 2)) ?></div>
                <div class="usertext">
                    <b><?= e($user['name'] ?? 'System Admin') ?></b>
                    <span>Rush Parcel Operations</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Section -->
    <main class="main">
        <header class="top">
            <div class="title">
                <h1 id="title"><?= e($header_title ?? 'Dashboard Overview') ?></h1>
                <p id="sub"><?= e($header_subtitle ?? 'Rush Parcel operational command centre') ?></p>
            </div>

            <div class="topright">
                <form action="<?= url('/admin/shipments') ?>" method="GET" style="display: flex; gap: 8px;">
                    <input class="search" type="text" name="search" placeholder="Search tracking ID (UK...), shipment or invoice..." value="<?= e($_GET['search'] ?? '') ?>">
                    <button type="submit" class="btn primary" style="padding: 10px 14px;">🔍</button>
                </form>
                <a href="<?= url('/admin/shipments/create') ?>" class="btn primary">＋ Create Shipment</a>
                <form action="<?= url('/logout') ?>" method="POST" style="margin:0;">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-outline" style="padding: 10px 12px;" title="Logout">Logout</button>
                </form>
            </div>
        </header>

        <div class="content">
            <?php if (!empty($flash_success)): ?>
                <div class="admin-alert admin-alert-success">
                    <span>✓</span>
                    <div><?= e($flash_success) ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($flash_error)): ?>
                <div class="admin-alert admin-alert-error">
                    <span>⚠️</span>
                    <div><?= e($flash_error) ?></div>
                </div>
            <?php endif; ?>

            <?= $content ?? '' ?>
        </div>
    </main>
</div>

<script>
document.querySelectorAll('.toggle').forEach(x => {
    x.addEventListener('click', function() {
        this.classList.toggle('on');
    });
});
</script>
</body>
</html>
