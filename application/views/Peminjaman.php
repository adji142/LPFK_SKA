<?php
    require_once(APPPATH."views/parts/header.php");
    require_once(APPPATH."views/parts/sidebar.php");
    $active = 'peminjaman';
?>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.common.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/19.1.6/css/dx.light.css" />
<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

    <div class="row-fluid">
    	<div class="span12">
    		<div class="widget-box collapsible">
    			<div class="widget-title"> 
    				<a href="#activeCol" data-toggle="collapse">
    					<h5>Input Data Peminjaman</h5>
    				</a>
    			</div>
    			<div class="collapse in" id="activeCol">
    				<div class="widget-content">
    					<form action="#" class="form-horizontal" enctype='application/json' id="SimpanPinjam">
				        	<div class="control-group">
				              <label class="control-label">Nomer Peminjaman :</label>
				              <div class="controls">
				                <input type="text" class="span6" placeholder="Nomer Peminjaman" id="notrans" name="notrans" readonly="" />
				              </div>
				            </div>
				            <div class="control-group">
				              <label class="control-label">Tanggal Peminjaman :</label>
				              <div class="controls">
				                <input type="date" class="span6" placeholder="Tanggal Transaksi" id="tgltrans" name="tgltrans"/>
				              </div>
				            </div>
				            <div class="control-group">
				              <label class="control-label">Fasyankes :</label>
				                <!-- <input type="text" class="span3" placeholder="Nomer Transaksi" id="notrans" name="notrans" readonly="" /> -->
				                <div class="control-group">
					              <div class="controls">
					                <select id="fasyankes" name="fasyankes" class="span6">
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
				                <input type="text" class="span6" placeholder="Nama Peminjam" id="nama" name="nama"/>
				              </div>
				            </div>
				            <div class="control-group">
				              <label class="control-label">Nama Petugas :</label>
				              <div class="controls">
				                <input type="text" class="span6" placeholder="Nama Petugas" id="petugas" name="petugas"/>
				              </div>
				            </div>
				            <div class="control-group">
				              <label class="control-label">Tujuan Pinjam :</label>
				              <div class="controls">
				                <input type="text" class="span6" placeholder="Tujuan Pinjam" id="tujuan" name="tujuan"/>
				              </div>
				            </div>
				        </form>
				        <center><h3>Isikan data Alat yang di pinjam di bawah ini</h3></center>
				        <div class="dx-viewport demo-container">
				        	<div id="data-grid-demo">
				        		<div id="gridContainer">
				        		</div>
				        	</div>
				        </div>
				        <button type="button" class="btn btn-primary" id="Save_Btn">Save changes</button>
    				</div>
    			</div>
    			<div class="widget-title"> 
    				<a href="#collapseOne" data-toggle="collapse">
<!-- 	    				<span class="icon">
	    					<i class="">
	    						<button type="button" class="btn btn-mini btn-info" data-toggle="modal" data-target="#basicExampleModal" id="add_btn">
								  Peminjaman Alat
								</button>
	    					</i>
	    				</span> -->
			            <h5>List Data Peminjaman</h5>
			        </a>
		        </div>
		        <div class="collapse" id="collapseOne">
			        <div class="widget-content">

			        	<table class="table table-bordered data-table">
			        		<thead>
				                <tr>
				                  <th>#</th>
				                  <th>Nomor Peminjaman</th>
				                  <th>Tanggal Peminjaman</th>
				                  <th>Kode  Fasyankes</th>
				                  <th>Nama Fasyankes</th>
				                  <th>Penanggung Jawab Alat</th>
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
				              							<button class = 'btn btn-mini btn-info tip-top view' data-original-title='View Row' id = '".$key->notransaksi."'><span class = 'icon icon-eye-open'></span></button>
				              							<button class = 'btn btn-mini btn-warning tip-top cetak' data-original-title='Cetak Bukti' id = '".$key->notransaksi."'><span class = 'icon icon-print'></span></button>
			              							</center>
			              						</td>
			              						<td>".$key->notransaksi."</td>
			              						<td>".$key->tgltransaksi."</td>
			              						<td>".$key->kodefasyankes."</td>
			              						<td>".$key->namafasyankes."</td>
			              						<td>".$key->namapeminjam."</td>
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
  </div>
<!-- </div> -->
<!-- Button trigger modal -->

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
                <th>Kode Analizer</th>
                <th>Nama Analizer</th>
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

<div class="modal hide" id="ModalAlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
        <table class="table table-bordered data-table" id="alat_list">
        	<thead>
              <tr>
              	<th>Row ID</th>
                <th>Kode Analizer</th>
                <th>Nama Analizer</th>
                <th>Jumlah Tersedia</th>
              </tr>
            </thead>
            <tbody id="load_data_alat">
              
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
	// lookup
	var return_IDData =0;
	var rowid = '';
	var kodealat = '';
	var namaalat = '';
	var stock = '';
	var items_data;

	$(function () {
		DevExpress.ui.dxOverlay.baseZIndex(2000);  
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
			var tgltrans = $('#tgltrans').val();
			var fasyankes = $('#fasyankes').val();
			var nama = $('#nama').val();
			var petugas = $('#petugas').val();
			var tujuan = $('#tujuan').val();
			// ===================== Insert peminjaaman header =====================
			var row = 'header';
			if (tgltrans != '' || fasyankes != ''  || nama != '' || petugas != '' || tujuan !='' ) {
				$.ajax({
			      type    :'post',
			      url     : '<?=base_url()?>Transaction/InsertPeminjamanHeaderData',
			      data    : {notrans:notrans,tgltrans:tgltrans,fasyankes:fasyankes,nama:nama,petugas:petugas,tujuan:tujuan,row:row},
			      dataType: 'json',
			      success:function (response) {
			        if(response.success == true){
			        	inputDetail(notrans,gridItems);
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
			// ===================== Insert peminjaaman header =====================
			console.log(gridItems);
		});
		$('.kode').change(function () {
			alert($('.kode'));
		});
		$('#tgltrans').change(function () {
			validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		});
		$('#fasyankes').change(function () {
			validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		});
		$('#nama').change(function () {
			validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		});
		$('#petugas').change(function () {
			validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		});
		$('#tujuan').change(function () {
			validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		});
		// lookup
		$('#alat_list').on('click','tr',function () {
			return_IDData = 1;
			rowid = $(this).find("#rowid").text();
			kodealat = $(this).find("#kodealat").text();
			namaalat = $(this).find("#namaalat").text();
			stock = $(this).find("#stk").text();

			items_data.push({
	                ClmID : rowid,
	                Prefix : kodealat,
	                namamsn: namaalat,
	                onhand : stock,
	                Jumlah : 1
			});
			// console.log(items_data);
			bindGrid(items_data)
			$('#ModalAlat').modal('toggle');
		});
	    $(document).ready(function () {
	    	// var gridItems = $("#gridContainer").dxDataGrid('instance')._controllers.data._dataSource._items;
	    	// console.log($('#tgltrans').val());
	    	validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
	    	form_mode = 'add';
	    	// ============================================= GENERATE NUMBER ===================================
	    	var table = 'peminjaman';
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

			    	$('#notrans').val('1'+year+''+month+''+ans);
		        }
		      }
		    });

	    	// ============================================= Dummy =============================================
			 var id = '';
			$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Transaction/getDummy',
		      data    : {id,id},
		      dataType: 'json',
		      success:function (response) {
		        if(response.success == true){
		        // console.log(response);
		          // returnjson = response.data;
		          bindGrid(response.data);
		        }
		      }
		    });
	    });
	  	
	  	$('.view').click(function () {
		    var id = $(this).attr("id");

		    $.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>Transaction/FindPeminjamanDetail',
		      data    : {id,id},
		      dataType: 'json',
		      success : function (response) {
		        var html = '';
		        var i;
		        var j = 1;
		        for (i = 0; i < response.data.length; i++) {
		          html += '<tr>' +
		                  '<td>' + j+'</td>' +
		                  '<td>' + response.data[i].kodemesin + '</td>' +
		                  '<td>' + response.data[i].nama_alat + '</td>' +
		                  '<td>' + response.data[i].jumlah + '</td>' +
		                  '<td>' + response.data[i].jumlahkembali + '</td>' +
		                  '<tr>';
		           j++;
		        }
		        $('#load_data').html(html);
		      }
		    });
		    $('#ModalDetail').modal('show');
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
	        keyExpr: "Prefix",
	        showBorders: true,
	        paging: {
	            enabled: false
	        },
	        editing: {
	            mode: "row",
	            allowUpdating: true,
	            allowDeleting: true,
	            texts: {  
	                confirmDeleteMessage: ''  
	            },
	            allowAdding: true
	        }, 
	        columns: [
	            {
	                dataField: "ClmID",
	                caption: "Columns ID",
	                allowEditing:false
	            },
	            {
	                dataField: "Prefix",
	                caption: "Kode Analizer",
	                allowEditing:false
	            },
	            {
	                dataField: "namamsn",
	                caption: "Nama Analizer"
	            },
	            {
	                dataField: "onhand",
	                caption: "Tersedia",
	                allowEditing:false
	            },
	            {
	                dataField: "Jumlah",
	                caption: "Jumlah Analizer"
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
	            // alert('');
	            // console.log(e.data.onhand);
	            // var index = e.row.rowIndex;
	            if (e.data.onhand >= e.data.Jumlah && e.data.Jumlah > 0) {
	            	row_Validate += 1;
	            	validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
	            }
	            else{
	            	$('#basicExampleModal').modal('toggle');
		        	Swal.fire({
		              type: 'error',
		              title: 'Woops...',
		              text: 'Jumlah Tersedia Lebih kecil dari jumlah yang di pinjam',
		              // footer: '<a href>Why do I have this issue?</a>'
		            }).then((result)=>{
		              $('#basicExampleModal').modal('show');
		              row_Validate = 0;
	            		validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
		            });
	            }
	        },
	        onRowUpdating: function(e) {
	            // logEvent("RowUpdating");
	            
	        },
	        onRowUpdated: function(e) {
	            // logEvent(e);
	        },
	        onRowRemoving: function(e) {
	        },
	        onRowRemoved: function(e) {
	        	// console.log(e);
	        	var grid = $("#gridContainer").dxDataGrid("instance");
	        	console.log(grid);
	            // row_Validate = row_Validate - 1;
	            // validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
	        },
			onEditorPrepared: function (e) {
				console.log(e);
				if (e.dataField == "namamsn") {
					$(e.editorElement).dxTextBox("instance").on("valueChanged", function (args) {                           
						var grid = $("#gridContainer").dxDataGrid("instance");
						var index = e.row.rowIndex;
						var result = "new description ";

						var length = 0;

						var kode = args.value;
						$.ajax({
					      type    :'post',
					      url     : '<?=base_url()?>Transaction/getDataMesin',
					      data    : {kode,kode},
					      dataType: 'json',
					      success:function (response) {
					        if(response.success == true){
					        	length = response.data.length;
					        	if (length == 1) {
					        		$.each(response.data,function (k,v) {
					        			//ClmID
					        			grid.cellValue(index, "ClmID", v.id);
							   			grid.cellValue(index, "Prefix", v.kode_alat);
										grid.cellValue(index, "namamsn", v.nama_alat);
										grid.cellValue(index, "onhand", v.stock);
							        });
							        grid.cellValue(index, "Jumlah", 0);
					        	}
					        	else{
					        		var html = '';
							        var i;
							        var j = 1;
							        for (i = 0; i < response.data.length; i++) {
							          html += '<tr>' +
							                  '<td id = "rowid">' + response.data[i].id+'</td>' +
							                  '<td id = "kodealat">' + response.data[i].kode_alat + '</td>' +
							                  '<td id = "namaalat">' + response.data[i].nama_alat + '</td>' +
							                  '<td id = "stk">' + response.data[i].stock + '</td>' +
							                  '<tr>';
							           j++;
							        }
							        $('#load_data_alat').html(html);
							        items_data = $("#gridContainer").dxDataGrid('instance')._controllers.data._dataSource._items;
							        console.log(items_data);
							        $('#ModalAlat').modal('show');
					        	}
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
			}
	    });

	    // add dx-toolbar-after
	    // $('.dx-toolbar-after').append('Tambah Alat untuk di pinjam ');
	}
	function inputDetail(notrans,data) {
		if (data != '[]') {
			var row = 'detail';
			$.each(data,function (k,v) {
				var kodemesn = v.ClmID;
				var Jumlah = v.Jumlah;
				$.ajax({
			      type    :'post',
			      url     : '<?=base_url()?>Transaction/InsertPeminjamanHeaderData',
			      data    : {notrans:notrans,kodemesn:kodemesn,Jumlah:Jumlah},
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
	function validation(tglpinjam,fasyankes,peminjam,petugas,tujuan,rowvalidate) {
		if (tglpinjam == '' || fasyankes == '' || peminjam == '' || petugas == '' || tujuan == '' || rowvalidate == 0) {
			$('#Save_Btn').attr('disabled',true);
		}
		else{
			$('#Save_Btn').attr('disabled',false);	
		}
	}
</script>