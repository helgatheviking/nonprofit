<header class="fl-page-header fl-page-header-primary<?php FLTheme::header_classes(); ?>"<?php FLTheme::header_data_attrs(); ?> itemscope="itemscope" itemtype="http://schema.org/WPHeader">
	<div class="fl-page-header-wrap">
		<div class="fl-page-header-container container">
			<div class="fl-page-header-row row">
				<div class="col-md-4 col-sm-12 col-xs-8 fl-page-header-logo-col">
					<div class="fl-page-header-logo fl-page-header-logo-hamburger" itemscope="itemscope" itemtype="http://schema.org/Organization">
						<a href="<?php echo home_url(); ?>" itemprop="url"><?php FLTheme::logo(); ?></a>
					</div>
				</div>
				<div class="fl-page-nav-col col-md-8 col-xs-4 col-sm-12">
					<div class="fl-page-nav-wrap">
						<nav class="fl-page-nav fl-nav navbar navbar-default" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">
                            <div id="toggle-off-canvas-area" class="fl-hamburger-menu hidden-sm hidden-md hidden-lg" href="#sidr">
                                <span class="icon icon-open">
                                    <svg height="32" viewBox="0 0 32 32" width="32" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M4 10h24c1.104 0 2-.896 2-2s-.896-2-2-2H4c-1.104 0-2 .896-2 2s.896 2 2 2zm24 4H4c-1.104 0-2 .896-2 2s.896 2 2 2h24c1.104 0 2-.896 2-2s-.896-2-2-2zm0 8H4c-1.104 0-2 .896-2 2s.896 2 2 2h24c1.104 0 2-.896 2-2s-.896-2-2-2z"/>
                                    </svg>
                                </span>
                                <span class="icon icon-close icon-hide">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35.413 35.413">
                                        <path d="M20.535 17.294L34.002 3.827c.78-.78.78-2.047 0-2.828-.78-.783-2.048-.783-2.828 0L17.707 14.464 4.242 1C3.462.217 2.195.217 1.414 1s-.78 2.046 0 2.827L14.88 17.294.585 31.587c-.78.78-.78 2.047 0 2.828.39.39.902.586 1.414.586s1.023-.193 1.413-.584l14.293-14.293L32 34.415c.39.39.902.586 1.414.586s1.023-.193 1.414-.584c.78-.78.78-2.047 0-2.828L20.535 17.294z"/>
                                    </svg>
                                </span>
							</div>
                            <div id="sidr">
                                <?php

								FLTheme::nav_search();

								wp_nav_menu(array(
									'theme_location' => 'header',
									'items_wrap' => '<ul id="%1$s" class="nav navbar-nav navbar-right %2$s">%3$s</ul>',
									'container' => false,
									'fallback_cb' => 'FLTheme::nav_menu_fallback'
								));
								?>

                                <?php if ( is_active_sidebar( 'sidr-widget-area' ) ): ?>
                                    <div class="widget-area">
                                        <?php dynamic_sidebar( 'sidr-widget-area' ); ?>
                                    </div>
                                <?php endif; ?>

                            </div>
                            <div class="sidr-closer"></div>
							<div class="fl-page-nav-collapse hidden-xs">
								<?php

								FLTheme::nav_search();

								wp_nav_menu(array(
									'theme_location' => 'header',
									'items_wrap' => '<ul id="%1$s" class="nav navbar-nav navbar-right %2$s">%3$s</ul>',
									'container' => false,
									'fallback_cb' => 'FLTheme::nav_menu_fallback'
								));

								?>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</div>
</header><!-- .fl-page-header -->
