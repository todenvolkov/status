<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').slideToggle('fast');
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('company-grid', {
        data: $(this).serialize()
    });
    return false;
});
");

?>
<div class="panel panel-default magic-element">
        <div class="panel-heading">
        </div>
        <div class="panel-body">

            <?php $this->widget('bootstrap.widgets.TbGridView',array(
            	'id'=>'company-grid',
            	'dataProvider'=>$model->search(),
                    'type'=>'striped bordered condensed',
                    'template'=>'{items}{pager}',
            	'columns'=>array(
        
            		'Name',

            		'Phones',
            		'Email',

                           array(

            		      'type'=>'raw',
            		       'value'=>'"
            		      <a href=\'javascript:void(0);\' onclick=\'renderView(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'glyphicon glyphicon-eye-open\'></i></a>
            		      <a href=\'javascript:void(0);\' onclick=\'renderUpdateForm(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'glyphicon glyphicon-pencil\'></i></a>
            		      <a href=\'javascript:void(0);\' onclick=\'delete_record(".$data->id.")\'   class=\'btn btn-small view\'  ><i class=\'glyphicon glyphicon-trash\'></i></a>
            		     "',
            		      'htmlOptions'=>array('style'=>'width:150px;')
            		     ),

            	),
            )); ?>


        </div>
    </div><!-- /panel-default -->






<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->


<?php


 $this->renderPartial("_ajax_update");
 $this->renderPartial("_ajax_create_form",array("model"=>$model));
 $this->renderPartial("_ajax_view");

 ?>

 
<script type="text/javascript"> 
function delete_record(id)
{
    $.noConflict();
  if(!confirm("Are you sure you want delete this?"))
   return;
   
 //  $('#ajaxtest-view-modal').modal('hide');
 
 var data="id="+id;
 

  jQuery.ajax({
   type: 'POST',
    url: '<?php echo Yii::app()->createAbsoluteUrl("company/delete"); ?>',
   data:data,
success:function(data){
                 if(data=="true")
                  {
                     $('#company-view-modal').modal('hide');
                     $.fn.yiiGridView.update('company-grid', {
                     
                         });
                 
                  } 
                 else
                   alert("deletion failed");
              },
   error: function(data) { // if error occured
           alert(JSON.stringify(data)); 
         alert("Error occured.please try again");
       //  alert(data);
    },

  dataType:'html'
  });

}
</script>

<style type="text/css" media="print">
body {visibility:hidden;}
.printableArea{visibility:visible;} 
</style>
<script type="text/javascript">
function printDiv()
{

window.print();

}
</script>
<script type="text/javascript">
    $(function () {

            $('.datatables').dataTable({
                           "iDisplayLength": 100,
                           "aLengthMenu": [[100, 200, 500, 1000, -1], [100, 200, 500, 1000, "All"]]
                       });
    });
</script>
 


