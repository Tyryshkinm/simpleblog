<div class="addpost">
    <p>Add post</p>
    <form method="post" action="/post/add">
        <input type="text" maxlength="50" name="postTitle" placeholder="Title of Post (max 50 characters)" required /></br>
        <textarea name="postText" cols="25" rows="10" placeholder="Text of Post" required ></textarea></br>
        <input type="submit" class="btn btn-primary" name="add" value="Add post" />
    </form>
</div>