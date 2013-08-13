	<form class="form-user" method="post">
		<?php if (isset($msg)): ?>
			<div class="alert alert-error"> <strong>错误!</strong><?php echo $msg; ?></div>
		<?php endif; ?>
		<input type="text" name="username" data-clear-btn="true" placeholder="电子邮件">
		<input type="password" name="password" data-clear-btn="true" placeholder="密码">
		<label><input type="checkbox" name="autologin">一个星期内自动登录</label>
		<button type="submit" name="login" data-icon="grid" data-theme="b">登录系统</button>
		<div class="ui-block-a"><a href="/register" data-role="button" data-theme="b">用户注册</a></div>
		<div class="ui-block-b"><a href="#" data-role="button" data-theme="d">忘记密码</a> </div>
	</form>
