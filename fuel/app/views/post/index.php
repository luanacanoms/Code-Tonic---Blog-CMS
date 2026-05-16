<?php 
  $custom_topics = Session::get('custom_topics', array());

  $found_categories = array();
  if ($posts) {
      foreach ($posts as $p) {
          if (!empty($p->category)) {
              $tags = explode(',', $p->category);
              foreach($tags as $tag) {
                  $found_categories[] = ucwords(strtolower(trim($tag)));
              }
          }
      }
  }

  $all_categories = array_unique(array_merge($found_categories, array_keys($custom_topics)));

  function get_smart_category_image($cat_name, $custom_topics) {
      $clean_name = ucwords(strtolower(trim($cat_name)));
      $cat_name_low = strtolower(trim($cat_name));
      
      if (isset($custom_topics[$clean_name])) {
          return $custom_topics[$clean_name];
      }

      $default_images_map = array(
          'coding' => 'coding.jpg',
          'web design' => 'web-design.jpg',
          'salud mental' => 'salud-mental.jpg',
          'tiempo de calidad' => 'tiempo-de-calidad.jpg',
          'deportes' => 'desportes.jpg',
          'viajes' => 'viajes.jpg'
      );
      
      $img = array_key_exists($cat_name_low, $default_images_map) ? $default_images_map[$cat_name_low] : 'coding.jpg';
      return '/myblog/public/assets/img/' . $img; 
  }
?>

<style>
    .top-logo-box {
        width: 1130px;
        max-width: 100%;
        height: 74px;
        background-color: #FEFEFE;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 60px auto; 
        box-shadow: 0 4px 10px rgba(0,0,0,0.03);
        font-family: 'Poppins', sans-serif;
        font-size: 24px;
        font-weight: 500;
    }
    .top-logo-box .code { color: #B4BAFF; }
    .top-logo-box .tonic { color: #6673FD; }

    .post-card { display: flex; flex-direction: column; overflow: hidden; }
    .post-card-top { display: flex; flex: 1; }
    .post-card-actions { background-color: #fcfaff; padding: 15px 40px; display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid rgba(145, 53, 255, 0.1); }
    .btn-action { display: flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; }
    .btn-action-edit { background-color: var(--accent-purple); color: white; }
    .btn-action-edit:hover { background-color: var(--logo-tonic); }
    .btn-action-delete { background-color: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.5); }
    .btn-action-delete:hover { background-color: #fef2f2; }

    .btn-add-topic { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; height: 48px; background-color: white; border: 1px solid rgba(113, 121, 147, 0.3); border-radius: 8px; color: var(--icon-color); font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 500; cursor: pointer; transition: all 0.3s ease; }
    .btn-add-topic:hover { border-color: var(--icon-color); background-color: #f9fafb; }

    .btn-logout-cool {
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 8px; 
        width: 100%; 
        text-decoration: none; 
        color: #ef4444; 
        font-weight: 500; 
        font-size: 14px; 
        padding: 10px; 
        background-color: transparent;
        border: 1px solid rgba(239, 68, 68, 0.5); 
        border-radius: 8px; 
        transition: all 0.3s ease; 
        box-sizing: border-box;
    }
    .btn-logout-cool:hover { 
        background-color: #fef2f2; 
    }

    .modal-title-red { color: #b91c1c; font-weight: 600; margin-bottom: 10px; }
    .delete-icon-wrapper { width: 60px; height: 60px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; }
    .confirm-actions { display: flex; justify-content: center; gap: 15px; margin-top: 25px; }
    .btn-cancel { background: transparent; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px 24px; font-family: 'Poppins', sans-serif; cursor: pointer; }
    .btn-confirm-delete { background: #ef4444; color: white; border: none; border-radius: 6px; padding: 10px 24px; font-family: 'Poppins', sans-serif; cursor: pointer; text-decoration: none; }
    .btn-confirm-delete:hover { background: #dc2626; }
    
    input[type="file"] { padding: 10px; font-size: 13px; }
</style>

<div class="top-logo-box">
    <span class="code">Code</span><span class="tonic">&Tonic</span>
</div>

<section class="hero-section">
    <div class="hero-image">
        <img src="/myblog/public/assets/img/typing-cat.jpg" alt="Mariana coding">
    </div>
    <div class="hero-text">
        <h1>Hola, soy <span>Mariana</span></h1>
        <p>Soy una estudiante de ingeniería informática en España. Me gusta trabajar con el backend of the web, esto es mi blog Code&Tonic where I share a bit of my personal projects.</p>
        
        <form class="connect-form" action="" method="POST">
            <label>Let's Connect</label>
            <div class="form-row">
                <input type="email" name="email" placeholder="Tu correo electrónico" required>
                <button type="submit">Enviar</button>
            </div>
        </form>
    </div>
</section>

<section class="topics-section">
    <h3>Mis tópicos</h3>
    <div class="topics-box">
        <?php if (!empty($all_categories)): ?>
            <?php foreach ($all_categories as $cat): ?>
                <div class="topic-item">
                    <img src="<?php echo get_smart_category_image($cat, $custom_topics); ?>" alt="<?php echo $cat; ?>"><br>
                    <?php echo $cat; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="font-size: 14px; color: var(--text-light); width: 100%;">Añade tu primer post o tópico para poblar esta sección.</p>
        <?php endif; ?>
    </div>
</section>

<div class="content-grid">
    
    <aside class="sidebar">
        
        <?php if(Session::get('logged_in')): ?>
            <div style="margin-bottom: 40px; display: flex; flex-direction: column; gap: 12px;">
                <button id="openModalBtn" class="btn-add-post" style="width: 100%; justify-content: center; cursor: pointer; border: none;">+ Añadir Nuevo Post</button>
                <button id="openTopicModalBtn" class="btn-add-topic">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/></svg>
                    Añadir Tópico
                </button>
            </div>
        <?php endif; ?>

        <div class="sidebar-section">
            <h4 class="sidebar-title">
                <img src="/myblog/public/assets/img/material-symbols_star-rounded.png" class="sidebar-icon"> Sobre mi
            </h4>
            <div class="box-sobre-mi">
                <img src="/myblog/public/assets/img/typing-cat.jpg" alt="Avatar" class="avatar-img">
                <p>¡Hola! Soy Mariana, una estudiante de ingeniería informática apasionada por el desarrollo web backend. Desde mi base en Alemania, comparto mis proyectos personales, retos de código y mis experiencias explorando nuevas tecnologías.</p>
                <div class="social-icons-left">
                    <a href="#"><img src="/myblog/public/assets/img/ig-icon.png" alt="Instagram"></a>
                    <a href="#"><img src="/myblog/public/assets/img/tiktok-icon.png" alt="TikTok"></a>
                    <a href="#"><img src="/myblog/public/assets/img/youtube-icon.png" alt="YouTube"></a>
                </div>
            </div>
        </div>

        <div class="sidebar-section">
            <h4 class="sidebar-title"><img src="/myblog/public/assets/img/tag-icon.png" class="sidebar-icon"> Tag Cloud</h4>
            <div class="box-tag-cloud">
                <ul>
                    <?php if (!empty($all_categories)): ?>
                        <?php foreach ($all_categories as $cat): ?>
                            <li><span class="bullet"></span> <?php echo $cat; ?></li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li>Sin categorías</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="sidebar-section">
            <h4 class="sidebar-title"><img src="/myblog/public/assets/img/puzzle-icon.png" class="sidebar-icon"> Recently Uploaded</h4>
            <div class="box-recent">
                <div class="recent-post-item">
                    <img src="/myblog/public/assets/img/first-fuel-project.jpg" alt="Post" class="recent-img">
                    <div class="recent-info">
                        <a href="#" class="recent-title">My first FuelPHP Project</a>
                        <span class="recent-date">10 de noviembre, 2026</span>
                    </div>
                </div>
            </div>
        </div>

        <?php if(Session::get('logged_in')): ?>
            <div style="margin-top: 20px;">
                <a href="/myblog/public/posts/logout" class="btn-logout-cool">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/><path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg>
                    Logout
                </a>
            </div>
        <?php endif; ?>

    </aside>

    <main class="posts-area">
        <?php if ($posts): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <div class="post-card-top">
                        <a href="/myblog/public/posts/view/<?php echo $post->id; ?>">
                            <img src="<?php echo !empty($post->image_url) ? $post->image_url : '/myblog/public/assets/img/first-fuel-project.jpg'; ?>" class="post-image" alt="Post cover">
                        </a>
                        <div class="post-content">
                            <h2><a href="/myblog/public/posts/view/<?php echo $post->id; ?>" class="post-title-link"><?php echo $post->title; ?></a></h2>
                            <p class="post-excerpt"><?php echo Str::truncate($post->content, 180); ?></p>
                            <div class="post-footer">
                                <div class="post-tags"><span class="bullet"></span> <?php echo $post->category; ?></div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(Session::get('logged_in')): ?>
                        <div class="post-card-actions">
                            <a href="/myblog/public/posts/edit/<?php echo $post->id; ?>" class="btn-action btn-action-edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg>
                                Editar
                            </a>
                            <button onclick="openDeleteModal(<?php echo $post->id; ?>)" class="btn-action btn-action-delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/></svg>
                                Borrar
                            </button>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="padding: 40px; text-align: center; width: 100%;">Todavía no hay posts. ¡Anímate a escribir el primero!</p>
        <?php endif; ?>
    </main>

</div>

<div id="addPostModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" id="closeModalBtn">&times;</span>
        <h2 style="margin-top: 0; color: var(--text-main); font-weight: 500;">Crear Nuevo Post</h2>
        <form action="/myblog/public/posts/add" method="POST" class="login-form" enctype="multipart/form-data" style="width: 100%; margin-top: 20px;">
            <div class="form-group"><label>Título</label><input type="text" name="title" class="form-control" required></div>
            <div class="form-group"><label>Categoría</label><input type="text" name="category" class="form-control" placeholder="Ej: Pets, Coding..." required></div>
            <div class="form-group"><label>Imagen</label><input type="file" name="image" class="form-control" accept="image/*" required></div>
            <div class="form-group"><label>Contenido</label><textarea name="content" class="form-control" rows="6" required></textarea></div>
            <input type="hidden" name="send" value="1">
            <button type="submit" class="btn-submit" style="width: 100%; margin-top: 10px;">Publicar Post</button>
        </form>
    </div>
</div>

<div id="addTopicModal" class="modal-overlay">
    <div class="modal-content">
        <span class="close-modal" id="closeTopicModalBtn">&times;</span>
        <h2 style="margin-top: 0; color: var(--text-main); font-weight: 500;">Añadir Nuevo Tópico</h2>
        <form action="/myblog/public/posts/add_topic" method="POST" class="login-form" enctype="multipart/form-data" style="width: 100%; margin-top: 20px;">
            <div class="form-group">
                <label>Nombre del Tópico</label>
                <input type="text" name="topic_name" class="form-control" placeholder="Ej: Pets" required>
            </div>
            <div class="form-group">
                <label>Imagen del Tópico</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>
            <input type="hidden" name="send_topic" value="1">
            <button type="submit" class="btn-submit" style="width: 100%; margin-top: 10px;">Crear Tópico</button>
        </form>
    </div>
</div>

<div id="deleteConfirmModal" class="modal-overlay">
    <div class="modal-content" style="text-align: center;">
        <div class="delete-icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
              <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
        </div>
        <h2 class="modal-title-red">¿Estás segura?</h2>
        <p style="color: #606269; margin-bottom: 25px; font-size: 14px;">Estás a punto de borrar este post. Esta acción no se puede deshacer y los datos se perderán para siempre.</p>
        <div class="confirm-actions">
            <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancelar</button>
            <a href="#" id="confirmDeleteLink" class="btn-confirm-delete">Sí, borrar post</a>
        </div>
    </div>
</div>

<script>
    const addModal = document.getElementById('addPostModal');
    const topicModal = document.getElementById('addTopicModal');
    const deleteModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteLink = document.getElementById('confirmDeleteLink');

    if(document.getElementById('openModalBtn')) { document.getElementById('openModalBtn').onclick = function(e) { e.preventDefault(); addModal.style.display = "flex"; } }
    if(document.getElementById('closeModalBtn')) { document.getElementById('closeModalBtn').onclick = function() { addModal.style.display = "none"; } }

    if(document.getElementById('openTopicModalBtn')) { document.getElementById('openTopicModalBtn').onclick = function(e) { e.preventDefault(); topicModal.style.display = "flex"; } }
    if(document.getElementById('closeTopicModalBtn')) { document.getElementById('closeTopicModalBtn').onclick = function() { topicModal.style.display = "none"; } }

    function openDeleteModal(postId) {
        confirmDeleteLink.href = "/myblog/public/posts/delete/" + postId;
        deleteModal.style.display = "flex";
    }
    function closeDeleteModal() { deleteModal.style.display = "none"; }

    window.onclick = function(event) {
        if (event.target == addModal) { addModal.style.display = "none"; }
        if (event.target == topicModal) { topicModal.style.display = "none"; }
        if (event.target == deleteModal) { deleteModal.style.display = "none"; }
    }
</script>