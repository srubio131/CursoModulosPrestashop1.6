<fieldset>
  <h3>Módulo de Fotos de Clientes</h3>
  <div class="panel">
    <div class="panel-heading">
      <legend>
        <img src="../img/admin/cog.gif" alt="" width="16"/>
        Configuración
      </legend>
    </div>
    <form action="" method="post">
      <div class="form-group clearfix">
        <label class="col-lg-3">Añadir comentario:</label>
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
        <input class="btn btn-default pull-right" type="submit" name="fotocliente_form" value="Guardar" />
      </div>
    </form>
  </div>
</fieldset>