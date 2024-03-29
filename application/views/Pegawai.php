<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'daftarmesin';
?>
<style type="text/css">
	.preview{
	   width: 100px;
	   height: 100px;
	   border: 1px solid black;
	   margin: 0 auto;
	   background: white;
	}

	.preview img{
	   display: none;
	}
</style>
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
							  Tambah Data Pegawai
							</button>
    					</i>
    				</span>
		            <h5>Master Pegawai</h5>
		        </div>
		        <div class="widget-content">

		        	<table class="table table-bordered data-table">
		        		<thead>
			                <tr>
			                  <th>Gambar</th>
			                  <th>NIK</th>
			                  <th>Nama Pegawai</th>
			                  <th>Jenis Kelamin</th>
			                  <th>Divisi</th>
			                  <th>Jabatan</th>
			                  <th>Alamat</th>
			                  <th>No Tlp</th>
			                  <th>Join Date</th>
			                  <th>Resign Date</th>
			                  <th>Aksi</th>
			                </tr>
		              	</thead>
		              	<tbody>
		              		<?php
		              			$disabled = '';
		              			$data_alat = $this->ModelsExecuteMaster->GetData('pegawai');
		              			foreach ($data_alat->result() as $key) {
		              				echo "
		              					<tr>
		              						<td width='10%'><center><img src = '".$key->image."' width='50%'></center></td>
		              						<td>".$key->nik."</td>
		              						<td>".$key->nama."</td>
		              						<td>".$key->jeniskelamin."</td>
		              						<td>".$key->divisi."</td>
		              						<td>".$key->jabatan."</td>
		              						<td>".$key->alamat."</td>
		              						<td>".$key->notlp."</td>
		              						<td>".$key->tgljoin."</td>
		              						<td>".$key->tglresign."</td>
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
	    	<form class="form-horizontal" enctype='multipart/form-data' id="post_pegawai">
	    		<div class="control-group">
	              <label class="control-label">NIK :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="NIK" id="nik" name="nik" required="" />
	                <input type="hidden" name="stockid" id="stockid">
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Nama Pegawai :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Nama Pegawai" id="nama" name="nama" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Jenis Kelamin :</label>
	              <div class="controls">
	                <select id="jk" name="jk" required="">
	                	<option value="L"> Laki Laki</option>
	                	<option value="P"> Perempuan</option>
	                </select>
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Divisi :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Divisi" id="divisi" name="divisi" required="" />
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Jabatan :</label>
	              <div class="controls">
	                <input type="text" class="span3" placeholder="Jabatan" id="jabatan" name="jabatan" required="" />
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
	              <label class="control-label">Join Date :</label>
	              <div class="controls">
	                <input type="date" class="span3" id="joindate" name="joindate"/>
	              </div>
	            </div>
	            <div class="control-group">
	              <label class="control-label">Resign Date :</label>
	              <div class="controls">
	                <input type="date" class="span3" id="resigndate" name="resigndate"/>
	              </div>
	            </div>
		        <div class="control-group">
		          <label class="control-label">File upload input</label>
		          <div class="controls">
		            <input type="hidden" class="span5" placeholder="Group Name" id="idbanner" name="idbanner"/>
		            <input type="file" id="bannerimage" name="bannerimage" />
		            <img src="" id="profile-img-tag" width="100" />
		          </div>
		        </div>
		        <textarea id="image" name="image" style="display: none;"></textarea>
		        <!-- <div class="control-group">
			      <img src="" id="profile-img-tag" width="100" />
			    </div> -->
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
		      url     : '<?=base_url()?>Apps/GetPegawaiData',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		          $.each(response.data,function (k,v) {
		            $('#nik').val(v.nik);
					$('#nama').val(v.nama);
					$('#divisi').val(v.divisi);
					$('#alamat').val(v.alamat);
					$('#tlp').val(v.notlp);
					$('#joindate').val(v.tgljoin);
					$('#resigndate').val(v.tglresign);
					$('#jk').val(v.jeniskelamin).change();
					$('#jabatan').val(v.jabatan);
					$('#image').val(v.image);
					$("#profile-img-tag").attr("src", v.image);
		          });
		          $('#nik').attr('readonly',true);
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
	    $("#bannerimage").change(function(){
	        readURL(this);
	        encodeImagetoBase64(this);
	    });
	    $('#post_pegawai').submit(function (e) {
	    	$('#btn_Save_maintain').text('Tunggu Sebentar.....');
		    $('#btn_Save_maintain').attr('disabled',true);
		    e.preventDefault();
			var me = $(this);

		    if (form_mode == 'add') {    
			    $.ajax({
			        type    :'post',
			        url     : '<?=base_url()?>Apps/InsertPegawaiData',
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
			        url     : '<?=base_url()?>Apps/EditPegawaiData',
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
		$('#nik').val('');
		$('#nama').val('');
		$('#divisi').val('');
		$('#alamat').val('');
		$('#tlp').val('');
		$('#joindate').val('');
		$('#resigndate').val('');
	}
	function readURL(input) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	          
	        reader.onload = function (e) {
	            $('#profile-img-tag').attr('src', e.target.result);
	        }
	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function encodeImagetoBase64(element) {
		$('#image').val('');
	    var file = element.files[0];

	    var reader = new FileReader();

	    reader.onloadend = function() {

	      // $(".link").attr("href",reader.result);

	      // $(".link").text(reader.result);
	      $('#image').val(reader.result);
	    }

	    reader.readAsDataURL(file);

	  }
</script>