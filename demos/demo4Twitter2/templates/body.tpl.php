<body>
<div id="logo"><a href="#">Twitter</a></div>
<form id="f" name="f">
  <label for="username"><?php echo$label;?></label><input type="text" id="username" name="username" value="<?php echo$_GET['username'];?>"/><input type="submit" value="Grab">
</form>  
<div id="content_tweets"><?php echo$tweets; ?></div>
<?php echo$footer;?>
</body>
</html>
