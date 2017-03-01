<div class="pager">
    <a href="?page=1">first page</a>
    <?php if ($currentPage>5):?>
        <a href="?page=<?=$currentPage-5?>"><?=$currentPage-5?></a>
    <?php endif;?>
    <?php if ($currentPage>4):?>
        <a href="?page=<?=$currentPage-4?>"><?=$currentPage-4?></a>
    <?php endif;?>
    <?php if ($currentPage>3):?>
        <a href="?page=<?=$currentPage-3?>"><?=$currentPage-3?></a>
    <?php endif;?>
    <?php if ($currentPage>2):?>
        <a href="?page=<?=$currentPage-2?>"><?=$currentPage-2?></a>
    <?php endif;?>
    <?php if ($currentPage>1):?>
        <a href="?page=<?=$currentPage-1?>"><?=$currentPage-1?></a>
    <?php endif;?>

    <a class="active" href="?page=<?=$currentPage?>"><?=$currentPage?></a>

    <?php if ($currentPage+1<=$lastPage):?>
        <a href="?page=<?=$currentPage+1?>"><?=$currentPage+1?></a>
    <?php endif;?>
    <?php if ($currentPage+2<=$lastPage):?>
        <a href="?page=<?=$currentPage+2?>"><?=$currentPage+2?></a>
    <?php endif;?>
    <?php if ($currentPage+3<=$lastPage):?>
        <a href="?page=<?=$currentPage+3?>"><?=$currentPage+3?></a>
    <?php endif;?>
    <?php if ($currentPage+4<=$lastPage):?>
        <a href="?page=<?=$currentPage+4?>"><?=$currentPage+4?></a>
    <?php endif;?>
    <?php if ($currentPage+5<=$lastPage):?>
        <a href="?page=<?=$currentPage+5?>"><?=$currentPage+5?></a>
    <?php endif;?>
    <a href="?page=<?=$lastPage?>">last page</a>
</div>