<?php get_header(); ?>
<div class="wrap"><?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<article class="content"><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1><?php the_excerpt(); ?></article>
<?php endwhile; the_posts_pagination(); else : ?><div class="content"><h1>Nothing found</h1></div><?php endif; ?></div>
<?php get_footer(); ?>
