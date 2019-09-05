<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'fasyankes';
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
							  Tambah Data Labolatorium
							</button>
    					</i>
    				</span>
		            <h5>Data table</h5>
		        </div>
		        <div class="widget-content">

		        	<table class="table table-bordered data-table">
		        		<thead>
			                <tr>
			                  <th>Kode Labolatorium</th>
			                  <th>Nama Labolatorium</th>
			                  <th>Keterangan</th>
			                  <th>aksi</th>
			                </tr>
		              	</thead>
		              	<tbody>
		              		<?php
		              			$data_alat = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null),'masterlabolatorium');
		              			foreach ($data_alat->result() as $key) {
		              				echo "
		              					<tr>
		              						<td>".$key->kodelab."</td>
		              						<td>".$key->namalab."</td>
		              						<td>".$key->comment."</td>
		              						<td>
		              							<button class = 'btn btn-mini btn-danger delete' id = '".$key->id."'>Delete</button>
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
              <label class="control-label">Kode Labolatorium :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Kode Labolatorium" id="kode" name="kode" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Labolatorium :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nama Labolatorium" id="nama" name="nama" required="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Masuk :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Tanggal Masuk" id="tgl" name="tgl" required=""/>
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
	    });

	    $('#add_btn').click(function () {
	    	form_mode = 'add';
	    	reset();
	    	$('#title_modal').empty();
	    	$('#title_modal').append('Tambah Data Baru');
	    });
	    $('#Save_Btn').click(function () {
	    	// parapeter form
	    	var kode = $('#kode').val();
	    	var nama = $('#nama').val();
	    	var tgl = $('#tgl').val();
	    	var ket = $('#ket').val();

	    	$('#Save_Btn').text('Tunggu Sebentar');
			$('#Save_Btn').attr('disabled',true);
	    	// validasi form
	    	if (kode == '' || nama == ''  || tgl == '') {
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
			        url     : '<?=base_url()?>Apps/InsertlabolatoriumData',
			        data    : {kode:kode,nama:nama,tgl:tgl,ket:ket},
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
			        url     : '<?=base_url()?>Apps/EditlabolatoriumData',
			        data    : {kode:kode,nama:nama,tgl:tgl,ket:ket},
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
		      url     : '<?=base_url()?>Apps/GetlabolatoriumData',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		          $.each(response.data,function (k,v) {
		            $('#kode').val(v.kodelab);
			    	$('#nama').val(v.namalab);
			    	$('#tgl').val(v.tglmasuk);
			    	$('#ket').val(v.comment);
		          });
		          $('#kode').attr('readonly',true);
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
			        url     : '<?=base_url()?>Apps/EditlabolatoriumData',
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
	});
	function reset() {
		$('#kode').attr('readonly',false);
		$('#kode').val('');
		$('#nama').val('');
		$('#tgl').val('');
		$('#ket').val('');
	}
</script>