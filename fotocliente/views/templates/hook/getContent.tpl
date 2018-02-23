<fieldset>
  <h3>{l s='Módulo de Fotos de Clientes' mod='fotocliente'}</h3>
  <div class="panel">
    <div class="panel-heading">
      <legend>
        <img src="../img/admin/cog.gif" alt="" width="16"/>
        {l s='Configuración' mod='fotocliente'}
      </legend>
    </div>
    <form action="" method="post">
      <div class="form-group clearfix">
        <label class="col-lg-3">{l s='Añadir comentario' mod='fotocliente'}:</label>
        <div class="col-lg-9">

          <img src="../img/admin/enabled.gif" alt="" />
          <input type="radio" id="enable_comment_1" name="enable_comment" value="1"
          {if $enable_comment == "1"} checked {/if} />
          <label class="t" for="enable_comment_1">Sí</label>

          <img src="../img/admin/disabled.gif" alt="" />
          <input type="radio" id="enable_comment_0" name="enable_comment" value="0"
          {if $enable_comment == "0"} checked {/if} />
          <label class="t" for="enable_comment_0">No</label>

        </div>
      </div>
      <div class="panel-footer">
        <input class="btn btn-default pull-right" type="submit" name="fotocliente_form" value="{l s='Guardar' mod='fotocliente'}" />
      </div>
    </form>
  </div>
</fieldset>