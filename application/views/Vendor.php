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
    				<span class="icon">
    					<i class="">
    						<button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#modalPelihara" id="add_btn">
							  Tambah Data Vendor
							</button>
    					</i>
    				</span>
		            <h5>Master Vendor</h5>
		        </div>
		        <div class="widget-content">

		        	<table class="table table-bordered data-table">
		        		<thead>
			                <tr>
			                  <th>Kode Vendor</th>
			                  <th>Nama Vendor</th>
			                  <th>Alamat</th>
			                  <th>No Tlp</th>
			                  <th>Tanggal Masuk</th>
			                  <th>Aksi</th>
			                </tr>
		              	</thead>
		              	<tbody>
		              		<?php
		              			$disabled = '';
		              			$data_alat = $this->ModelsExecuteMaster->GetData('mastervendor');
		              			foreach ($data_alat->result() as $key) {
		              				echo "
		              					<tr>
		              						<td>".$key->kodevendor."</td>
		              						<td>".$key->namavendor."</td>
		              						<td>".$key->alamat."</td>
		              						<td>".$key->tlp."</td>
		              						<td>".$key->tglmasuk."</td>
		              						<td>
		              							<button class = 'btn btn-mini btn-info edit' id = '".$key->id."'>Edit</button>
		              						</td>
		              					</tr>
		              				";
		              			}
		              		?>
		              	</tbody>
		        	</table>
		        </div>
    		</div>
    	</div>
    </div>
  </div>
<!-- </div> -->
<!-- Button trigger modal -->
<div class="modal hide" id="modalPelihara" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog-scrollable" role="document">
  	<div class="modal-content">
  		<div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel"><div id="title_modal"></div></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	    </div>
	    <div class="modal-body">
	    	<form class="form-horizontal" enctype='application/json' id="post_pegawai">
	    		<div class="control-group">
	              <label class="control-label">Kode Vendor :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Kode Vendor" id="kode" name="kode" required="" />
	                <input type="hidden" name="stockid" id="stockid">
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Nama Vendor :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Nama Vendor" id="nama" name="nama" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Alamat :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Alamat" id="alamat" name="alamat" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">No Telepon :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="No Telepon" id="tlp" name="tlp"/>
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Tanggal Masuk :</label>
	              <div class="controls">
	                <input type="date" class="span3" id="joindate" name="joindate"/>
	              </div>
	            </div>
	            <button class="btn btn-primary" id="btn_Save_maintain">Save</button>
	    	</form>
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

	    $(document).ready(function () {
	    	form_mode = 'add';
	    	var table = 'pemeliharaan';
	    	var field = 'notransaksi';
	    	var prev = 0;
	    	$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Transaction/GetNumeric',
		      data    : {table:table,field:field},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		        	var str = "" + response.prefix;
					var pad = "0000";
					var ans = pad.substring(0, pad.length - str.length) + str;

					var today = new Date();
					var year = today.getFullYear();
					var month = today.getMonth();

			    	$('#notrans').val('3'+year+''+month+''+ans);
		        }
		      }
		    });
	    });

	    $('#add_btn').click(function () {
	    	form_mode = 'add';
	    	reset();
	    	$('#title_modal').empty();
	    	$('#title_modal').append('Tambah Data Baru');
	    });

	    $('.edit').click(function () {
	    	var id = $(this).attr("id");
	    	form_mode = 'edit';
	    	$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Apps/GetVendorData',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		          $.each(response.data,function (k,v) {
		            $('#kode').val(v.kodevendor);
					$('#nama').val(v.namavendor);
					$('#alamat').val(v.alamat);
					$('#tlp').val(v.tlp);
					$('#joindate').val(v.tglmasuk);
		          });
		          $('#kode').attr('readonly',true);
		          $('#title_modal').empty();
		          $('#title_modal').append('Edit Data');
		          $('#modalPelihara').modal('show');
		        }
		        else{
		            Swal.fire({
		              type: 'error',
		              title: 'Woops...',
		              text: response.message,
		              // footer: '<a href>Why do I have this issue?</a>'
		            }).then((result)=>{
		              location.reload();
		            });
		        }
		      }
		    });
	    });

	    $('#post_pegawai').submit(function (e) {
	    	$('#btn_Save_maintain').text('Tunggu Sebentar.....');
		    $('#btn_Save_maintain').attr('disabled',true);
		    e.preventDefault();
			var me = $(this);
		    if (form_mode == 'add') {    
			    $.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/InsertVendorData',
			        data    : me.serialize(),
			        dataType: 'json',
			        success : function (response) {
			          if(response.success == true){
			            $('#modalPelihara').modal('toggle');
			            Swal.fire({
			              type: 'success',
			              title: 'Horay..',
			              text: 'Data Berhasil disimpan!',
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			              location.reload();
			            });
			          }
			          else{
			            $('#modalPelihara').modal('toggle');
			            Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			            	$('#modalPelihara').modal('show');
				            $('#btn_Save_maintain').text('Save');
				            $('#btn_Save_maintain').attr('disabled',false);
			            });
			          }
			        }
			      });
			}
			else{
				$.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/EditVendorData',
			        data    : me.serialize(),
			        dataType: 'json',
			        success : function (response) {
			          if(response.success == true){
			            $('#modalPelihara').modal('toggle');
			            Swal.fire({
			              type: 'success',
			              title: 'Horay..',
			              text: 'Data Berhasil disimpan!',
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			              location.reload();
			            });
			          }
			          else{
			            $('#modalPelihara').modal('toggle');
			            Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			            	$('#modalPelihara').modal('show');
				            $('#btn_Save_maintain').text('Save');
				            $('#btn_Save_maintain').attr('disabled',false);
			            });
			          }
			        }
			      });
			}
	    });
	});
	function reset() {
		$('#kode').val('');
		$('#nama').val('');
		$('#alamat').val();
		$('#tlp').val('');
		$('#joindate').val('');
	}
</script>