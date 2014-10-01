<?php //var_dump($data);die();?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<rss version="2.0">
  <channel>
    <title>知乎日报网页阅读</title>
    <link>http://daliy.zhihu.com/</link>
    <description/>
    <lastBuildDate><?=date('r');?></lastBuildDate>
<?php foreach($news as $datum):?>
    <item>
      <title><?php echo $datum['title'];?></title>
      <description>
        <![CDATA[
          <img src="<?php echo $datum['image'];?>" />
          <?php
              $body = $datum['body'];
              //$body = preg_replace('#<img(.*?) src="(.*?)"#', '<img$1 src="img.php?url=$2"', $body);
              echo $body;
          ?>
          ]]>
      </description>
      <link><?php echo $datum['url'];?></link>
      <guid>zhihuribao-<?php echo $datum['id'];?></guid>
    </item>
<?php endforeach;?>
  </channel>
</rss>