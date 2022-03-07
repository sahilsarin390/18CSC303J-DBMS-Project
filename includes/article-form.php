



       <?php foreach ($article->errors as $error): ?>
            <div class="alert alert-warning"><?=$error ?></div>

        <?php endforeach; ?>
       

<form method = "post" >
    <div class="form-group">
        <label>Title</label>
        <input name = "title" class="form-control" value="<?= htmlspecialchars($article->title); ?>">
</div>
   <label>Content</label>
    <textarea name = "post" class="form-control"><?= htmlspecialchars($article->post); ?></textarea><br>
    
    <label>Category</label>

    <?php foreach($categories as $category) : ?>
    
    <div>

        <input type = "checkbox" name="category[]" value="<?= $category['id']; ?>" id = "<?=$category['id'];?>" <?= in_array($category['id'], $category_id) ? 'checked' : '' ?>>

        <label for = "<?=$category['id'];?>"><?= htmlspecialchars($category['name']); ?></label>

    </div>
    
    <?php endforeach; ?>

    <button class = "btn btn-outline-dark" style="width: 30%;">Submit</button>
      
  </form>
  </div>


