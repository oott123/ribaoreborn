<form action="?c=search" method="POST">
<div class="search">
    <div class="first row">
        <input type="text" name="keyword" placeholder="输入关键词 空格分开"
               value="<?php echo isset($keyword)?$keyword:'';?>"/>
        <input type="submit" name="searchByTitle" value="标题检索"/>
        <input type="submit" name="searchByContent" value="全文检索" />
    </div>
    <div class="second row">
        <input type="radio" name="rank" value="0" id="by_date"
            <?php if(!isset($rank) || !$rank) echo 'selected';?>/>
        <label for="by_date">按日期排序</label>
        <input type="radio" name="rank" value="1" id="by_ass"
            <?php if(isset($rank) && $rank) echo 'selected';?>/>
        <label for="by_ass">按相关度排序（慢）</label>
    </div>
</div>
</form>