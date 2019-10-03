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
    		<div class="widget-box">
    			<div class="widget-title"> 
    				<h5>Laporan Peminjaman</h5>
    			</div>
    			<div class="widget-content">
    				<!-- <form action="#" class="form-horizontal" enctype='application/json' id="proses"> -->
				        <div class="controls controls-row">
				            <!-- <input type="text" placeholder=".span11" class="span11 m-wrap"> -->
				            <label class="span1 m-wrap">Tanggal Awal</label>
				            <input type="date" placeholder=".span1" class="span3 m-wrap" id="tglawal" name="tglawal">
				            <label class="span1 m-wrap">Tanggal Akhir</label>
				            <input type="date" placeholder=".span1" class="span3 m-wrap" id="tglakhir" name="tglakhir">

				            <button class="btn btn-primary span1 m-wrap" id="proses">Proses</button>
				        </div>
	    			<!-- </form> -->
		    		<div class="dx-viewport demo-container">
			        	<div id="data-grid-demo">
			        		<div id="gridContainer">
			        		</div>
			        	</div>
			        </div>
			    </div>
	        </div>
    	</div>
    </div>
  </div>
<!-- </div> -->
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

	    $('#proses').click(function () {
	    	var tglawal = $('#tglawal').val();
	    	var tglakhir = $('#tglakhir').val();
	    	$.ajax({
		      type    :'post',
		      url     : '<?=base_url()?>report/pengembalian',
		      data    : {tglawal:tglawal,tglakhir:tglakhir},
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

	    $(document).ready(function () {
	    	// var gridItems = $("#gridContainer").dxDataGrid('instance')._controllers.data._dataSource._items;
	    	// console.log($('#tgltrans').val());
	    	validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
	    	form_mode = 'add';
	    	console.log(form_mode);
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
	        showBorders: true,
	        paging: {
	            enabled: false
	        },
	        "export": {
	            enabled: true,
	            fileName: "Report Pengembalian"
	        },
	        editing: {
	            mode: "row",
	        }, 
	        columns: [
	            {
	                dataField: "notransaksi",
	                caption: "Nomer Transaksi",
	                allowEditing:false,
	            },
	            {
	                dataField: "tgltransaksi",
	                caption: "Tanggal Pengembalian",
	                allowEditing:false
	            },
	            {
	                dataField: "nopinjam",
	                caption: "Nomer Peminjaman",
	                allowEditing:false
	            },
	            {
	                dataField: "penerimabarang",
	                caption: "Nama Penerima Analizer",
	                allowEditing:false
	            },
	            {
	                dataField: "kode_alat",
	                caption: "Kode Analizer",
	                allowEditing:false
	            },
	            {
	                dataField: "nama_alat",
	                caption: "Nama Analizer",
	                allowEditing:false
	            },
	            {
	                dataField: "no_seri",
	                caption: "Serial Number",
	                allowEditing:false
	            },
	            {
	                dataField: "jumlahkembali",
	                caption: "Jumlah Kembali",
	                allowEditing:false
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
	            row_Validate = row_Validate - 1;
	            validation($('#tgltrans').val(),$('#fasyankes').val(),$('#nama').val(),$('#petugas').val(),$('#tujuan').val(),row_Validate);
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
					        			grid.cellValue(index, "sn", v.no_seri);
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
							                  '<td id = "sn">' + response.data[i].no_seri + '</td>' +
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