<!DOCTYPE html> 
<html lang="en">
<head>
  <meta charset="utf-8">
	<title><?php echo $pageTitle; ?> - <?php echo $site; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">

	<link rel="stylesheet" href="/css/jquery.mobile-1.3.2.min.css" />
    <link rel="stylesheet" href="/css/bootstrap.css" />
    <link rel="stylesheet" href="/css/main.css" />

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/css/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/css/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/css/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="/css/ico/favicon.png">
</head>
<body>
<div data-role="page" id="main-page" data-title="<?php echo $site; ?>"<?php if (isset($url)): ?> data-url="<?php echo $url; ?>"<?php endif; ?>>
    <div data-role="header" data-theme="c">
        <?php if (isset($SESSION['UUID'])): ?>
        <a href="#left-panel" data-icon="bars">系统菜单</a>
        <?php endif; ?>
        <h1><?php echo $pageTitle; ?> - <?php echo $site; ?></h1>
        <?php if (isset($SESSION['UUID'])): ?>
        <a href="/user/logout" data-icon="star" class="ui-btn-right">退出</a>
        <?php endif; ?>
    </div><!-- /header -->
    <div data-role="content">
<?php echo $this->render($pageContent,$this->mime,get_defined_vars()); ?>
    </div><!-- /content -->
    <?php if (isset($cards)): ?>
    <div data-role="footer" data-theme="a" data-position="fixed" data-fullscreen="true">
        <div data-role="navbar">
            <ul>
                <li><a href="/card/list">未成交卡片</a></li>
                <li><a href="/card/list/1">尚未到提醒日期</a></li>
                <li><a href="/card/list/2">已过提醒日期</a></li>
                <li><a href="/card/list/3">已成交卡片</a></li>
            </ul>
        </div><!-- /navbar -->
    </div><!-- /footer -->
    <?php endif; ?>
<?php if (isset($SESSION['UUID'])) echo $this->render('_menu.html',$this->mime,get_defined_vars()); ?>
</div>
    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/jquery.mobile-1.3.2.min.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>