<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'peminjaman';
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
		            <ul class="nav nav-tabs">
		              <li class="active"><a data-toggle="tab" href="#tab1">Transaksi</a></li>
		              <li><a data-toggle="tab" href="#tab2">List Pengembalian</a></li>
		            </ul>
		        </div>
		        <div class="widget-content tab-content">
		        	<div id="tab1" class="tab-pane active">
			        	<table class="table table-bordered data-table">
			        		<thead>
				                <tr>
				                  <th>#</th>
				                  <th>Nomor Transaksi</th>
				                  <th>Tanggal Transaksi</th>
				                  <th>Fasyankes</th>
				                  <th>Penanggung Jawab</th>
				                </tr>
			              	</thead>
			              	<tbody>
			              		<?php
			              			$datapinjam = $this->apps_mod->GetPeminjamanList();
			              			foreach ($datapinjam->result() as $key) {
			              				echo "
			              					<tr>
			              						<td style='white-space: nowrap;'>
			              							<center>
				              							<button class = 'btn btn-mini btn-info tip-top back' data-original-title='Kembalikan Alat' id = '".$key->notransaksi."'  data-toggle='modal' data-target='#basicExampleModal'><span class = 'icon icon-repeat'></span></button>
			              							</center>
			              						</td>
			              						<td>".$key->notransaksi."</td>
			              						<td>".$key->tgltransaksi."</td>
			              						<td>".$key->namafasyankes."</td>
			              						<td>".$key->namapeminjam."</td>
			              					</tr>
			              				";
			              			}
			              		?>
			              	</tbody>
			        	</table>
			        </div>
			        <div id="tab2" class="tab-pane">
			        	tab2
			        </div>
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
        <form action="#" class="form-horizontal" enctype='application/json' id="SimpanPinjam">
        	<div class="control-group">
              <label class="control-label">Nomer Transaksi :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nomer Transaksi" id="notrans" name="notrans" readonly="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Transaksi :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Tanggal Transaksi" id="tgltrans" name="tgltrans" readonly="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Fasyankes :</label>
                <!-- <input type="text" class="span3" placeholder="Nomer Transaksi" id="notrans" name="notrans" readonly="" /> -->
                <div class="control-group">
	              <div class="controls">
	                <select id="fasyankes" name="fasyankes" disabled="">
	                  <option value="">--- Select Data ---</option>
	                  <?php
	                  	$data_fas = $this->ModelsExecuteMaster->FindData(array('tglpasif'=>null),'masterfasyankes');
	                  	foreach ($data_fas->result() as $key) {
	                  		echo "<option value = '".$key->id."'>".$key->namafasyankes."</option>";
	                  	}
	                  ?>
	                </select>
	              </div>
	            </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Peminjam :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nama Peminjam" id="nama" name="nama" readonly="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Petugas :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nama Petugas" id="petugas" name="petugas" readonly=""/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan Pinjam :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Tujuan Pinjam" id="tujuan" name="tujuan" readonly=""/>
              </div>
            </div>
        </form>
        <hr>
        <center>Data Pengembalian</center>
        <hr>
        <form class="form-horizontal">
        	<div class="control-group">
              <label class="control-label">Nomer Transaksi :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nomer Transaksi" id="notranskembali" name="notranskembali" readonly="" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tanggal Transaksi :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Tanggal Transaksi" id="tgltranskmbali" name="tgltranskmbali"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Nama Penerima :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Nama Penerima" id="namapenerima" name="namapenerima"/>
              </div>
            </div>
        </form>
        <div id="gridContainer">
        	
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="Save_Btn">Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class="modal hide" id="ModalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <table class="table table-bordered data-table">
        	<thead>
              <tr>
              	<th>#</th>
                <th>Kode Mesin</th>
                <th>Nama Mesin</th>
                <th>Jumlah Pinjam</th>
                <th>Jumlah Kembali</th>
              </tr>
            </thead>
            <tbody id="load_data">
              
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- <button type="button" class="btn btn-primary" id="Save_Btn">Save changes</button> -->
      </div>
    </div>
  </div>
</div>
<!--end-main-container-part-->

<?php
    require_once(APPPATH."views/parts/footer.php");
?>

<script type="text/javascript">
	var row_Validate = 0;
	$(function () {
		var form_mode = '';
		var returnjson;
	    $.ajaxSetup({
	        beforeSend:function(jqXHR, Obj){
	            var value = "; " + document.cookie;
	            var parts = value.split("; csrf_cookie_token=");
	            if(parts.length == 2)   
	            Obj.data += '&csrf_token='+parts.pop().split(";").shift();
	        }
	    });

	 //    $('#table').editableTableWidget();
	    
	    var $TABLE = $('#table');
		var $BTN = $('#export-btn');
		var $EXPORT = $('#export');

		$('#Save_Btn').click(function () {
			var gridItems = $("#gridContainer").dxDataGrid('instance')._controllers.data._dataSource._items;

			var notrans = $('#notrans').val();
			var notranskembali = $('#notranskembali').val();
			var tgltranskmbali = $('#tgltranskmbali').val();
			var namapenerima = $('#namapenerima').val();
			// ===================== Insert pengembalian header =====================
			var row = 'header';
			if (tgltranskmbali != '' || namapenerima != '') {
				$.ajax({
			      type    :'post',
			      url     : '<?=base_url()?>Transaction/InsertPengembalianHeaderData',
			      data    : {notrans:notrans,notranskembali:notranskembali,tgltranskmbali:tgltranskmbali,namapenerima:namapenerima,row:row},
			      dataType: 'json',
			      success:function (response) {
			        if(response.success == true){
			        	inputDetail(notranskembali,gridItems);
			        }
			        else{
			        	$('#basicExampleModal').modal('toggle');
			        	Swal.fire({
			              type: 'error',
			              title: 'Woops...',
			              text: response.message,
			              // footer: '<a href>Why do I have this issue?</a>'
			            }).then((result)=>{
			              $('#basicExampleModal').modal('show');
			            });
			        }
			      }
			    });
			}
			else{
				$('#basicExampleModal').modal('toggle');
	        	Swal.fire({
	              type: 'error',
	              title: 'Woops...',
	              text: 'Field Tidak Boleh Kosong',
	              // footer: '<a href>Why do I have this issue?</a>'
	            }).then((result)=>{
	              $('#basicExampleModal').modal('show');
	            });
			}
			// ===================== Insert pengembalian header =====================
			console.log(gridItems);
		});
		$('.kode').change(function () {
			alert($('.kode'));
		});
	    $(document).ready(function () {
	    	// var gridItems = $("#gridContainer").dxDataGrid('instance')._controllers.data._dataSource._items;
	    	// console.log(gridItems);
	    	validation($('#tgltranskmbali').val(),$('#namapenerima').val(),row_Validate);
	    	form_mode = 'add';
	    	// ============================================= GENERATE NUMBER ===================================
	    	var table = 'pengembalian';
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

			    	$('#notranskembali').val('2'+year+''+month+''+ans);
		        }
		      }
		    });
	    });

	    $('.back').click(function () {
	    	var id = $(this).attr("id");
			$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Transaction/FindPeminjamanDetail',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		        // console.log(response);
		          // returnjson = response.data;
		          getDataPeminjaman(id)
		          bindGrid(response.data);
		        }
		      }
		    });
	    });

	  	$('.cetak').click(function () {
	  		var id = $(this).attr("id");
			window.open('<?php echo base_url(); ?>print/peminjaman-print.php?id='+id,'_blank');
	  	});
	});
	function reset() {
		$('#kode').attr('readonly',false);
		$('#kode').val('');
		$('#nama').val('');
		$('#tgl').val('');
		$('#ket').val('');
	}
	function bindGrid(data) {
		$("#gridContainer").dxDataGrid({
	        dataSource: data,
	        keyExpr: "kodemesin",
	        showBorders: true,
	        paging: {
	            enabled: false
	        },
	        editing: {
	            mode: "row",
	            allowUpdating: true
	        }, 
	        columns: [
	            {
	                dataField: "kodemesin",
	                caption: "Kode Mesin",
	                allowEditing:false
	            },
	            {
	                dataField: "nama_alat",
	                caption: "Nama Mesin",
	                allowEditing:false
	            }, 
	            {
	                dataField: "jumlah",
	                caption: "Jumlah Pinjam",
	                allowEditing:false
	            },
	            {
	                dataField: "jumlahkembali",
	                caption: "Jumlah Kembali"
	            },
	        ],
	        onEditingStart: function(e) {
	            // logEvent("EditingStart");
	        },
	        onInitNewRow: function(e) {
	            // logEvent("InitNewRow");
	        },
	        onRowInserting: function(e) {
	            // logEvent("RowInserting");
	        },
	        onRowInserted: function(e) {
	            // logEvent("RowInserted");
	        },
	        onRowUpdating: function(e) {
	            // logEvent("RowUpdating");
	            // alert('RowUpdating');
	        },
	        onRowUpdated: function(e) {
	            // logEvent(e);

	            if (e.data.jumlahkembali > e.data.jumlah) {
	            	$('#basicExampleModal').modal('toggle');
	            	Swal.fire({
		              type: 'error',
		              title: 'Woops...',
		              text: 'Qty Kembali tidak bisa melebihi Qty Pinjam',
		              // footer: '<a href>Why do I have this issue?</a>'
		            }).then((result)=>{
		              $('#basicExampleModal').modal('show');
		              row_Validate = 0;
		              validation($('#tgltranskmbali').val(),$('#namapenerima').val(),row_Validate);
		            });
	            }
	            else{
	            	row_Validate = 1;
	            	validation($('#tgltranskmbali').val(),$('#namapenerima').val(),row_Validate);
	            }
	        },
	        onRowRemoving: function(e) {
	            // logEvent("RowRemoving");
	        },
	        onRowRemoved: function(e) {
	            // logEvent("RowRemoved");
	        },
	        onEditorPrepared: function (e) {
				console.log(e);
				if (e.dataField == "kodemesin") {                     
					var grid = $("#gridContainer").dxDataGrid("instance");
					var index = e.row.rowIndex;
					var result = "new description ";
					// console.log(grid);
					grid.option("disabled");
				}
			}
	    });
	}
	function inputDetail(notranskembali,data) {
		if (data != '[]') {
			var row = 'detail';
			$.each(data,function (k,v) {
				var kodemesn = v.kodemesin;
				var Jumlahpinjam = v.jumlah;
				var Jumlahkembali = v.jumlahkembali;

				$.ajax({
			      type    :'post',
			      url     : '<?=base_url()?>Transaction/InsertPengembalianHeaderData',
			      data    : {kodemesn:kodemesn,Jumlahpinjam:Jumlahpinjam,Jumlahkembali:Jumlahkembali,row:row,notranskembali:notranskembali},
			      dataType: 'json',
			      success:function (response) {
			        if(response.success == true){
			        	$('#basicExampleModal').modal('toggle');
				        	Swal.fire({
				              type: 'success',
				              title: 'Horray...',
				              text: 'Data Berhasil Di Tambahkan',
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
			            }).then((result)=>{
			              $('#basicExampleModal').modal('show');
			            });
			        }
			      }
			    });
			});
		}
		else{
			$('#basicExampleModal').modal('toggle');
        	Swal.fire({
              type: 'error',
              title: 'Woops...',
              text: 'Item Tidak boleh kosong',
              // footer: '<a href>Why do I have this issue?</a>'
            }).then((result)=>{
              $('#basicExampleModal').modal('show');
            });
		}
	}
	function getDataPeminjaman(notransaksi) {
		$.ajax({
	      type    :'post',
	      url     : '<?=base_url()?>Transaction/FindPeminjamanHeader',
	      data    : {notransaksi,notransaksi},
	      dataType: 'json',
	      success:function (response) {
	        if(response.success == true){
	          $.each(response.data,function (k,v) {
	            $('#notrans').val(v.notransaksi);
				$('#tgltrans').val(v.tgltransaksi);
				$('#fasyankes').val(v.kodefasyankes).change();
				$('#nama').val(v.namapeminjam);
				$('#petugas').val(v.namapetugas);
				$('#tujuan').val(v.tujuanpinjam);
	          });
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
	}
	function validation(tglpinjam,petugas,rowvalidate) {
		if (tglpinjam == '' || petugas == '' || rowvalidate == 0) {
			$('#Save_Btn').attr('disabled',true);
		}
		else{
			$('#Save_Btn').attr('disabled',false);	
		}
	}
</script>