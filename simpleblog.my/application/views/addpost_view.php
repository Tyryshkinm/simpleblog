<div class="addpost">
    <p>Add post</p>
    <form method="post" action="/post/add">
        <input type="text" maxlength="50" name="post_title" placeholder="Title of Post" required /></br>
        <textarea name="post_text" cols="25" rows="10" placeholder="Text of Post" required ></textarea></br>
        <input type="submit" class="btn btn-primary" name="add" value="Add post" />
    </form>
</div>