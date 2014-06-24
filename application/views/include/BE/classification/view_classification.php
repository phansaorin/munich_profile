<ol class="breadcrumb">
      <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
      <li><?php echo anchor("classification/list_record","Manage"); ?></li>
      <li>Edit</li>
</ol>
    <h1 class="action_page_header">View Classification</h1>
<?php  echo form_open('classification/view_classification/'.$this->uri->segment(3), 'class="form-horizontal"'); ?>

<?php
        foreach ($view_classification->result() as $row) {
            ?>
    <!-- table detail responsive -->
    	<div class="table-responsive">
              <table class="table table-bordered">
              	<tr>
                	<th>Classification Name</th> <td><?php echo $row->clf_name; ?></td>
                </tr>
                 <tr>
                    <th>Classificaion Value</th> <td><?php echo $row->clf_value; ?></td>
                </tr> 
                
              </table>
        </div>
    
	<?php } ?>
    <?php
        echo anchor('classification/list_record', form_button('btn_close', 'Close', 'class="btn btn-primary btn-sm"'));
    ?>
            <?php
echo form_close();
?>