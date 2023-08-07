<?php 

use yii\helpers\Url;
use yii\widgets\ActiveForm;

?>
		<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
			<!--begin::Header-->
			<div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
				<h4 class="font-weight-bold m-0">Select a Theme</h4>
				<a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
					<i class="ki ki-close icon-xs text-muted"></i>
				</a>
			</div>
			<!--end::Header-->
			<!--begin::Content-->
			<div class="offcanvas-content">
				<!--begin::Wrapper-->
				<div class="offcanvas-wrapper mb-5 scroll-pull">
					<?php foreach(Yii::$app->General->getGlobalTheme() as $key => $theme){ ?>

						<h5 class="font-weight-bold mb-4 text-center"><?= $theme->name ?></h5>
						<div class="overlay rounded-lg mb-8 offcanvas-demo <?= (isset(Yii::$app->request->cookies->getValue('platform_theme')['slug']) && Yii::$app->request->cookies->getValue('platform_theme')['slug'] ==  $theme->slug) ?  : '' ?>">
							<div class="overlay-wrapper rounded-lg">
	                            <img data-src="<?= Url::to(['file/display', 'token' => $theme->model_file->file->token]) ?>" alt="" class="w-100 img-lazy" />
							</div>
							<div class="overlay-layer">

								<?php if(Yii::$app->request->cookies->getValue('platform_theme')['slug'] != $theme->slug){ ?>

									<?php $form = ActiveForm::begin([
										'action' => ['theme/set-theme'],
									]) ?>

										<input type="hidden" name="ThemeForm[theme_id]" value="<?= $theme->id ?>" />
										<input type="hidden" name="ThemeForm[name]" value="<?= $theme->name ?>" />
										<button type="submit" class="mr-2 anchor-theme btn btn-white btn-text-success btn-hover-success font-weight-boldest text-center min-w-75px shadow">Use Theme</button>

									<?php ActiveForm::end() ?>

								<?php } ?>

								<a href="<?= Url::to(['user/user-settings', 'tab' => 'themes']) ?>" class="anchor-theme btn btn-icon btn-white btn-text-primary btn-hover-primary font-weight-boldest text-center shadow"><i class="la la-gear text-primary"></i></a>

							</div>
						</div>

					<?php } ?>
				</div>
				<!--end::Wrapper-->
				<!--begin::Purchase-->
				<!-- <div class="offcanvas-footer">
					<a href="https://themes.getbootstrap.com/product/keen-the-ultimate-bootstrap-admin-theme/" target="_blank" class="btn btn-block btn-danger btn-shadow font-weight-bolder text-uppercase">Buy Keen Now!</a>
				</div> -->
				<!--end::Purchase-->
			</div>
			<!--end::Content-->
		</div>