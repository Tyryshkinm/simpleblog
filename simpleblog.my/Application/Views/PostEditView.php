<div class="postEdit">
    <p>Edit post: <?=$data['title']?></p>
    <form method="post" action="/post/<?=$data['id']?>/edit">
        <input type="text" name="postTitle" value="<?=$data['title']?>" placeholder="Title of Post" required /></br>
        <textarea name="postText" cols="25" rows="10" placeholder="Text of Post" required ><?=$data['text']?></textarea></br>
        <input type="submit" class="btn btn-primary" name="save" value="Save changes" />
    </form>
</div>