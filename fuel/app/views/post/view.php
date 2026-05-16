<style>
    .full-post-wrapper { width: 864px; background: white; border-radius: 12px; padding: 50px 60px; margin: 0 auto 50px auto; box-shadow: 0 4px 10px rgba(0,0,0,0.03); box-sizing: border-box;}
    .post-card-actions { background-color: #fcfaff; padding: 15px 40px; display: flex; justify-content: flex-end; gap: 12px; border-top: 1px solid rgba(145, 53, 255, 0.1); margin: 0 -60px -50px -60px; border-radius: 0 0 12px 12px; }
    .btn-action { display: flex; align-items: center; gap: 8px; padding: 8px 16px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-size: 13px; font-weight: 500; cursor: pointer; border: none; text-decoration: none; }
    .btn-action-edit { background-color: var(--accent-purple); color: white; }
    .btn-action-edit:hover { background-color: var(--logo-tonic); }
    .btn-action-delete { background-color: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.5); }
    .btn-action-delete:hover { background-color: #fef2f2; }
    
    .modal-overlay { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.4); backdrop-filter: blur(4px); justify-content: center; align-items: center; }
    .modal-content { background-color: white; padding: 40px; border-radius: 12px; width: 500px; max-width: 90%; position: relative; text-align: center; font-family: 'Poppins', sans-serif;}
    .modal-title-red { color: #b91c1c; font-weight: 600; margin-bottom: 10px; margin-top: 0;}
    .delete-icon-wrapper { width: 60px; height: 60px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; }
    .confirm-actions { display: flex; justify-content: center; gap: 15px; margin-top: 25px; }
    .btn-cancel { background: transparent; border: 1px solid #d1d5db; border-radius: 6px; padding: 10px 24px; font-family: 'Poppins', sans-serif; cursor: pointer; }
    .btn-confirm-delete { background: #ef4444; color: white; border: none; border-radius: 6px; padding: 10px 24px; font-family: 'Poppins', sans-serif; cursor: pointer; text-decoration: none; }
    .btn-confirm-delete:hover { background: #dc2626; }
    
    .btn-back { display: inline-flex; align-items: center; gap: 5px; color: var(--text-light); text-decoration: none; font-size: 14px; font-weight: 500; margin-bottom: 30px; transition: color 0.3s; }
    .btn-back:hover { color: var(--accent-purple); }
    .full-post-image { width: 100%; height: 400px; object-fit: cover; border-radius: 10px; margin-bottom: 30px; background-color: #f3f4f6;}

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
        background-color: #ff6464; 
    }

</style>

<div class="full-post-wrapper">
    <a href="/myblog/public/posts" class="btn-back">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/></svg>
        Volver a la portada
    </a>

    <img src="<?php echo !empty($post->image_url) ? $post->image_url : '/myblog/public/assets/img/first-fuel-project.jpg'; ?>" class="full-post-image" alt="Cover del post">

    <h1 style="color: var(--text-main); font-weight: 500; margin-top:0; font-size: 32px;"><?php echo $post->title; ?></h1>
    
    <div style="display: flex; gap: 15px; margin-bottom: 30px; font-size: 13px; color: var(--text-light);">
        <span style="display: flex; align-items: center; gap: 6px;">
            <span style="display: inline-block; width: 8px; height: 8px; border-radius: 50%; background-color: var(--accent-purple);"></span>
            <?php echo $post->category; ?>
        </span>
    </div>

    <div style="font-size: 15px; line-height: 1.8; color: var(--text-main); white-space: pre-wrap; margin-bottom: 50px;">
        <?php echo $post->content; ?>
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

<div id="deleteConfirmModal" class="modal-overlay">
    <div class="modal-content">
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
    const deleteModal = document.getElementById('deleteConfirmModal');
    const confirmDeleteLink = document.getElementById('confirmDeleteLink');

    function openDeleteModal(postId) {
        confirmDeleteLink.href = "/myblog/public/posts/delete/" + postId;
        deleteModal.style.display = "flex";
    }
    function closeDeleteModal() { deleteModal.style.display = "none"; }
    window.onclick = function(event) { if (event.target == deleteModal) { deleteModal.style.display = "none"; } }
</script>