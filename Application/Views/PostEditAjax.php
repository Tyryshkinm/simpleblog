<div class="postEdit">
    <input type="text" id="editTitle<?=$postId;?>" maxlength="50" name="postTitle" value="<?=$dataPost['title']?>" placeholder="Title of Post" required /></br>
    <textarea id="editText<?=$postId?>" name="postText" cols="25" rows="10" placeholder="Text of Post" required ><?=$dataPost['text']?></textarea></br>
    <button class="btn btn-primary">Save</button>
</div>