<h2>Listado con todas las fotos del módulo fotocliente</h2>

{foreach from=$fotos item=foto}
  <div class="fotocliente_bloque col-xs-12">
    {if $enable_comment == '1'}
      <div class="fotocliente_img col-xs-12">{$foto.comment}</div>
    {/if}
    <img class="fotocliente_img col-xs-12" src="{$base_dir}{$foto.foto}">
  </div>
{/foreach}