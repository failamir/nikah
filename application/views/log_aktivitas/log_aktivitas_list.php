
<div class="card">
   <!-- Content Header (Page header) -->
    
<!-- Main content -->
    <section class="content">
	<?php if(isset($message)){   
		 echo '<div class="alert alert-warning">  
		   <a href="#" class="close" data-dismiss="alert">&times;</a>  
		   '.$message.'
		 </div> '; 
    }  ?>
      <!-- Default box -->
      
        <div class="card-header">
		 <h5 class="card-title">Daftar log_aktivitas </h5>	
		</div>
            <div class="card-body table-responsive">
            <div class="box-tools pull-right">            
                <?php echo anchor(site_url('log_aktivitas/create'), '<i class = "fa fa-plus"></i> Tambah', 'class="btn btn-flat btn-info"'); ?>
		<?php echo anchor(site_url('log_aktivitas/excel'), '<i class = "fa fa-file-excel-o"></i> Excel', 'class="btn btn-flat btn-success"'); ?>
		<?php echo anchor(site_url('log_aktivitas/word'), '<i class = "fa fa-file-word-o"></i> Word', 'class="btn btn-flat btn-primary"'); ?>
		<?php echo anchor(site_url('log_aktivitas/pdf'), '<i class = "fa fa-file-pdf-o"></i> PDF', 'class="btn btn-flat btn-danger"'); ?>
	   
            </div>
            <div style="margin-bottom:20px"> <hr> </div>
        <table class="table table-responsive table-bordered table-striped" id="myTable">
            <thead>
                <tr>
                    <th width="20px">No</th>
			    	<th>Id User</th>
			    	<th>Aktivitas</th>
			    	<th>Time</th>
			    	<th width="200px">Aksi</th>
                </tr>
            </thead>
	    
        </table>
        <script src="<?php echo base_url('resources/js/jquery-1.11.2.min.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#myTable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
					"scrollX": true,
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "log_aktivitas/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id",
                            "orderable": false
                        },{"data": "id_user"},{"data": "aktivitas"},{"data": "time"},
                        {
                            "data" : "action",
                            "orderable": false,
                            "className" : "text-center"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
			</div>
          
        
    </section>
   <!-- /.content -->
  
	