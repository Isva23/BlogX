const app_myposts = {

    url : "/app/app.php",

    mp : $("#my-posts"),
    vp : $("#post"),

    getMyPosts : function(uid){
        let html = `<tr><td colspan="3">Aun no tienes publicaciones</tr></td>`;
        this.mp.html("");

        fetch(this.url + "?_mp&uid=" + uid)
        .then(resp => resp.json())
        .then(mpresp => {
            if(mpresp.length > 0){
                html = "";
                for(let post of mpresp){
                    html += `
                    <tr>
                        <td>${post.title}</td>
                        <td>${post.created_at}</td>
                        <td>
                        <a href="#" class="link-primary" onclick="app_myposts.verPost(${post.id})"><i class="bi bi-eye"></i></a>
                        <a href="#" class="link-primary mx-2" onclick="app_myposts.editPost(${post.id})"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="link-success" onclick=""><i class="bi bi-toggle-on"></i></a>
                        <a href="#" class="link-secondary mx-2" onclick="app_myposts.deletePost(${post.id})"><i class="bi bi-trash"></i></a>
                    </tr>
                    
                    `;
                }
            }
            this.mp.html(html);

        }).catch(err => console.error(err));

    },
    deletePost : function(id){
      Swal.fire({
        title: 'Deseas borrar esto?',
        text: "Se borra la publicacion y los comentarios",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Publicación eliminada!',
            'comentarios y publicación eliminados',
            'success'
          )
          fetch(this.url + "?_del&id=" + id)
          .then(response => response.json())
            .then(deleteResp => {
              location.reload();
              if(deleteResp.success){
                console.log(`borrado Correcto`);
              } else {
                console.error(deleteResp.message);
              }
            })
            .catch(err => console.error(err));
        }
      })
    },
    verPost: function(id){
      fetch(this.url + "?_vp&id=" + id)
      .then(resp => resp.json())
        .then(mpresp => {
            if(mpresp.length > 0){
                html = "";
                for(let post of mpresp){
                    html += `
                    <h3 class="panel-title">${post.title}</h3>
                    <small><i class="bi bi-person-circle"></i> 
                      <b>${post.name}<b/>
                    </small>
                    <div class="panel-body">${post.body}</div>
                    `;
                }
            }
            $("#modal-body1").html(html);
            $("#modal-1").modal("show");
        }).catch(err => console.error(err));
    },
    editPost: function($id){
      let html = `
      <section class="container pt-5">
      <h1 class="border-bottom">Editar Publicacion</h1>
      <form action="/app/app.php" method="POST">
      <div class="card">
          <div class="card-body">
              <input type="hidden" name="uid" value="<?=$ua->id?>">
              <input type="hidden" name="_ep" value="true">
              <div class="mb-3">
                  <label for="title" class="form-label">Titulo</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Titulo de la publicacion" required>
              </div>
          </div>
          <div class="mb-3">
              <label for="body" class="form-label">Texto</label>
              <textarea name="body" id="body" cols="80" rows="10" class="form-control" required></textarea>
          </div>
          <div class="card-footer">
              <button class="btn btn-primary float-end" type="submit">Guardar</button>
          </div>
      </div>
  
      </form>
  </section>
      `;
      $("#modal-body2").html(html);
      $("#modal-2").modal("show");
    }
}
