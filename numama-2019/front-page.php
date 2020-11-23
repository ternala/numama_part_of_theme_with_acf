<?php get_header();?>
	<section class="section-home" style="background-image: url('<?= get_field('background_image');?>')">
		<div class="container">
			<?= get_field('content');?>
			<a href="<?= get_field('link');?>" class="btn gradient"><?= get_field('button_text');?></a>
		</div>
	</section>
<?php the_post();?>
<?php the_content();?>
<?php get_footer();?>