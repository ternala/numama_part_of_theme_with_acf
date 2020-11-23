<?php get_header();?>
<?php the_post();?>
<section class="section-block-menu">
	<div class="container">
		<h1><?= get_field('subtitle');?></h1>
		<h2>Week 1</h2>
		<div class="fine"><?= get_field('week_1_description',false,false);?></div>
		<?php

		$product_array = [];
		for($i = 1; $i <= 7; $i++){
			$current = get_field('week_1_day_'.$i);
			foreach ($current as $cur){
				$product_array[] = $cur;
			}
		}
        $tags = [];
		$product_array_week = [];
			foreach ($product_array as $product) {
				if ( ! in_array( $product, $product_array_week ) ) {
					$product_array_week[] = $product;
					$prod                 = new WP_Query(
						array(
							'post_type'      => 'product',
							'posts_per_page' => 1,
							'p'              => $product
						)
					);
					while ( $prod->have_posts() ) {
						$prod->the_post();
						$icons = get_field('attributes');
						if(is_array($icons)) {
							foreach ( $icons as $icon ) {
								if ( ! in_array( $icon, $tags ) ) {
									$tags[] .= $icon;
								}
							}
						}
					}
				}
			}
        ?>
		<div class="tags">
			<?php if($tags){
				foreach ($tags as $tag) {
					$count = 0;
					while (have_rows('tags','option')){
						the_row('option');
						if($tag == $count){?>
							<a class="tag">
								<img src="<?= get_sub_field('icon');?>" alt="">
								<span><?= get_sub_field('label');?></span>
							</a>
						<?php }
						$count++;
					}
				}
			}?>
		</div>
		<div class="goods d-flex grid f-wrap">
			<?php $product_array_week = []; ?>
			<?php foreach ($product_array as $product){
				if(!in_array($product,$product_array_week)){
				$product_array_week[] = $product;
				$prod = new WP_Query(
                        array(
                            'post_type' => 'product',
                            'posts_per_page' => 1,
                            'p' => $product
                        )
                );
                while ($prod->have_posts()){
                    $prod->the_post();
	                $current_tags = get_the_terms( get_the_ID(), 'product_tag' );
	                $icons = get_field('attributes');
	                ?>
	                <div class="block-3 good">
		                <div class="inner">
			                <div class="top">
				                <div class="by-top">
					                <img src="<?= get_the_post_thumbnail_url();?>" alt="" class="main-img">
					                <h4><?= get_the_title();?></h4>
					                <p><?= get_the_content('');?></p>
				                </div>
				                <div class="categories-good">
					                <?php if($current_tags){
						                foreach ($current_tags as $single_tag){?>
							                <a class="category"><?= $single_tag->name;?></a>
						                <?php }
					                }?>
				                </div>
			                </div>
			                <div class="tags-good">
				                <?php
				                if(is_array($icons)){
				                	foreach ( $icons as $icon ) {
						                $count = 0;
						                while ( have_rows( 'tags', 'option' ) ) {
							                the_row( 'option' );
							                if ( $icon == $count ) {
								                ?>
								                <a class="tag">
									                <img src="<?= get_sub_field( 'icon' ); ?>" alt="">
								                </a>
							                <?php }
							                $count ++;
						                }
					                }
				                }?>
			                </div>
		                </div>
	                </div>
			<?php } wp_reset_query();
				}
			} ?>
		</div>
		<h2>Week 2</h2>
		<div class="fine"><?= get_field('week_2_description',false,false);?></div>
		<?php $tags = get_field('attributes_2');

		$product_array = [];
		for($i = 1; $i <= 7; $i++){
			$current = get_field('week_2_day_'.$i);
			foreach ($current as $cur){
				$product_array[] = $cur;
			}
		}
		$tags = [];
		$product_array_week = [];
		foreach ($product_array as $product) {
			if ( ! in_array( $product, $product_array_week ) ) {
				$product_array_week[] = $product;
				$prod                 = new WP_Query(
					array(
						'post_type'      => 'product',
						'posts_per_page' => 1,
						'p'              => $product
					)
				);
				while ( $prod->have_posts() ) {
					$prod->the_post();
					$icons = get_field('attributes');
					if(is_array($icons)) {
						foreach ( $icons as $icon ) {
							if ( ! in_array( $icon, $tags ) ) {
								$tags[] .= $icon;
							}
						}
					}
				}
			}
		}
		?>

		<div class="tags">
			<?php if($tags){
				foreach ($tags as $tag) {
					$count = 0;
					while (have_rows('tags','option')){
						the_row('option');
						if($tag == $count){?>
							<a class="tag">
								<img src="<?= get_sub_field('icon');?>" alt="">
								<span><?= get_sub_field('label');?></span>
							</a>
						<?php }
						$count++;
					}
				}
			}?>
		</div>
		<div class="goods d-flex grid f-wrap">
			<?php $product_array_week = []; ?>
			<?php foreach ($product_array as $product){
				if(!in_array($product,$product_array_week)){
					$product_array_week[] = $product;
					$prod = new WP_Query(
						array(
							'post_type' => 'product',
							'posts_per_page' => 1,
							'p' => $product
						)
					);
					while ($prod->have_posts()){
						$prod->the_post();
						$current_tags = get_the_terms( get_the_ID(), 'product_tag' );
						$icons = get_field('attributes');
						?>
						<div class="block-3 good">
							<div class="inner">
								<div class="top">
									<div class="by-top">
										<img src="<?= get_the_post_thumbnail_url();?>" alt="" class="main-img">
										<h4><?= get_the_title();?></h4>
										<p><?= get_the_content('');?></p>
									</div>
									<div class="categories-good">
										<?php if($current_tags){
											foreach ($current_tags as $single_tag){?>
												<a class="category"><?= $single_tag->name;?></a>
											<?php }
										}?>
									</div>
								</div>
								<div class="tags-good">
									<?php
								if(is_array($icons)) {
									foreach ( $icons as $icon ) {
										$count = 0;
										while ( have_rows( 'tags', 'option' ) ) {
											the_row( 'option' );
											if ( $icon == $count ) {
												?>
												<a class="tag">
													<img src="<?= get_sub_field( 'icon' ); ?>" alt="">
												</a>
											<?php }
											$count ++;
										}
									}
								}?>
								</div>
							</div>
						</div>
					<?php } wp_reset_query();
				}
			} ?>
		</div>
		<h2>Week 3</h2>
		<div class="fine"><?= get_field('week_3_description',false,false);?></div>
		<?php $tags = get_field('attributes_3');

		$product_array = [];
		for($i = 1; $i <= 7; $i++){
			$current = get_field('week_3_day_'.$i);
			foreach ($current as $cur){
				$product_array[] = $cur;
			}
		}
		$tags = [];
		$product_array_week = [];
		foreach ($product_array as $product) {
			if ( ! in_array( $product, $product_array_week ) ) {
				$product_array_week[] = $product;
				$prod                 = new WP_Query(
					array(
						'post_type'      => 'product',
						'posts_per_page' => 1,
						'p'              => $product
					)
				);
				while ( $prod->have_posts() ) {
					$prod->the_post();
					$icons = get_field('attributes');
					if(is_array($icons)) {
						foreach ( $icons as $icon ) {
							if ( ! in_array( $icon, $tags ) ) {
								$tags[] .= $icon;
							}
						}
					}
				}
			}
		}
		?>



		<div class="tags">
			<?php if($tags){
				foreach ($tags as $tag) {
					$count = 0;
					while (have_rows('tags','option')){
						the_row('option');
						if($tag == $count){?>
							<a class="tag">
								<img src="<?= get_sub_field('icon');?>" alt="">
								<span><?= get_sub_field('label');?></span>
							</a>
						<?php }
						$count++;
					}
				}
			}?>
		</div>
		<div class="goods d-flex grid f-wrap">
			<?php $product_array_week = []; ?>
			<?php foreach ($product_array as $product){
				if(!in_array($product,$product_array_week)){
					$product_array_week[] = $product;
					$prod = new WP_Query(
						array(
							'post_type' => 'product',
							'posts_per_page' => 1,
							'p' => $product
						)
					);
					while ($prod->have_posts()){
						$prod->the_post();
						$current_tags = get_the_terms( get_the_ID(), 'product_tag' );
						$icons = get_field('attributes');
						?>
						<div class="block-3 good">
							<div class="inner">
								<div class="top">
									<div class="by-top">
										<img src="<?= get_the_post_thumbnail_url();?>" alt="" class="main-img">
										<h4><?= get_the_title();?></h4>
										<p><?= get_the_content('');?></p>
									</div>
									<div class="categories-good">
										<?php if($current_tags){
											foreach ($current_tags as $single_tag){?>
												<a class="category"><?= $single_tag->name;?></a>
											<?php }
										}?>
									</div>
								</div>
								<div class="tags-good">
									<?php
						if(is_array($icons)) {
							foreach ( $icons as $icon ) {
								$count = 0;
								while ( have_rows( 'tags', 'option' ) ) {
									the_row( 'option' );
									if ( $icon == $count ) {
										?>
										<a class="tag">
											<img src="<?= get_sub_field( 'icon' ); ?>" alt="">
										</a>
									<?php }
									$count ++;
								}
							}
						}?>
								</div>
							</div>
						</div>
					<?php } wp_reset_query();
				}
			} ?>
		</div>
		<h2>Week 4</h2>
		<div class="fine"><?= get_field('week_4_description',false,false);?></div>
		<?php $tags = get_field('attributes_4');

		$product_array = [];
		for($i = 1; $i <= 7; $i++){
			$current = get_field('week_4_day_'.$i);
			foreach ($current as $cur){
				$product_array[] = $cur;
			}
		}
		$tags = [];
		$product_array_week = [];
		foreach ($product_array as $product) {
			if ( ! in_array( $product, $product_array_week ) ) {
				$product_array_week[] = $product;
				$prod                 = new WP_Query(
					array(
						'post_type'      => 'product',
						'posts_per_page' => 1,
						'p'              => $product
					)
				);
				while ( $prod->have_posts() ) {
					$prod->the_post();
					$icons = get_field('attributes');
					if(is_array($icons)) {
						foreach ( $icons as $icon ) {
							if ( ! in_array( $icon, $tags ) ) {
								$tags[] .= $icon;
							}
						}
					}
				}
			}
		}
		?>

		<div class="tags">
			<?php if($tags){
				foreach ($tags as $tag) {
					$count = 0;
					while (have_rows('tags','option')){
						the_row('option');
						if($tag == $count){?>
							<a class="tag">
								<img src="<?= get_sub_field('icon');?>" alt="">
								<span><?= get_sub_field('label');?></span>
							</a>
						<?php }
						$count++;
					}
				}
			}?>
		</div>
		<div class="goods d-flex grid f-wrap">
			<?php $product_array_week = []; ?>
			<?php foreach ($product_array as $product){
				if(!in_array($product,$product_array_week)){
					$product_array_week[] = $product;
					$prod = new WP_Query(
						array(
							'post_type' => 'product',
							'posts_per_page' => 1,
							'p' => $product
						)
					);
					while ($prod->have_posts()){
						$prod->the_post();
						$current_tags = get_the_terms( get_the_ID(), 'product_tag' );
						$icons = get_field('attributes');
						?>
						<div class="block-3 good">
							<div class="inner">
								<div class="top">
									<div class="by-top">
										<img src="<?= get_the_post_thumbnail_url();?>" alt="" class="main-img">
										<h4><?= get_the_title();?></h4>
										<p><?= get_the_content('');?></p>
									</div>
									<div class="categories-good">
										<?php if($current_tags){
											foreach ($current_tags as $single_tag){?>
												<a class="category"><?= $single_tag->name;?></a>
											<?php }
										}?>
									</div>
								</div>
								<div class="tags-good">
									<?php
						if(is_array($icons)) {
							foreach ( $icons as $icon ) {
								$count = 0;
								while ( have_rows( 'tags', 'option' ) ) {
									the_row( 'option' );
									if ( $icon == $count ) {
										?>
                                        <a class="tag">
                                            <img src="<?= get_sub_field( 'icon' ); ?>" alt="">
                                        </a>
									<?php }
									$count ++;
								}
							}
						}?>
								</div>
							</div>
						</div>
					<?php } wp_reset_query();
				}
			} ?>
		</div>
	</div>
</section>
<?php get_footer();?>
