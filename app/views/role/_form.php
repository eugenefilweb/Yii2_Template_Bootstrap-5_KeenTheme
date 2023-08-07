<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Role */
/* @var $form yii\widgets\ActiveForm */

// $cActions = Yii::$app->Role->controller_actions(); //all actions per controller
// $encode = json_encode($cActions); // tostring
// $decode = json_decode($model->access, true); // toarray  


$_script = <<<SCRIPT


$('form#role-form').on('beforeSubmit', function(event){
    event.preventDefault();

    var navs = $('.dd.nestable-navigation').nestable('serialize');

  
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": true,
      "onclick": null,
      "showDuration": "100",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut",
    };

    toastr.info('<div class="spinner-border" role="status"><span class="sr-only">Saving...</span></div>  Saving...');


    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        dataType: 'json',
        data: $(this).serialize() + "&navigation=" + JSON.stringify(navs),
        success: function(data){
            toastr.clear();

            if(data.error == false){

                swal.fire({
                    text: "Save successfully!",
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-sm btn-success",
                    cancelButtonClass: "btn btn-sm btn-primary",
                    confirmButtonText: 'View',
                    cancelButtonText: 'Ok',
                    showCancelButton: true,
                    type: "success", 
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace(data.url);
                    }
                });

            }else{

                swal.fire({
                    text: data.message,
                    buttonsStyling: false,
                    confirmButtonClass: "btn btn-sm btn-danger",
                    type: "danger", 
                });

            }

        },
        error: function(data){

            swal.fire({
                text: data.responseText,
                buttonsStyling: false,
                confirmButtonClass: "btn btn-sm btn-danger",
                type: "danger", 
            });
        }   
    })

    return false;
})


SCRIPT;

$this->registerJs($_script);

?>


            <?php $form = ActiveForm::begin([
                'id' => 'role-form',
            ]); ?>

    
    <div class="card card-custom card-sticky gutter-b" id="kt_page_sticky_card">
        <div class="card-header card-header-tabs-line">
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-bold nav-tabs-line">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#kt_tab_pane_2_4">
                            <span class="nav-icon"><i class="flaticon-map"></i></span>
                            <span class="nav-text">Module Access</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#kt_tab_pane_1_4">
                            <span class="nav-icon"><i class="flaticon-map"></i></span>
                            <span class="nav-text">Role Access</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#kt_tab_pane_3_4">
                            <span class="nav-icon"><i class="flaticon-signs-1"></i></span>
                            <span class="nav-text">Navigations</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-toolbar">
                <?= Html::submitButton($model->isNewRecord ? 'Save Role' : 'Update Role', [ 'class' => $model->isNewRecord ? 'font-weight-bolder btn btn-sm btn-success': 'font-weight-bolder btn btn-sm btn-primary']) ?>
            </div>
        </div>
        <div class="card-body">

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="kt_tab_pane_2_4" role="tabpanel" aria-labelledby="kt_tab_pane_2_4">

                        <?= $this->render('tabs/_module_access', [
                            'model' => $model,
                            'form' => $form,
                        ]) ?>

                    </div>

                    <div class="tab-pane fade " id="kt_tab_pane_1_4" role="tabpanel" aria-labelledby="kt_tab_pane_1_4">

                        <?= $this->render('tabs/_role_access', [
                            'model' => $model,
                            'form' => $form,
                        ]) ?>

                    </div>

                    <div class="tab-pane fade" id="kt_tab_pane_3_4" role="tabpanel" aria-labelledby="kt_tab_pane_3_4">

                        <?= $this->render('tabs/_role_navigation', [
                            'model' => $model,
                            'form' => $form,
                        ]) ?>

                    </div>

                </div>


        </div>
    </div>


            <?php ActiveForm::end(); ?>

 