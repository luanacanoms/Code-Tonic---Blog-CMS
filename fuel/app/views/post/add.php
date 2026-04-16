<h1>Añadir Post</h1>
<?php echo Form::open('/posts/add'); ?>

    <div class="form-group">
        <?php echo Form::label('Título', 'title'); ?>
        <?php echo Form::input('title', Input::post('title', isset($post) ? $post->title : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Categoría', 'category'); ?>
        <?php echo Form::select('category', 0, array(
            '0' => 'Seleccionar Categoría',
            'Diseño Web' => 'Diseño Web',
            'Programación' => 'Programación',
            'Front-End' => 'Front-End',
            'Back-End' => 'Back-End'
        ), array('class' => 'form-control')); ?>
    </div>
    
    <div class="form-group">
        <?php echo Form::label('Slug (URL amigable)', 'slug'); ?>
        <?php echo Form::input('slug', Input::post('slug', isset($post) ? $post->slug : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Resumen', 'excerpt'); ?>
        <?php echo Form::textarea('excerpt', Input::post('excerpt', isset($post) ? $post->excerpt : ''), array('class' => 'form-control', 'rows' => 3)); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Contenido', 'content'); ?>
        <?php echo Form::textarea('content', Input::post('content', isset($post) ? $post->content : ''), array('class' => 'form-control', 'rows' => 8)); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('URL de la Imagen de Portada', 'image_url'); ?>
        <?php echo Form::input('image_url', Input::post('image_url', isset($post) ? $post->image_url : ''), array('class' => 'form-control')); ?>
    </div>

    <div class="form-group">
        <?php echo Form::label('Estado', 'status'); ?>
        <?php echo Form::select('status', Input::post('status', isset($post) ? $post->status : 'Draft'), array(
            'Draft' => 'Borrador',
            'Published' => 'Publicado'
        ), array('class' => 'form-control')); ?>
    </div>

    <br>
    <div class="actions">
        <?php echo Form::submit('send', 'Guardar Post', array('class' => 'btn btn-primary')); ?>
    </div>

<?php echo Form::close(); ?>