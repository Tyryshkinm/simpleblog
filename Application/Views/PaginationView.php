<div class="pager">
    <a href="?page=1&amt=<?=$amt?>">first page</a>
    <?php if ($currentPage>5):?>
        <a href="?page=<?=$currentPage-5?>&amt=<?=$amt?>"><?=$currentPage-5?></a>
    <?php endif;?>
    <?php if ($currentPage>4):?>
        <a href="?page=<?=$currentPage-4?>&amt=<?=$amt?>"><?=$currentPage-4?></a>
    <?php endif;?>
    <?php if ($currentPage>3):?>
        <a href="?page=<?=$currentPage-3?>&amt=<?=$amt?>"><?=$currentPage-3?></a>
    <?php endif;?>
    <?php if ($currentPage>2):?>
        <a href="?page=<?=$currentPage-2?>&amt=<?=$amt?>"><?=$currentPage-2?></a>
    <?php endif;?>
    <?php if ($currentPage>1):?>
        <a href="?page=<?=$currentPage-1?>&amt=<?=$amt?>"><?=$currentPage-1?></a>
    <?php endif;?>

    <a class="active" href="?page=<?=$currentPage?>&amt=<?=$amt?>"><?=$currentPage?></a>

    <?php if ($currentPage+1<=$lastPage):?>
        <a href="?page=<?=$currentPage+1?>&amt=<?=$amt?>"><?=$currentPage+1?></a>
    <?php endif;?>
    <?php if ($currentPage+2<=$lastPage):?>
        <a href="?page=<?=$currentPage+2?>&amt=<?=$amt?>"><?=$currentPage+2?></a>
    <?php endif;?>
    <?php if ($currentPage+3<=$lastPage):?>
        <a href="?page=<?=$currentPage+3?>&amt=<?=$amt?>"><?=$currentPage+3?></a>
    <?php endif;?>
    <?php if ($currentPage+4<=$lastPage):?>
        <a href="?page=<?=$currentPage+4?>&amt=<?=$amt?>"><?=$currentPage+4?></a>
    <?php endif;?>
    <?php if ($currentPage+5<=$lastPage):?>
        <a href="?page=<?=$currentPage+5?>&amt=<?=$amt?>"><?=$currentPage+5?></a>
    <?php endif;?>
    <a href="?page=<?=$lastPage?>&amt=<?=$amt?>">last page</a>
    <br>
    <div class="amt">
        <p>Number of posts: </p>
            <select onselect="" onchange="location.href=this.value">
                <option hidden selected><?=$amt?></option>
                <option value="?page=<?=$currentPage?>&amt=10">10</option>
                <option value="?page=<?=$currentPage?>&amt=25">25</option>
                <option value="?page=<?=$currentPage?>&amt=50">50</option>
            </select>
    </div>
</div>