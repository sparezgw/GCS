	<table data-role="table" class="table-list table-stroke">
		<caption><h2><?php echo $pageTitle; ?></h2></caption>
		<thead>
			<tr>
				<th data-priority="1">序号</th>
				<th>姓名</th>
				<th data-priority="2">手机</th>
				<th data-priority="3">建卡日期</th>
				<th data-priority="4">更新日期</th>
				<th data-priority="5">提醒日期</th>
				<th>操作</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach (($cards?:array()) as $card): ?>
			<tr>
				<th><?php echo $card['pID']; ?></th>
				<td class="title"><a href="/client/<?php echo $card['pID']; ?>" data-transition="slideup"><?php echo $card['name']; ?></a></td>
				<td><?php echo $card['mobile']; ?></td>
				<td><?php echo substr($card['create_time'],0,10); ?></td>
				<td><?php echo substr($card['update_time'],0,10); ?></td>
				<td><?php echo substr($card['next_time'],0,10); ?></td>
				<td>
					<a href="/card/<?php echo $card['pID']; ?>" data-role="button" class="ui-icon-alt" data-icon="info" data-inline="true" data-mini="true">卡片</a>
					<a href="/note/p/<?php echo $card['pID']; ?>" data-role="button" class="ui-icon-alt" data-icon="arrow-r" data-transition="slide" data-inline="true" data-mini="true">接触记录</a>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
