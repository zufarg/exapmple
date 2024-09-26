<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package merit
 */

?>


<footer id="footer" class="container-footer">
	<div class="flex-col-start">
		<div class="flex-start">
			<div class="container-nav">
				<h4 class="title-nav">
					<spa><?=pll__('Навигация') ?></spa>
					<img src="<?= get_template_directory_uri() ?>/assets/icons/triangel-gray.svg" alt="" class="icon-dropdown-footer" />
				</h4>
				<ul class="links-nav">
					<?php
					$locations = get_nav_menu_locations();
					$menu_items = wp_get_nav_menu_items($locations['primary-menu']);
					foreach ($menu_items as $n => $menu_item) {
						// Проверяем, что элемент меню является родительским
						if ($menu_item->menu_item_parent == 0) {
							echo '<li>';
							echo '<a href="' . esc_url($menu_item->url) . '" class="link-nav">' . esc_html($menu_item->title) . '</a>';
							echo '</li>';
						}
					}
					?>
				</ul>
			</div>
			<div class="container-catalog">
				<h4 class="title-catalog">
					<span><?=pll__('Каталог')?></span>
					<img src="<?= get_template_directory_uri() ?>/assets/icons/triangel-gray.svg" alt="" class="icon-dropdown-footer" />
				</h4>
				<ul class="links-catalog">
					<?php
					$categories = get_terms(array(
						'taxonomy' => 'product_cat',
						'hide_empty' => false, // Установите в true, если нужно скрыть пустые категории
						'parent' => 0
					));

					if (!empty($categories) && !is_wp_error($categories)) {
						foreach ($categories as $category) {
							echo '<li>';
							echo '<a class="link-catalog" href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name) . '</a>';
							echo '</li>';
						}
					}
					?>

				</ul>
			</div>
			<div class="container-line">
				<h4 class="title-line"><?=pll__('Обратная связь')?></h4>
				<ul class="links-line">
					<li>
						<a href="<?= get_theme_mod('email', ''); ?>" class="link-line mail">
							<?= get_theme_mod('email', ''); ?>
						</a>
					</li>

					<!--Социальные сети-->
					<li class="social-media">
						<?php renderSocial(); ?>
					</li>


					<!-- НЕ УБИРАТЬ -->
					<li></li>
					<?php print_countries_footer(2)?>
				</ul>
			</div>
			<div class="container-line">
				<ul class="links-line">
					<?php print_countries_footer(-1, 2);?>
				</ul>
			</div>
		</div>

		<?= the_custom_logo() ?>

		<div class="bottom-footer">
			<span class="title-bottom">
				<?= pll__('OOO «Merit Chemicals» — Поставщик <br />
				химического сырья и готовой продукции!')?>
			</span>
			<a href="https://icorp.uz/web" target="_blank" class="center-bottom">
				<img src="<?= get_template_directory_uri() ?>/assets/icons/light-icorp.svg" alt="" />
				<span class="title-center-bottom"><?=pll__('Разработано iCORP')?></span>
			</a>
			<span class="sub-bottom"><?=pll__('© 2024 | Все права защищены')?></span>
		</div>
	</div>
</footer>
</div>
</div>
<!-- #page -->

<?php wp_footer(); ?>

</body>

</html>