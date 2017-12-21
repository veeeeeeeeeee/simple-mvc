<form action="<?php echo $this->posturl; ?>" method="post">
	LastName:<br />
	<input type="text" name="lastname" value="<?php echo $this->person['lastname'] ?>"><br />
	Weight:<br />
	<input type="number" name="weight" value="<?php echo $this->person['weight'] ?>"><br />
	Height:<br />
	<input type="number" name="height" value="<?php echo $this->person['height'] ?>"><br />
<input type="submit" />
</form>
