<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li>Manage activities</li>
</ol>
<?php 
    if ($this->session->userdata('create')) {
        echo $this->session->userdata('create');
        $this->session->unset_userdata('create');
    } 
?>
<div class="container-fluid clearfix">
    <div class="col-md-6 column search">
        <?php
        if (isset($activities_search_title)) $searchactivities = $activities_search_title; else $searchactivities = "";
        echo form_open("activities/search_activities", 'class="navbar-form navbar-left form_search" role="search"');
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search_from_date','value' => set_value('search_from_date'),'class' => 'form-control input-sm','placeholder' => 'From Date','data-date-format' => 'yyyy-mm-dd','style' => '','id' => 'dp6'));
        echo '</div> &nbsp;';
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search_end_date','value' => set_value('search_from_date'),'class' => 'form-control input-sm','placeholder' => 'To Date','data-date-format' => 'yyyy-mm-dd','style' => '','id' => 'dp7'));
        echo '</div> &nbsp;';
        echo '<div class="form-group">';
        echo form_input(array('name' => 'search_activities_name','value' => set_value('search_name'), 'class' => 'form-control input-sm', 'placeholder' => 'Activities Name'));
        echo '</div> &nbsp;';
        echo form_submit(array("name" => "submit_search", "value" => "filter", "class" => "btn btn-primary btn-sm"));
        echo form_close();
        ?>

    </div>
    <div class="col-md-6 column top-action padding-top-action"><div class="btn-group">                         
        <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export as PDF
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><?php echo anchor ('activities/exportPDF/'.$this->uri->segment(2),'Export all Data','title="Print"');?></li>
                <li><?php echo anchor ('activities/exportByPagePDF/'.$this->uri->segment(2),'Export data for this page','title="Print"');?></li>
            </ul>
        </div>
        <div class="btn-group">                     
            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown">Export as Excel
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><?php echo anchor ('activities/exportExcel/'.$this->uri->segment(2),'Export all Data','title="Print"');?></li>                                               
                <li><?php echo anchor ('activities/exportByPageExcel/'.$this->uri->segment(2),'Export data for this page','title="Print" class="error check_excel_print"');?></li>
            </ul>
        </div>
        <button type="button" class="btn btn-primary btn-sm perm_delete" title="delete record as permanent..." data-toggle="tooltip" id="tooltip">Remove Permenent</button>
        <button type="button" class="btn btn-primary btn-sm multi_delete" title="delete record..." data-toggle="tooltip" id="tooltip">Delete</button> 
        <?php echo anchor('activities/deletePermenentActivities','','class="error pdelete"'); ?>
        <?php echo anchor('activities/deleteMultiActivities','','class="error tdelete"'); ?>
        <?php echo anchor('activities/add_activities', 'Add New', 'class="btn btn-primary btn-sm"'); ?>
    </div>
    <div class="container-fluid clearfix">
    <table class="table table-striped table-hover table-bordered">
        <tr> 
            <td><input type="checkbox" name="checkbox_all" id="checkbox_all"></td>
            <th><?php echo anchor("activities/list_record/ID/" . $sort, "ID"); ?></th>
            <th><?php echo anchor("activities/list_record/Name/" . $sort, "Activities"); ?></th>
            <th><?php echo anchor("activities/list_record/start_date/" . $sort, "From Date"); ?></th>
            <th><?php echo anchor("activities/list_record/end_date/" . $sort, "To Date"); ?></th>
            <th>Location</th>
            <th>Festival</th>
            <th>Choice</th>
            <th>Purchase($)</th>
            <th>Sale($)</th>
            <th>Original Stock</th>
            <th>Actual Stock</th>
            <th>Action</th>
        </tr>
        <tbody class="tbl_body">    
            <?php if ($search_activities->num_rows > 0) { ?>
              <?php foreach ($search_activities->result() as $data) { ?>
        <tr>
            <td>
                <?php echo form_checkbox(
                    array('class' => 'check_checkbox',
                          'id' => 'check_checkbox', 
                          'name' => 'check_checkbox[]'
                        ), 
                          $data->act_id
                        ); 
                ?>
            </td>
            <td><?php echo $data->act_id; ?></td>
            <td><?php echo character_limiter($data->act_name, 7); ?></td>
            <td><?php echo $data->start_date; ?></td>
            <td><?php echo $data->end_date; ?></td>                        
            <td><?php echo character_limiter($data->lt_name, 7); ?></td>
            <td><?php echo character_limiter($data->ftv_name, 7); ?></td>
            <?php $item = $data->act_choiceitem; ?>
            <?php if ($item == 1) { ?>
                    <td><?php echo "yes"; ?></td>
            <?php } elseif ($item == 0) { ?>
                    <td><?php echo "no"; ?></td>
            <?php } ?>
            <td><?php echo $data->act_purchaseprice; ?></td>
            <td><?php echo $data->act_saleprice; ?></td>
            <td><?php echo $data->act_originalstock; ?></td>
            <td><?php echo $data->act_actualstock; ?></td>
            <td>
            <?php
                $status = '';
                $uri = "";
                if($this->uri->segment(3)) $uri = $this->uri->segment(3); 
                if($this->uri->segment(4)) $uri .= '/'.$this->uri->segment(4);
                if($this->uri->segment(5)) $uri .= '/'.$this->uri->segment(5);
                if ($data->act_status == 1) {
                  $status = anchor('activities/status_acitivties/' . $data->act_status . '/' . $data->act_id.'/'.$uri, '<span class="icon-ok"></span>', 'title="published" data-toggle="tooltip" id="tooltip"');
                } else if ($data->act_status == 0) {
                  $status = anchor('activities/status_acitivties/' . $data->act_status . '/' . $data->act_id.'/'.$uri, '<span class="icon-minus-sign"></span>', 'title="Unpublished" data-toggle="tooltip" id="tooltip"');
                }
                echo $status.' | '.anchor('activities/detail_activities/'.$data->act_id.'/'.$uri, '<span class="icon-list-alt" title="Details" data-toggle="modal" data-target="#activitiesViewModal"></span>','class="eachActivitiesView"') . ' | ' . anchor('activities/view_activities/'.$data->act_id.'/'.$uri, '<span class="icon-eye-open" title="View" ></span>') . ' | ' .
                anchor('activities/deleteActivitiesById/' . $data->act_id . '/' . $uri, '<span class="icon-trash" title="Delete"></span>', 'title = "Delete" onclick="return confirm(\'Are you sure want to delete this record?\');" data-toggle="tooltip" id="tooltip"');
                ;
            ?>
            </td>
        </tr>
        </tbody>
    <?php } ?><!-- end foreach -->

    <?php
    } else {
    echo '<tr><td colspan="12">No record was found !!!</td></tr>';
    }
    ?>
    </table>
</div>
    <ul class="pagination" style="background:red;">
        <?php echo $pagination; ?>
    </ul>
</div>
    
<?php $this->load->view(INCLUDE_BE.'modal/detail'); ?>
