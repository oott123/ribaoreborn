<div class="entry" id="entry<?php echo $datum['id'];?>">
    <p class="title">
        <img class="title_img" src="img.php?url=<?php echo $datum['image'];?>"/>
        <a class="title_text" href="?c=content&amp;id=<?php echo $datum['id'];?>#content">
            <?php if(function_exists('highlight')):?>
            <?php echo highlight(nl2br(htmlspecialchars($datum['title'])));?>
            <?php else:?>
            <?php echo nl2br(htmlspecialchars($datum['title']));?>
            <?php endif;?>
        </a>
    </p>
</div>