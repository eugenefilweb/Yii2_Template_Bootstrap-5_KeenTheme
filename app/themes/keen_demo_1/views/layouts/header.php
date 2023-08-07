
					<div id="kt_header" class="header header-fixed">
						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<!--begin::Header Menu Wrapper-->
							<div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
								<!--begin::Header Menu-->
								<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
									<!--begin::Header Nav-->
									<?php //echo $this->render('header_views/header_menu') ?>
									<!--end::Header Nav-->
								</div>
								<!--end::Header Menu-->
							</div>
							<!--end::Header Menu Wrapper-->
							<!--begin::Topbar-->
							<div class="topbar">

								<!--begin::Home Page-->
									<?php echo $this->render('header_views/home_page') ?>
								<!--end::Home Page-->

								<!--begin::Notifications-->
								<?php //echo $this->render('header_views/notifications') ?>
								<!--end::Notifications-->

								<!--begin::Quick Actions-->
								<?php //echo $this->render('header_views/quick_actions') ?>
								<!--end::Quick Actions-->

								<!--begin::Quick panel-->
								<?php //echo $this->render('header_views/quick_panel') ?>
								<!--end::Quick panel-->

								<!--begin::Chat-->
								<?php //echo $this->render('header_views/chat') ?>
								<!--end::Chat-->

								<!--begin::Languages-->
								<?php //echo $this->render('header_views/languages') ?>
								<!--end::Languages-->

								<!--begin::User-->
								<?= $this->render('header_views/user') ?>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>