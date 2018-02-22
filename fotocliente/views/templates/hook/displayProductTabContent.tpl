<h3 class="page-product-heading">Fotos de clientes</h3>
{if isset($savedForm)}
  <div class="alert alert-success">{$savedForm}</div>
{/if}
{if isset($errorForm)}
  <div class="alert alert-danger">{$errorForm}</div>
{/if}
<div class="fotocliente_bloque">
  <form action="" enctype="multipart/form-data" method="post" id="comment-form">
    <div class="form-group col-xs-12 col-md-4">
      <label for="foto">Foto:</label>
      <input type="file" name="foto" id="foto" />
    </div>
    <div class="form-group col-xs-12 col-md-8" 
         style="{if $enable_comment == '0'} display:none; {/if}">
      <label for="comment">Comentario:</label>
      <textarea name="comentario" id="comentario" class="formcontrol"></textarea>
    </div>
    <br>
    <div class="submit fotocliente_bloque">
      <button type="submit" name="fotocliente_submit_foto" class="button btn btn-default button-medium">
        <span>Enviar<i class="icon-chevron-right right"></i></span>
      </button>
    </div>
  </form>
</div>