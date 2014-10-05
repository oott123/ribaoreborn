<div class="search">
    <div class="first row">
        <input type="text" name="keyword" placeholder="输入关键词 空格分开"
               value="<?php echo isset($keyword)?$keyword:'';?>"/>
        <input type="submit" name="search_title" value="标题检索"/>
        <input type="submit" name="search_body" value="全文检索" />
    </div>
    <div class="second row">
        <input type="radio" name="rank" value="by_date" id="by_date"/>
        <label for="by_date">按日期排序</label>
        <input type="radio" name="rank" value="by_ass" id="by_ass"/>
        <label for="by_ass">按相关度排序</label>
    </div>
</div>