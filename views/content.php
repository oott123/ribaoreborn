<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<title><?php echo htmlspecialchars($content['title']);?></title>
	<link rel="stylesheet" href="static/general.css" />
	<base target="_blank" />
</head>
<body class="night">
	<div class="headimg" style="background-image:url('img.php?url=<?php echo $content["image"];?>');">
		<div id="content"></div>
	</div>
	<h1 class="headtitle"><?php echo nl2br(htmlspecialchars($content['title']));?></h1>
	<div class="body">
<?php 
	$body = $content['body'];
	$body = preg_replace('#<img(.*?) src="(.*?)"#', '<img$1 src="img.php?url=$2"', $body);
	echo $body;
?>
	</div>
	<?php if($next):?>
	<div class="pager">
		<a href="?c=content&amp;id=<?php echo $next['id'];?>#content" target="_self">下一篇：<?php echo nl2br(htmlspecialchars($next['title']));?></a>
	</div>
	<?php endif;?>
	<div class="pager">
		<a href="?date=<?php echo $content['date'];?>#entry<?php echo $content["id"];?>" target="_self">列表</a>
		<a href="<?php echo $content['share_url'];?>">分享页</a>
	</div>
</body>
</html>