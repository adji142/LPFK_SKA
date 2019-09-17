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
    						<button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#basicExampleModal" id="add_btn">
							  Tambah Data Mesin
							</button>
    					</i>
    				</span>
		            <h5>Data table</h5>
		        </div>
		        <div class="widget-content">

		        	<table class="table table-bordered data-table">
		        		<thead>
			                <tr>
			                  <th>Kode Analizer</th>
			                  <th>Nama Analizer</th>
			                  <th>SN</th>
			                  <th>Merek</th>
			                  <th>Model</th>
			                  <th>Tersedia</th>
			                  <th>Keterangan</th>
			                  <th>Status</th>
			                  <th>aksi</th>
			                </tr>
		              	</thead>
		              	<tbody>
		              		<?php
		              			$disabled = '';
		              			$data_alat = $this->Apps_mod->getAlat_master();
		              			foreach ($data_alat->result() as $key) {
		              				if ($key->statustrx != 'Available') {
		              					$disabled = 'disabled';
		              				}
		              				else{
		              					$disabled = '';
		              				}
		              				echo "
		              					<tr>
		              						<td>".$key->kode_alat."</td>
		              						<td>".$key->nama_alat."</td>
		              						<td>".$key->no_seri."</td>
		              						<td>".$key->merk."</td>
		              						<td>".$key->model."</td>
		              						<td>".$key->stock."</td>
		              						<td>".$key->comment."</td>
		              						<td>".$key->statustrx."</td>
		              						<td>
		              							<button class = 'btn btn-mini btn-danger delete' id = '".$key->id."' ".$disabled.">Delete</button>
		              							<button class = 'btn btn-mini btn-info edit' id = '".$key->id."' ".$disabled.">Edit</button>
		              							<button class = 'btn btn-mini btn-warning pelihara' id = '".$key->id."' ".$disabled.">Pemeliharaan</button>
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
	    	<form action="#" class="form-horizontal" enctype='application/json' id="post_pelihara">
	    		<div class="control-group">
	              <label class="control-label">Nomer Transaksi :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Nomer Transaksi" id="notrans" name="notrans" readonly="" required="" />
	                <input type="hidden" name="stockid" id="stockid">
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Tanggal Transaksi :</label>
	              <div class="controls">
	                <input type="date" class="span3" placeholder="Tanggal Transaksi" id="tgltrans" name="tgltrans" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Nama Vendor :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Nama Vendor" id="vendor" name="vendor" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Nama Penanggungjawan :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Nama Penanggungjawan" id="pic" name="pic" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Keterangan :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Keterangan" id="ket" name="ket"/>
	              </div>
	            </div>
	            <button class="btn btn-primary" id="btn_Save_maintain">Save</button>
	    	</form>
	    </div>
  	</div>
  </div>
</div>
<!-- Modal -->
<div class="modal hide" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <!-- Input from hire -->
        <form action="#" class="form-horizontal" enctype='application/json' id="SimpanAlat">
        	<div class="control-group">
              <label class="control-label">Kode Alat :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Kode Alat" id="kdalat" name="kdalat" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Alat :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nama Alat" id="nmalat" name="nmalat" required="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Merek :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Merek" id="merk" name="merk" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Model :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Model" id="model" name="model" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nomer Seri Mesin :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nomer Seri Mesin" id="sn" name="sn" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Mesin Masuk :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Tanggal Mesin Masuk" id="tgl" name="tgl" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Jumlah Unit :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Jumlah Unit" id="jml" name="jml" required=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Keterangan :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Keterangan" id="ket" name="ket"/>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Save_Btn">Save changes</button>
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
	    $('#Save_Btn').click(function () {
	    	// parapeter form
	    	var kdalat = $('#kdalat').val();
	    	var nmalat = $('#nmalat').val();
	    	var merk = $('#merk').val();
	    	var model = $('#model').val();
	    	var sn = $('#sn').val();
	    	var tgl = $('#tgl').val();
	    	var ket = $('#ket').val();
	    	var jml = $('#jml').val();

	    	$('#Save_Btn').text('Tunggu Sebentar');
			$('#Save_Btn').attr('disabled',true);
	    	// validasi form
	    	if (kdalat == '' || nmalat == '' || merk == '' || model == '' || sn == '' || tgl == '' || jml == 0) {
	    		$('#basicExampleModal').modal('toggle');
	    		Swal.fire({
                  type: 'error',
                  title: 'Oops...',
                  text: 'Field Tidak Boleh Kosong!',
                  // footer: '<a href>Why do I have this issue?</a>'
                }).then((result)=>{
                    $('#basicExampleModal').modal('toggle');
                    $('#Save_Btn').text('Save changes');
					$('#Save_Btn').attr('disabled',false);
                });
	    	}
	    	else{
	    		// proses input ke database
	    		if (form_mode == 'add') {
	    			// add mode
	    			$.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/InsertMesinData',
			        data    : {kdalat:kdalat,nmalat:nmalat,merk:merk,model:model,sn:sn,tgl:tgl,ket:ket,jml:jml},
			        dataType: 'json',
			        success : function (response) {
			          if(response.success == true){
			            $('#basicExampleModal').modal('toggle');
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
			            $('#basicExampleModal').modal('toggle');
			            Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            });
			            $('#basicExampleModal').modal('show');
			          }
			        }
			      });
	    		}
	    		else{
	    			// edit mode
	    			$.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/EditMesinData',
			        data    : {kdalat:kdalat,nmalat:nmalat,merk:merk,model:model,sn:sn,tgl:tgl,ket:ket,jml:jml},
			        dataType: 'json',
			        success : function (response) {
			          if(response.success == true){
			            $('#basicExampleModal').modal('toggle');
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
			            $('#basicExampleModal').modal('toggle');
			            Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            });
			            $('#basicExampleModal').modal('show');
			          }
			        }
			      });
	    		}
	    	}
	    });

	    $('.edit').click(function () {
	    	var id = $(this).attr("id");
	    	form_mode = 'edit';
	    	$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Apps/GetMesinData',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		          $.each(response.data,function (k,v) {
		            $('#kdalat').val(v.kode_alat);
			    	$('#nmalat').val(v.nama_alat);
			    	$('#merk').val(v.merk);
			    	$('#model').val(v.model);
			    	$('#sn').val(v.no_seri);
			    	$('#tgl').val(v.tgl_masuk);
			    	$('#ket').val(v.comment);
			    	$('#jml').val(v.jumlah);
		          });
		          $('#kdalat').attr('readonly',true);
		          $('#title_modal').empty();
		          $('#title_modal').append('Edit Data');
		          $('#basicExampleModal').modal('show');
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

	    $('.delete').click(function () {
	    	var id = $(this).attr("id");
	    	Swal.fire({
			  title: 'Apakah Anda Yakin?',
			  text: "Anda Akan Menghapus Item ini!",
			  type: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
			  if (result.value) {
			    $.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/EditMesinData',
			        data    : {id:id},
			        dataType: 'json',
			        success : function (response) {
			          if(response.success == true){
			            Swal.fire({
			              type: 'success',
			              title: 'Horay..',
			              text: 'Data Berhasil di hapus!',
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			              location.reload();
			            });
			          }
			          else{
			            Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            });
			          }
			        }
			      });
			  }
			})
	    });

	    $('.pelihara').click(function () {
	    	var id = $(this).attr("id");
	    	$('#stockid').val(id);

	    	$('#modalPelihara').modal('show')
	    });
	    $('#post_pelihara').submit(function (e) {
	    	$('#btn_Save_maintain').text('Tunggu Sebentar.....');
		    $('#btn_Save_maintain').attr('disabled',true);

		    e.preventDefault();
		    var me = $(this);
		    $.ajax({
		        type    :'post',
		        url     : '<?=base_url()?>Apps/InserPemeliharaan',
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
	    });
	});
	function reset() {
		$('#kdalat').attr('readonly',false);
		$('#kdalat').val('');
    	$('#nmalat').val('');
    	$('#merk').val('');
    	$('#model').val('');
    	$('#sn').val('');
    	$('#tgl').val('');
    	$('#ket').val('');
    	$('#jml').val(0);
	}
</script>