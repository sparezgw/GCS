<div class="index-grid">
	<div class="ui-block-a">
		<div class="ui-body ui-body-d">
			<h2>公告</h2>
			<ul>
				<li><p>淘金卡在线系统&copy;中宏保险 正在公测中，如有问题或建议请联系网站管理员。<br />Golden Card System&copy;Manulife-Sinochem is in beta testing now. <br />If you have any questions or suggestions, please feel free to contact administrator。</p></li>
				<li><p style="color:red;">系统正在公测中，如有重要数据请及时备份。如需数据导入、导出，请联系管理员。</p></li>
			</ul>
		</div>
	</div>
	<div class="ui-block-b">
		<div class="ui-body ui-body-d">
			<h3>账户状态</h3>
			<p>您的账户为：50客户版<span> 最多支持50个客户和50张淘金卡</span></p>
			<p>当前用量：
				 <div class="ui-body-b ui-btn-corner-all ui-btn-inline usage" style="background-size: <?php echo (int)$pNum/50*100; ?>%;">客户：<?php echo $pNum; ?> / 50</div>
				 <div class="ui-body-b ui-btn-corner-all ui-btn-inline usage" style="background-size: <?php echo (int)$cNum/50*100; ?>%;">卡片：<?php echo $cNum; ?> / 50</div>
			</p>
		</div>
	</div>
	<div class="ui-block-c">
		<div class="ui-body ui-body-d">
			<h3>常用功能</h3>
			<ol data-role="listview" data-theme="d" data-inset="true">
				<li><a href="/client/add">新增客户</a></li>
				<li><a href="/client/search">客户搜索</a></li>
				<li><a href="/card/search">卡片搜索</a></li>
			</ol>
		</div>
	</div>
	<div class="ui-block-d">
		<div class="ui-body ui-body-d">
			<h3>系统信息</h3>
			<p>当前版本：<?php echo $version; ?></p>
			<p>更新日期：<?php echo $release_date; ?></p>
		</div>
	</div>
	<p style="text-align: center;">Copyright 2013 - <?php echo $site; ?></p>
</div>
