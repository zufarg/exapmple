<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package merit
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<header class="header">
		<div class="top">

			<?php
			$site_name = get_bloginfo('name');
			$home_url = home_url('/');
			echo '<a class="company_name" href="' . esc_url($home_url) . '">' . esc_html($site_name) . '</a>';
			?>
			<?php
			$phone_uz = get_theme_mod('phone_uz', '');
			if (!empty($phone_uz)) {
				echo '<a href="' . esc_html($phone_uz) . '" class="phone_number">' . esc_html($phone_uz) . '</a>';
			}
			?>

			<a href="mailto:<?= get_theme_mod('email', ''); ?>" class="mail"><?= get_theme_mod('email', ''); ?></a>

			<?php
			$address_header = get_theme_mod('address_header', '');
			if (!empty($address_header)) {
				echo '<address>' . esc_html($address_header) . '</address>';
			}
			?>



			<!--Социальные сети-->
			<ul class="social-media">
				<?php renderSocial(); ?>
			</ul>


			<!--Вывод языков    -->
			<ul class="languages">
				<?php print_langs_menu(); ?>
			</ul>


		</div>
		<menu class="header_sticky menu">
			<div class="linear-header"></div>
			<div class="content-menu">

				<?= the_custom_logo() ?>

				<?php

				my_nav_menu([
					'theme_location'  => 'primary-menu',
					'parent' => 0
				]);

				?>




				<div class="flex-center">

					<!--  Иконка поиска                  -->
					<form action="" method="post" class="form-search">
						<input type="text" class="search" placeholder="<?= pll__('Поиск') ?>" />
						<img
							src="<?= get_template_directory_uri() ?>/assets/icons/search.svg"
							alt="search-icon"
							class="icon-search" />
					</form>

					<div class="dropdown-lang">
						<div class="span-dropdown">
							<span class="current-lang ru"><?= strtoupper(pll_current_language()); ?></span>
							<img src="<?= get_template_directory_uri() ?>/assets/icons/triangel-gray.svg" alt="" class="" />
						</div>
						<ul class="dropdown-list">
							<?php
							$translations = pll_the_languages(array('raw' => 1));
							$iteration = 1;
							foreach ($translations as $slug => $translation) {
								echo '<a href="' . $translation['url'] . '">' . strtoupper($slug) . '</a>';
							}
							?>
						</ul>
					</div>
					<div class="replace-btn-mobilemenu"></div>
					<img src="<?= get_template_directory_uri() ?>/assets/icons/btn-mobilemenu.svg" class="btn-mobilemenu open" />
					<img
						src="<?= get_template_directory_uri() ?>/assets/icons/icon-search-close.svg"
						class="btn-mobilemenu close" />
				</div>
			</div>
			<div class="form-big-search">
				<?php get_search_form(); ?>
			</div>
            <div id="search-results"></div>

        </menu>
	</header>

	<div class="mobile-menu-container">
		<div class="mobile-menu-content">
			<div class="mobile-menu-main-content">
				<ul class="navbar">
					<?php
					$locations = get_nav_menu_locations();
					$menu = wp_get_nav_menu_object($locations['primary-menu']);
					$menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));

					$productsPageId = 0;

					$menu_items_by_parent = array();

					foreach ($menuitems as $menuitem) {
						if ($menuitem->menu_item_parent != 0)
							$menu_items_by_parent[$menuitem->menu_item_parent][] = $menuitem;
					}

					foreach ($menuitems as $key => $menuitem):
						if ($menuitem->menu_item_parent == 0):
							if ($menuitem->title == pll__('Продукция')) {
								$productsPageId = $menuitem->ID;
							}
							if (!empty($menu_items_by_parent[$menuitem->ID])  || $menuitem->title == pll__('Продукция')):
					?>
								<li class="item-navbar mobile-link-submenu" data-category="<?= $menuitem->title ?>">
									<div class="flex-center">
										<span><?= $menuitem->title ?></span>
										<img src="<?= get_template_directory_uri() ?>/assets/icons/btn-sertificats-next.svg" alt="" class="icon-mobile-arrow-right" />
									</div>
								</li>
							<?php else: ?>
								<li class="item-navbar"><a href="<?= $menuitem->url ?>"><?= $menuitem->title ?></a></li>
							<?php endif; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
				<a href="tel:+998 (71) 203-00-55" class="mobile-phone">+998 (71) 203-00-55</a>
				<a href="mailto:info@meritkimyo.uz" class="mobile-mail">info@meritkimyo.uz</a>
				<ul class="mobile-social-media">
					<?php renderSocial(); ?>
				</ul>
			</div>
			<div class="mobile-submenu">
				<?php
				foreach ($menu_items_by_parent as $menuitem_id => $menu_items):
					$item = getMenuItemById($menuitems, $menuitem_id);
				?>
					<div class="container-product" data-category="<?= $item->title ?>">
						<img src="<?= get_template_directory_uri() ?>/assets/icons/icon-mobile-arrow-left.svg" alt="" class="icon-prev pr" data-category="product" />
						<span class="span-block"><?= $item->title ?></span>
						<ul class="list-products mobile-menu-products">
							<?php
							foreach ($menu_items as $menuitem):
							?>
								<li class="item-product">
									<a href="<?= $menuitem->url ?>"><?= $menuitem->title ?></a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
				<?php
				$categories = get_terms([
					'taxonomy' => 'product_cat',
					'hide_empty' => false,
					'parent' => 0, // Только родительские категории
				]);

				$productsPage = getMenuItemById($menuitems, $productsPageId);

				$subs = [];
				?>
				<div class="container-product" data-category="<?= pll__($productsPage->title) ?>">
					<img src="<?= get_template_directory_uri() ?>/assets/icons/icon-mobile-arrow-left.svg" alt="" class="icon-prev pr" data-category="product" />
					<span class="span-block"><?= $item->title ?></span>
					<ul class="list-products mobile-menu-products">
						<?php
						foreach ($categories as $category):
							$subcategories = get_terms([
								'taxonomy' => 'product_cat',
								'hide_empty' => false,
								'parent' => $category->term_id,
							]);

							if (!empty($subcategories)):
								$subs[$category->term_id] = $subcategories;
						?>
								<li class="item-product" data-category="<?= esc_html($category->name) ?>">
									<span><?= esc_html($category->name) ?></span>
									<img src="<?= get_template_directory_uri() ?>/assets/icons/btn-sertificats-next.svg" alt="" class="arrow-right" />
								</li>
							<?php else: ?>
								<li class="item-product">
									<a href="<?= get_term_link($category) ?>"><?= esc_html($category->name) ?></a>
								</li>
							<?php endif; ?>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<?php
			if (!empty($subs)):
			?>
				<div class="mobile-submenu">
					<?php
					foreach ($subs as $parentCategoryId => $cats):
						$parentCat = getCategoryById($categories, $parentCategoryId);
					?>
						<div class="container-product" data-category="<?= esc_html($parentCat->name) ?>">
							<img src="<?= get_template_directory_uri() ?>/assets/icons/icon-mobile-arrow-left.svg" alt="" class="icon-prev pr" />
							<span class="span-block"><?= esc_html($parentCat->name) ?></span>
							<ul class="list-products mobile-menu-products">
								<?php
								foreach ($cats as $key => $cat):
								?>
									<li class="item-product">
										<a href="<?= get_term_link($cat) ?>"><?= esc_html($cat->name) ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
	</div>


	<?php
	function getCategoryById($categories, $id)
	{
		foreach ($categories as $value) {
			if ($value->term_id == $id) return $value;
		}
	}

	function getMenuItemById($items, $id)
	{
		foreach ($items as $item) {
			if ($item->ID == $id)
				return $item;
		}
	}

	function print_langs_menu()
	{
		$translations = pll_the_languages(array('raw' => 1));
		$iteration = 1;
		foreach ($translations as $slug => $translation) {
	?>
			<a href="<?= $translation['url'] ?>" style="opacity: <?= pll_current_language() === $slug ? '1' : '0.7'; ?>">
				<img src="<?= get_template_directory_uri() ?>/assets/icons/langugaes/<?= $slug ?>.svg" alt="<?= $slug ?>" class="i-lang" />
			</a>

	<?php
			$iteration++;
		}
	}
	?>