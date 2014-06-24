<ol class="breadcrumb">
  <li><?php echo anchor("munich_admin","Dashboard"); ?></li>
  <li><?php echo anchor("content/list_record","Manage"); ?></li>
  <?php if($this->session->userdata('search')){?>
  <li><?php echo anchor("content/search_content","Search"); ?></li>
  <?php }?>
  <li>View</li>
</ol>
<h1 class="action_page_header">View Content</h1>
<?php
$conTemplate = array(''=>'NO TEMPLATE WAS SELECTED','default'=>"Default", 'fullwidth'=>"Full width", 'contact'=>'Contact us','feedback'=>'Feedback','sideright'=>'A side right','sideleft'=>'A side left');
if($viewContent->num_rows() > 0){
    foreach($viewContent->result() as $value){
        $title = $value->con_title;
        $mkey = $value->meta_key;
        $mdescription = $value->meta_describe;
        $layout = $conTemplate[$value->con_template];
        $stayInMenu = $value->menu_title;
        if($value->con_status == 1){
            $status = "Published";
        }else{
            $status = "Unpublished";
        }
        $photo[] = img(array('src'=>'user_uploads/'.$value->photo_name,'alt'=>$value->photo_name,'class'=>'imgContent'));
        $text = $value->con_text;
    }
} 
?>
<table class="tables">
    <tr>
        <td width="20%">Content title</td>
        <td width="5%"> : </td>
        <td><?php echo $title; ?></td>
    </tr>
    <tr>
        <td width="20%">Meta key</td>
        <td> : </td>
        <td><?php echo $mkey; ?></td>
    </tr>
    <tr>
        <td width="20%">Meta Description</td>
        <td> : </td>
        <td><?php echo $mdescription; ?></td>
    </tr>
    <tr>
        <td width="20%">Content Layout</td>
        <td> : </td>
        <td><?php echo $layout; ?></td>
    </tr>
    <tr>
        <td width="20%">Stay In Menu</td>
        <td> : </td>
        <td><?php echo $stayInMenu; ?></td>
    </tr>
    <tr>
        <td width="20%">Photos</td>
        <td> : </td>
        <td><?php echo implode($photo); ?></td>
    </tr>
    <tr>
        <td width="20%">Content status</td>
        <td> : </td>
        <td><?php echo $status; ?></td>
    </tr>
    <tr>
        <td width="20%">Content Text</td>
        <td> : </td>
        <td><?php echo $text; ?></td>
    </tr>
</table>

<?php 
    echo anchor('content/list_record', 'Close', "class='btn btn-primary'");
?>