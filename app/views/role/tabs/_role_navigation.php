<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$_script = <<<SCRIPT

$('.dd.nestable-navigation').nestable({
    maxDepth : 3, 
});


	$('.nestable-action').on('click', function(e) { 
		var target = $(e.target),
		action = target.data('action');

		if (action === 'expand-all') {
			$(this).closest('form').find('.dd').nestable('expandAll');
		}

		if (action === 'collapse-all') {
			$(this).closest('form').find('.dd').nestable('collapseAll');
		}

	});


	$(document).on('input', '.dd3-content input', function(){
		let currentVal;
		
		if($(this).attr('type') == 'checkbox'){
			if($(this).is(':checked')){
				currentVal = $(this).val();
			}else{
				currentVal = "0";
			}
		}else{
			currentVal = $(this).val();
		}

		let currentAction = $(this).data('action');
		let dataAttrElement = $(this).closest('.dd-item');
		dataAttrElement.data(currentAction, currentVal);
	})


    $(".add-page-menu").click(function(){ 
        var targetNest = $(this).closest('form').find('.dd.nestable-navigation > ol');
 
        if(targetNest){
            $(targetNest).prepend("<li class='dd-item' data-logo='<i class=\"fas fa-bars\"></i>' data-label='' data-url='' data-new_tab=''>"+ 
                    "<div class='dd-handle dd3-handle'><i class='fas fa-th'></i></div>"+ 
                    "<div class='dd3-content'>"+
                        "<div class='row'>"+
                            "<div class='col'>"+
                                "<input type='text' class='form-control' data-action='label' value='' required/>"+
                            "</div>"+
                            "<div class='col'>"+
                                "<input type='text' class='form-control' data-action='logo' value='<i class=\"fas fa-bars\"></i>' required/>"+
                            "</div>"+
                            "<div class='col'>"+
                                "<input type='text' list='urls' class='form-control' data-action='url' value='' required/>"+
                            "</div>"+
                            "<div class='col'>"+
                                "<label class='checkbox checkbox-outline checkbox-outline-2x checkbox-primary'>"+
                                    "<input type='checkbox' data-action='new_tab' value='1' />"+
                                    "<span class='mr-2'></span>"+
                                    "New tab"+
                                "</label>"+
                            "</div>"+
                            "<div class='col text-right'>"+
                                "<span class='remove-nav'><i class='far fa-times-circle text-danger'></i></span>"+
                            "</div>"+
                        "</div>"+
                    "</div>"+
                "</li>"); 
        }
    });


	$(document).on("click", ".remove-nav", function(){
		var containerTag = $(this).closest('.dd3-content').parent('li'); 
		containerTag.remove();  
	});


SCRIPT;

$this->registerJs($_script);


?>


<?php //$form = ActiveForm::begin([
	//'id' => 'navigation-form',
	//'action' => ['update-navigation', 'id' => $model->id],
//]); ?>

	<div class="row">
		<div class="col-lg-12">

			<div class="nestable-action mb-7">
				<div class="btn-group btn-group-sm" role="group" aria-label="Large button group">


                    <span class="add-page-menu btn btn-sm btn-success"> 
                       <!-- <span class="ti-plus"></span> --> 
                       <i class="far fa-plus-square"></i> Add Navigation
                    </span>  

            	 	<button type="button" class="btn btn-outline-primary btn-sm btn-upper" data-action="expand-all">
	                  <i class="fas fa-expand"></i> Expand All
	                </button>

	                 <button type="button" class="btn btn-outline-primary btn-sm btn-upper" data-action="collapse-all" style="cursor:pointer; margin-right: 20px; ">
	                  <i class="fas fa-compress"></i> Collapse All
	                </button>
				</div>
			</div>

			<div class="table-responsive">
				
				<div class="dd nestable-navigation">

				    <ol class="dd-list">
				    	<?= Yii::$app->Navigation->generateNavigationMenu($model->navigation_decode) ?>
				    </ol>

				    <datalist id="urls">
					  <?php foreach(Yii::$app->Role->getAllControllerWithActions() as $key => $controller_action){ ?>
					  	<option><?= $controller_action ?></option>
					  <?php } ?>
					</datalist>

				</div>

			</div>

		</div>

	</div>

<?php //ActiveForm::end(); ?>