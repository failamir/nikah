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
        <h2>Menu List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Parent Menu</th>
		<th>Nama Menu</th>
		<th>Controller Link</th>
		<th>Icon</th>
		<th>Slug</th>
		<th>Urut Menu</th>
		<th>Menu Grup User</th>
		<th>Is Active</th>
		
            </tr><?php
            foreach ($menu_data as $menu)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $menu->parent_menu ?></td>
		      <td><?php echo $menu->nama_menu ?></td>
		      <td><?php echo $menu->controller_link ?></td>
		      <td><?php echo $menu->icon ?></td>
		      <td><?php echo $menu->slug ?></td>
		      <td><?php echo $menu->urut_menu ?></td>
		      <td><?php echo $menu->menu_grup_user ?></td>
		      <td><?php echo $menu->is_active ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>