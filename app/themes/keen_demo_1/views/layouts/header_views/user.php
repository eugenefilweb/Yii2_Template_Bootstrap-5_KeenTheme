<?php 

use app\themes\keen_demo_1\assets\ThemeAsset;
use yii\helpers\Url;

?>
								<div class="topbar-item ml-4">
									<!-- <div class="btn btn-icon btn-light-primary h-40px w-40px p-0" id="kt_quick_user_toggle"> -->
										<div id="kt_quick_user_toggle" class="btn btn-sm btn-hover-primary symbol symbol-40" style="padding: 0;">
											<img class="symbol-label" src="<?= Url::to(['file/display', 'token' => '', 'user' => true]) ?>"></img>
										</div>
									<!-- </div> -->
								</div>