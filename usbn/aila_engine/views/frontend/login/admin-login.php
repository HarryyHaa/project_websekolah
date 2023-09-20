  <div class="content"> 
    <!--<div class="card-content  height-470">-->
        <h4 class="center">Login Admin ya</h4>
        <?php  echo  form_open('main/admin_login', array("class" => "form-signin"));?>

        <?php if ($this->session->flashdata('info')){?>
          <div class="row card-content red lighten-1 white-text center">
            <?=$this->session->flashdata('info');?>
          </div>
        <?php } else { ?> 
         <div class="row card-content alert-info  center">
           Silahkan login dengan Email dan password
         </div>
       <?php }?>
       <div class="row ">
        <div class="input-field col s12">
          <input autofocus="" id="email" name="email" type="text" class="validate"  value="<?=set_value('email');?>" required="">
          <label for="email">Email</label>
          <span class="red-text"><?=form_error('email');?></span>
        </div>
      </div>

      <div class="row ">
       <div class="input-field col s12">
        <input id="password" name="password" type="password" class="validate" required="">
        <label for="password">Password</label>
        <span class="red-text">
          <?=form_error('password');?>
        </span>
      </div>

      <div class="row">
        <div class="input-field col s12">
          <button type="submit" name="login" class="btn waves-effect  primary  col s12">Login</button>
        </div>
        <div class="form-actions create-account">
          <p>Selamat Datang Admin</p>
        </div>
      </div>
    </div>

    <?php echo form_close();?>
  </div>

  <!--untuk disable klik kanan-->
    <script language="JavaScript">

        document.addEventListener("contextmenu", function(e){
        e.preventDefault();
    }, false);
    </script>

    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
  <!--disable ctrl u dll-->
  <script>
  document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
            return false;
        } else {
            return true;
        }
  };
  
  document.onkeydown = function(e) {
  if(event.keyCode == 123) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
     return false;
  }
}

  $(document).keypress("u",function(e) {
    if(e.ctrlKey)
      {
      return false;
    }
      else
    {
      return true;
    }
  });

</script>