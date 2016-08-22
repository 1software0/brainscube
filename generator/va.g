<?= $this->insert('overall/header',$data_header) ?>
<?= $this->insert('overall/header_no',$data_info) ?>

<form id="{{action}}_form" role="form">
  <div class="alert hide" id="ajax_{{action}}"></div>
  <div class="form-group">
    <label class="cole">Ejemplo:</label>
    <input type="text" class="form-control form-input" name="ejemplo" placeholder="Escribe algo..." />
  </div>
  <div class="form-group">
    <button type="button" id="{{action}}" class="btn red  btn-block">Enviar</button>
  </div>
</form>

<?= $this->insert('overall/footer') ?>
<script src="views/app/js/{{action}}.js"></script>
