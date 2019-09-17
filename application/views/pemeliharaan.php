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
		            <h5>Data Pemeliharaan</h5>
		        </div>
		        <div class="widget-content">

		        	<table class="table table-bordered data-table">
		        		<thead>
			                <tr>
			                  <th>Nomer Transaksi</th>
			                  <th>Tanggal Pemeliharaan</th>
			                  <th>Tanggal Selesai</th>
			                  <th>Kode Analizer</th>
			                  <th>Nama Analizer</th>
			                  <th>Vendor</th>
			                  <th>PenanggungJawab</th>
			                  <th>Keterangan</th>
			                  <th>aksi</th>
			                </tr>
		              	</thead>
		              	<tbody>
		              		<?php
		              			$disabled = '';
		              			$data_alat = $this->Apps_mod->GetPemeliharaan();
		              			foreach ($data_alat->result() as $key) {
		              				if ($key->tglselesai != NULL) {
		              					$disabled = 'disabled';
		              				}
		              				else{
		              					$disabled = '';
		              				}
		              				echo "
		              					<tr>
		              						<td>".$key->notransaksi."</td>
		              						<td>".$key->tglpemeliharaan."</td>
		              						<td>".$key->tglselesai."</td>
		              						<td>".$key->kode_alat."</td>
		              						<td>".$key->nama_alat."</td>
		              						<td>".$key->namavendor."</td>
		              						<td>".$key->penanggungjawab."</td>
		              						<td>".$key->comment1."</td>
		              						<td>
		              							<button class = 'btn btn-mini btn-warning selesai' id = '".$key->notransaksi."' ".$disabled.">Selesai</button>
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
	              <label class="control-label">Tanggal Selesai :</label>
	              <div class="controls">
	                <input type="date" class="span3" placeholder="Tanggal Transaksi" id="tgltrans" name="tgltrans" required="" />
	                <input type="hidden" name="notrx" id="notrx">
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
	    });

	    $('.selesai').click(function () {
	    	var id = $(this).attr("id");
	    	$('#notrx').val(id);

	    	$('#modalPelihara').modal('show');
	    });
	    $('#post_pelihara').submit(function (e) {
	    	$('#btn_Save_maintain').text('Tunggu Sebentar.....');
		    $('#btn_Save_maintain').attr('disabled',true);

		    e.preventDefault();
		    var me = $(this);
		    $.ajax({
		        type    :'post',
		        url     : '<?=base_url()?>Apps/pemeliharaanDone',
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