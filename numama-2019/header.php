<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php wp_head();?>
</head>

<body <?php echo (!is_front_page()) ? 'class="another-page"' : ''; ?>>
	<header>
		<div class="container">
			<div class="d-flex f-between f-align-start main-row">
				<div class="wrapper-logo">
					<a href="<?= home_url();?>" class="logo">
						<?= file_get_contents(get_theme_mod('logo_image'));?>
					</a>
				</div>
				<div class="wrap-menu">
					<menu>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'main_menu',
								'container' => '',
								'menu_class' => '',
								'items_wrap' => '%3$s',
							)
						);?>
						<?php if(get_theme_mod('button_text') != ''){?>
							<li class="with-border">
								<a href="<?= get_theme_mod('button_link');?>">
									<span class="inner"><?= get_theme_mod('button_text');?></span>
								</a>
							</li>
						<?php } ?>
					</menu>
					<div class="sandwitch-icon">
						<i></i>
						<i></i>
						<i></i>
					</div>
				</div>
			</div>
		</div>
	</header>