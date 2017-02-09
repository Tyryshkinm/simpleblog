<br>
Edit post
<form method="post" action="/post/<?=$data['id']?>/save_changes">
    <input type="text" name="post_title" value="<?=$data['title']?>" placeholder="Title of Post" required /></br>
    <textarea name="post_text" cols="25" rows="10" placeholder="Text of Post" required ><?=$data['text']?></textarea></br>
    <input type="submit" name="save" value="Save changes" />
</form>