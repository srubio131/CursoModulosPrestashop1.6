<h3 class="page-product-heading">{l s='Fotos de clientes' mod='fotocliente'}</h3>
{if isset($savedForm)}
  <div class="alert alert-success">{l s='Imagen añadida' mod='fotocliente'}</div>
{/if}
{if isset($errorForm)}
  <div class="alert alert-danger">{$errorForm}</div>
{/if}
{foreach from=$fotos item=foto}
  <div class="fotocliente_bloque">
    <img class="fotocliente_img col-xs-12 col-md-6" src="{$base_dir}{$foto.foto}">
    {if $enable_comment == '1'}
      <div class="fotocliente_img col-xs-12 col-md-6">{$foto.comment}</div>
    {/if}
  </div>
{/foreach}

<!-- Genera un link propio de un módulo. (<modulo>,<controlador>,<parámetros>) -->
{assign var=params value=['module_action'=>'listafotos'] }
<a href="{$link->getModuleLink('fotocliente','fotos',$params)}">
  <span>{l s='Ver todas las fotos' mod='fotocliente'}</span>
</a>

<div class="fotocliente_bloque">
  <form action="" enctype="multipart/form-data" method="post" id="comment-form">
    <div class="form-group col-xs-12 col-md-4">
      <label for="foto">{l s='Foto' mod='fotocliente'}:</label>
      <input type="file" name="foto" id="foto" />
    </div>
    <div class="form-group col-xs-12 col-md-8" 
         style="{if $enable_comment == '0'} display:none; {/if}">
      <label for="comment">{l s='Comentario' mod='fotocliente'}:</label>
      <textarea name="comentario" id="comentario" class="formcontrol"></textarea>
    </div>
    <br>
    <div class="submit fotocliente_bloque">
      <button type="submit" name="fotocliente_submit_foto" class="button btn btn-default button-medium">
        <span>{l s='Enviar' mod='fotocliente'}<i class="icon-chevron-right right"></i></span>
      </button>
    </div>
  </form>
</div>