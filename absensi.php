<?php include 'koneksi/config.php'; date_default_timezone_set('Asia/Jakarta'); ?>

<div class="container" id="divabsen">
  <div class="card oke">
    <div class="card-header">
      <div class="error-message" id="datetime"></div>
      <hr>
      <input type="hidden" id="idstatus">
      	Status : <b class="cekstatus">Jam ?</b>
    </div>
    <div class="card-body">
      <!-- <form> -->
      <form method="post" action="php/absen.php">
        <div class="form-floating mb-3">
          <input type="text" name="rfid" class="form-control" pattern="\d*" autofocus id="inputrfid" min="0" maxlength="6" placeholder="">
          <label for="inputrfid">Silahkan Tap</label>
        </div>
        <div class="form-floating">            
        </div>
        <button class="btn btn-sm btn-primary btn-user btn-block mt-1" type="submit" name="absen" style="display: none;">Submit</button>
      </form>
      <!-- </form> -->
    </div>
  </div>
</div>
<script type="text/javascript">
   
</script>