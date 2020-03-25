<!doctype html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Log_aktivitas List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id User</th>
		<th>Aktivitas</th>
		<th>Time</th>
		
            </tr><?php
            foreach ($log_aktivitas_data as $log_aktivitas)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $log_aktivitas->id_user ?></td>
		      <td><?php echo $log_aktivitas->aktivitas ?></td>
		      <td><?php echo $log_aktivitas->time ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>