<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'daftarmesin';
?>
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

    <div class="row-fluid">
    	<div class="span12">
    		<div class="widget-box">
    			<div class="widget-title"> 
		            <h5>Master Pegawai</h5>
		        </div>
		        <div class="widget-content">
		        	<form action="#" class="form-horizontal" enctype='application/json' id="changepassword">
					  <div class="control-group">
					    <label class="control-label">Username :</label>
					    <div class="controls">
					      <input type="text" class="span3" placeholder="Kode FASYANKES" id="user" name="user" value="<?php echo $NamaUser;?>" readonly/>
					      <input type="hidden" class="span3" placeholder="Kode FASYANKES" id="id" name="id" value="<?php echo $user_id;?>"/>
					      <input type="hidden" id="base" value="<?php echo base_url(); ?>">
					    </div>
					  </div>
					  <div class="control-group">
					    <label class="control-label">New Password :</label>
					    <div class="controls">
					      <input type="Password" class="span3" placeholder="Password Baru" id="pass" name="pass" />
					    </div>
					  </div>
					  <button class="btn btn-primary" id="Save_Btn">Save</button>
					</form>
		        </div>
    		</div>
    	</div>
    </div>
  </div>
<!--end-main-container-part-->

<?php
    require_once(APPPATH."views/parts/footer.php");
?>

<script type="text/javascript">
	$(function () {
		var form_mode = '';
	    $.ajaxSetup({
	        beforeSend:function(jqXHR, Obj){
	            var value = "; " + document.cookie;
	            var parts = value.split("; csrf_cookie_token=");
	            if(parts.length == 2)   
	            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
	        }
	    });

	    $('#changepassword').submit(function (e) {
		    $('#Save_Btn').text('Tunggu Sebentar.....');
		    $('#Save_Btn').attr('disabled',true);
		    e.preventDefault();
		    var me = $(this);
		    var base = $('#base').val();
		      $.ajax({
		          type    :'post',
		          url     : '<?=base_url()?>Auth/changepass',
		          data    : me.serialize(),
		          dataType: 'json',
		          success : function (response) {
		            if(response.success == true){
		              $('#ChangePass').modal('toggle');
		              Swal.fire({
		                type: 'success',
		                title: 'Horay..',
		                text: 'Password Berhasil di rubah, silahkan logout dan login dengan password baru!',
		                // footer: '<a href>Why do I have this issue?</a>'
		              }).then((result)=>{
		                // window.location.href = "";
		                window.location.replace(base+"/Auth/logout");
		              });
		            }
		            else{
		              $('#ChangePass').modal('toggle');
		              Swal.fire({
		                type: 'error',
		                title: 'Woops...',
		                text: response.message,
		                // footer: '<a href>Why do I have this issue?</a>'
		              }).then((result)=>{
		                $('#ChangePass').modal('show');
		                $('#Save_Btn').text('Save');
		                $('#Save_Btn').attr('disabled',false);
		              });
		            }
		          }
		        });
		      });
	});
</script>
