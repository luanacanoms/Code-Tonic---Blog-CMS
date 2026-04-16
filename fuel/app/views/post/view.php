<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post->title; ?></h2>
    
    <p class="blog-post-meta"><?php echo date('d/m/Y', strtotime($post->created_at)); ?></p>
    
    <?php echo $post->content; ?>

    <ul>
        <li><strong>Categoría:</strong> <?php echo $post->category; ?></li>
    </ul>
</div>

<hr>

<?php if(Session::get('logged_in')) : ?>
    <a class="btn btn-default" href="/posts/edit/<?php echo $post->id; ?>">Editar</a>
    <a class="btn btn-danger" href="/posts/delete/<?php echo $post->id; ?>">Eliminar</a>
    <br><br>
<?php endif; ?>