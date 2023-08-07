<?php 

use yii\helpers\Url;
use app\themes\keen_demo_1\assets\ThemeAsset;


$_script = <<<SCRIPT


$.each($('li.menu-item-submenu'), function(){

	if($(this).find('.menu-item-active').length > 0){
		$(this).addClass('menu-item-open menu-item-here')
	}

})

SCRIPT;

$this->registerJs($_script);

?>


				<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
					<!--begin::Brand-->
					<div class="brand flex-column-auto" id="kt_brand">
						<!--begin::Logo-->
						<a href="<?= Url::to(['site/index']) ?>" class="brand-logo">
							<img src="<?= Url::to(['file/display', 'token' => '']) ?>" class="h-30px" />
						</a>
						<!--end::Logo-->
						<!--begin::Toggle-->
						<button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
							<span class="svg-icon svg-icon svg-icon-xl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/Text/Toggle-Right.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<rect x="0" y="0" width="24" height="24" />
										<path fill-rule="evenodd" clip-rule="evenodd" d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z" fill="black" />
										<path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd" d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z" fill="black" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</button>
						<!--end::Toolbar-->
					</div>
					<!--end::Brand-->
					<!--begin::Aside Menu-->
					<div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
						<!--begin::Menu Container-->
						<div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
							<!--begin::Menu Nav-->

							<ul class="menu-nav">

								<?php foreach(Yii::$app->user->identity->roleNavigation as $parent_key => $parent_navigation){?>

									<?php if(is_array($parent_navigation['actions']) && !empty($parent_navigation['actions'])){ ?>
										<li class="menu-item menu-item-submenu menu-item-rel" data-menu-toggle="click" aria-haspopup="true">
											<a href="javascript:;" class="menu-link menu-toggle">
												<span class="svg-icon menu-icon">
													<?= $parent_navigation['icon'] ?>
												</span>
												<span class="menu-text"><?= $parent_navigation['label'] ?></span>
												<i class="menu-arrow"></i>
											</a>


												<div class="menu-submenu menu-submenu-classic menu-submenu-left">
													<ul class="menu-subnav">

														<?php foreach($parent_navigation['actions'] as $child_key => $child_navigation){ ?>

															<?php if(is_array($child_navigation['actions']) && !empty($child_navigation['actions'])){ ?>

																<li class="menu-item menu-item-submenu <?= Yii::$app->Navigation->checkActiveNavigation($child_navigation['url']) ? 'menu-item-open menu-item-here' : '' ?>" data-menu-toggle="hover" aria-haspopup="true">
																	<a href="javascript:;" class="menu-link menu-toggle">
																		<span class="svg-icon menu-icon">
																			<?= $child_navigation['icon'] ?>
																		</span>
																		<span class="menu-text"><?= $child_navigation['label'] ?></span>
																		<i class="menu-arrow"></i>
																	</a>
																	<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																		<ul class="menu-subnav">

																			<?php foreach($child_navigation['actions'] as $child_key_2 => $child_navigation_2){ ?>

																				<?php if(is_array($child_navigation_2['actions']) && !empty($child_navigation_2['actions'])){ ?>

																					<li class="menu-item menu-item-submenu <?= Yii::$app->Navigation->checkActiveNavigation($child_navigation_2['url']) ? 'menu-item-open menu-item-here' : '' ?>" data-menu-toggle="hover" aria-haspopup="true">
																						<a href="javascript:;" class="menu-link menu-toggle">
																							<i class="menu-bullet menu-bullet-dot">
																								<span></span>
																							</i>
																							<span class="menu-text"><?= $child_navigation_2['label'] ?></span>
																							<i class="menu-arrow"></i>
																						</a>
																						<div class="menu-submenu menu-submenu-classic menu-submenu-right">
																							<ul class="menu-subnav">
																								<?php foreach($child_navigation_2['actions'] as $child_key_3 => $child_navigation_3){ ?>
																									<li class="menu-item <?= Yii::$app->Navigation->checkActiveNavigation($child_navigation_3['url'], 'exact') ? 'menu-item-active' : '' ?>" aria-haspopup="true">
																										<a href="<?= (filter_var($child_navigation_3['url'], FILTER_VALIDATE_URL) == false) ? Url::to(['/'.$child_navigation_3['url']]) : $child_navigation_3['url'] ?>" <?= ($child_navigation_3['new_tab'] == 1 ? 'target="_blank"' : '') ?> class="menu-link">
																											<i class="menu-bullet menu-bullet-line">
																												<span></span>
																											</i>
																											<span class="menu-text"><?= $child_navigation_3['label'] ?></span>
																										</a>
																									</li>
																								<?php } ?>
																							</ul>
																						</div>
																					</li>

																				<?php }else{ ?>

																					<li class="menu-item <?= Yii::$app->Navigation->checkActiveNavigation($child_navigation_2['url'], 'exact') ? 'menu-item-active' : '' ?>" aria-haspopup="true">
																						<a href="<?= (filter_var($child_navigation_2['url'], FILTER_VALIDATE_URL) == false) ? Url::to(['/'.$child_navigation_2['url']]) : $child_navigation_2['url'] ?>" <?= ($child_navigation_2['new_tab'] == 1 ? 'target="_blank"' : '') ?> class="menu-link">
																							<i class="menu-bullet menu-bullet-dot">
																								<span></span>
																							</i>
																							<span class="menu-text"><?= $child_navigation_2['label'] ?></span>
																						</a>
																					</li>
																					
																				<?php } ?>

																			<?php } ?>

																		</ul>
																	</div>
																</li>

															<?php }else{ ?>

																<li class="menu-item <?= Yii::$app->Navigation->checkActiveNavigation($child_navigation['url'], 'exact') ? 'menu-item-active' : '' ?>" aria-haspopup="true">
																	<a href="<?= (filter_var($child_navigation['url'], FILTER_VALIDATE_URL) == false) ? Url::to(['/'.$child_navigation['url']]) : $child_navigation['url'] ?>" <?= ($child_navigation['new_tab'] == 1 ? 'target="_blank"' : '') ?> class="menu-link">
																		<span class="svg-icon menu-icon">
																			<?= $child_navigation['icon'] ?>
																		</span>
																		<span class="menu-text"><?= $child_navigation['label'] ?></span>
																	</a>
																</li>

															<?php } ?>

														<?php } ?>


													</ul>
												</div>

										</li>

									<?php }else{ ?>

										<li class="menu-item <?= Yii::$app->Navigation->checkActiveNavigation($parent_navigation['url'], 'exact') ? 'menu-item-active' : '' ?>" aria-haspopup="true">
											<a href="<?= (filter_var($parent_navigation['url'], FILTER_VALIDATE_URL) == false) ? Url::to(['/'.$parent_navigation['url']]) : $parent_navigation['url'] ?>" <?= ($parent_navigation['new_tab'] == 1 ? 'target="_blank"' : '') ?>  class="menu-link">
												<span class="svg-icon menu-icon">
													<?= $parent_navigation['icon'] ?>
												</span>
												<span class="menu-text"><?= $parent_navigation['label'] ?></span>
											</a>
										</li>

									<?php } ?>


								<?php } ?>

							</ul>

							<!--end::Menu Nav-->
						</div>
						<!--end::Menu Container-->
					</div>
					<!--end::Aside Menu-->
				</div>


