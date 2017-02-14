<div class="postEdit">
    <p>Edit post</p>
    <form method="post" action="/post/<?=$data['id']?>/edit">
        <input type="text" name="post_title" value="<?=$data['title']?>" placeholder="Title of Post" required /></br>
        <textarea name="post_text" cols="25" rows="10" placeholder="Text of Post" required ><?=$data['text']?></textarea></br>
        <input type="submit" class="btn btn-primary" name="save" value="Save changes" />
    </form>
</div>