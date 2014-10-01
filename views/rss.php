<?php //var_dump($data);die();?>
<?php echo '<?xml version="1.0" encoding="UTF-8"?>';?>
<rss version="2.0">
  <channel>
    <title>知乎日报网页阅读</title>
    <link>http://daliy.zhihu.com/</link>
    <description/>
    <lastBuildDate><?=date('r');?></lastBuildDate>
<?php foreach($data['news'] as $datum):?>
    <item>
      <title><?php echo $datum['title'];?></title>
      <description>
        <![CDATA[<img src="<?php echo $datum['image'];?>"/><br />原文：<a href="<?php echo $datum['share_url'];?>"><?php echo $datum['share_url'];?></a>]]>
      </description>
      <author>oott123</author>
      <link><?php echo $datum['share_url'];?></link>
      <guid>zhihuribao-<?php echo $datum['id'];?></guid>
    </item>
<?php endforeach;?>
  </channel>
</rss>