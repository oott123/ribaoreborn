<?php reborn::render('view_header', array('title'=>'搜索 '.$keyword));?>
<body>
<h1><?php echo '搜索 '.$keyword;?></h1>
<?php reborn::render('search_box', array('rank'=>$rank, 'keyword'=> $keyword));?>
<?php foreach($data as $datum):
    reborn::render('display_item', array('datum' => $datum));
endforeach;?>
<div class="pager">
<?php
    $page = isset($_GET['page'])?intval($_GET['page']):1;
    $maxpage = ceil($count / rebornConfig::search_page_count);
?>
<?php if($page > 1):?>
    <a href="?<?php echo getPageLink(-1);?>">上一页</a>
<?php endif;?>
    <span class="count">
        共 <?php echo $count;?> 篇
    </span>
    <select onchange="goPage()" id="pagerSelect">
        <?php for($i = 1; $i <= $maxpage; $i++):?>
            <option value="<?php echo $i;?>"
                <?php if($page == $i)echo 'selected'?>><?php echo $i;?></option>
        <?php endfor;?>
    </select>
<?if($page < $maxpage):?>
    <a href="?<?php echo getPageLink(1);?>">下一页</a>
<?php endif;?>
    <script>
        function goPage(){
            var url = '?<?php echo getPageLink(NULL);?>';
            var page = document.getElementById('pagerSelect').value;
            window.location = url.replace('reborn_replace_it', page);
        }
    </script>
</div>
</body>
</html>