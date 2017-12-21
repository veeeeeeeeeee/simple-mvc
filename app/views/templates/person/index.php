<!--p>Person index view template</p>
<p>Sent data: <?php echo $this->testkey; ?></p>
<p>Persons data:</p>
<pre>
	<?php //print_r($this->persons) ?>
</pre-->

<p class=meme><?php echo $this->message; ?><p>
<?php if (strpos($this->message, "added") != 0 || strpos($this->message, "edited") != 0): ?>
	<img class="meme" height=400 src="<?php echo APP_HOME . '/resources/img/harry-potter.jpg' ?>" />
<?php elseif (strpos($this->message, "deleted") != 0): ?>
	<img class="meme" height=400 src="<?php echo APP_HOME . '/resources/img/frodo.jpg' ?>" />
<?php endif; ?>
<!-- substr = add, edit, img src = harry potter -->
<!-- else if substr = delete img src = frodo -->
<!-- javascript hide the img after 2 seconds of display -->

<table>
	<tr>
		<th><p>Last Name</p></th>
		<th><p>Weight (kg)</p></th>
		<th><p>Height (kg)</p></th>
		<th><p>Action<p></th>
	</tr>
	<?php foreach($this->persons as $p): ?>
	<tr>
		<td><p><?php echo $p['lastname']; ?></p></td>
		<td><p><?php echo $p['weight']; ?></p></td>
		<td><p><?php echo $p['height']; ?></p></td>
		<td>
		<a href="<?php echo $this->baseurl . 'view&id=' . $p['row_id']; ?>">View</a>
		<a href="<?php echo $this->baseurl . 'edit&id=' . $p['row_id']; ?>">Edit</a>
			<a href="<?php echo $this->baseurl . 'delete&id=' . $p['row_id']; ?>">Delete</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
