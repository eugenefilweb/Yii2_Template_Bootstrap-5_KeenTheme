<?php if(Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-custom alert-light-success fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-questions-circular-button"></i>
        </div>
        <div class="alert-text"><?= Yii::$app->session->getFlash('success');  ?></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="ki ki-close"></i></span>
            </button>
        </div>
    </div>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('danger')): ?>
    <div class="alert alert-custom alert-light-danger fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-questions-circular-button"></i>
        </div>
        <div class="alert-text"><?= Yii::$app->session->getFlash('danger');  ?></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('info')): ?>
    <div class="alert alert-custom alert-light-info fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-questions-circular-button"></i>
        </div>
        <div class="alert-text"><?= Yii::$app->session->getFlash('info');  ?></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
<?php endif; ?>

<?php if(Yii::$app->session->hasFlash('warning')): ?>
    <div class="alert alert-custom alert-light-warning fade show mb-5" role="alert">
        <div class="alert-icon">
            <i class="flaticon-questions-circular-button"></i>
        </div>
        <div class="alert-text"><?= Yii::$app->session->getFlash('warning');  ?></div>
        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    <i class="ki ki-close"></i>
                </span>
            </button>
        </div>
    </div>
<?php endif; ?>