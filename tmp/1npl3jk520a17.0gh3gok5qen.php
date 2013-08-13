	<form method="post">
	<table data-role="table" class="table-list table-stroke">
		<caption><h2><?php echo $pageTitle; ?></h2></caption>
		<thead>
			<tr>
				<th data-priority="1">序号</th>
				<th width="16%">时间</th>
				<th width="8%" data-priority="2">方式</th>
				<th data-priority="3">内容</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php $ctr=0; foreach (($notes?:array()) as $note): $ctr++; ?>
			<tr>
				<th><?php echo $ctr; ?></th>
				<td class="title"><?php echo substr($note['time'],0,16); ?></td>
				<td><?php echo $modes[$note['mode']-1]; ?></td>
				<td><?php echo $note['content']; ?></td>
				<td>
					<a href="#" data-role="button" class="ui-icon-alt" data-icon="edit" data-iconpos="notext" data-iconshadow="false" data-inline="true">修改</a>
					<a data-id="N<?php echo $note['nID']; ?>" data-rel="popup" data-position-to="window" data-role="button" class="ui-icon-alt delete" data-icon="delete" data-iconpos="notext" data-iconshadow="false" data-inline="true">删除</a>
				</td>
			</tr>
			<?php endforeach; ?>
			<tr>
				<th>新</th>
				<td><input type="datetime-local" data-mini="true" name="time" value=''></td>
				<td>
					<select name="mode" data-mini="true">
					<?php $ctr=0; foreach (($modes?:array()) as $mode): $ctr++; ?>
						<option value="<?php echo $ctr; ?>"><?php echo $mode; ?></option>
					<?php endforeach; ?>
					</select>
				</td>
				<td><input type="text" data-mini="true" name="content" value="" placeholder="简要记录"></td>
				<td><button type="submit" name="add" data-icon="plus" data-theme="b" data-mini="true" data-inline="true">添加</button></td>
			</tr>
		</tbody>
	</table>
	</form>
	<div id="back">
		<a data-role="button" data-inline="true" data-icon="back" data-rel="back">返回</a>
	</div>
	<div data-role="popup" id="popupDeleteN" data-overlay-theme="a" data-theme="c" data-dismissible="false" style="max-width:400px;" class="ui-corner-all">
		<div data-role="header" data-theme="a" class="ui-corner-top">
			<h1>删除记录？</h1>
		</div>
		<div data-role="content" data-theme="d" class="ui-corner-bottom ui-content">
			<h2 class="ui-title">是否确定删除此条记录？</h2>
			<a data-role="button" data-inline="true" data-rel="back" data-theme="c">取消</a>
			<a href="#" data-role="button" data-inline="true" data-theme="b">删除</a>
		</div>
	</div>
