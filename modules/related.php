<!-- post related -->
<section class="related-list">
<?php
	echo '<h3>' . __('Related Post', 'pits') . '</h3><ul>';
	global $post, $wpdb;
	$random_posts_num=6;//随机文章最大值
	$post_tags = wp_get_post_tags($post->ID);
	if ($post_tags) {
	$tag_list = '';
	foreach ($post_tags as $tag) {
	$tag_list .= $tag->term_id.',';
	}
	$tag_list = substr($tag_list, 0, strlen($tag_list)-1);
	$related_posts = $wpdb->get_results("
	SELECT DISTINCT ID, post_title
	FROM {$wpdb->prefix}posts, {$wpdb->prefix}term_relationships, {$wpdb->prefix}term_taxonomy
	WHERE {$wpdb->prefix}term_taxonomy.term_taxonomy_id = {$wpdb->prefix}term_relationships.term_taxonomy_id
	AND ID = object_id
	AND taxonomy = 'post_tag'
	AND post_status = 'publish'
	AND post_type = 'post'
	AND term_id IN (" . $tag_list . ")
	AND ID != '" . $post->ID . "'
	LIMIT 10");//相关文章的数量，同随机文章最大值
	if ( $related_posts ) {
	$related_posts = array_reverse($related_posts, true);
	foreach ($related_posts as $related_post) {
	$random_posts_num--;//每多一篇相关文章则减少一篇随机文章
?>

	<li><a href="<?php echo get_permalink($related_post->ID); ?>" rel="bookmark" title="<?php echo $related_post->post_title; ?>"><?php echo $related_post->post_title; ?></a></li>

<?php }
	}
	if ( $random_posts_num > 0 ){
	$randompost = new WP_Query(); //实例化
	$randompost->query(array('orderby'=>'rand','showposts'=>$random_posts_num));
	while ($randompost->have_posts()) : $randompost->the_post(); 
?>

	<li><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title();?>"><?php the_title(); ?></a></li>

<?php endwhile; wp_reset_query(); }
	}
	echo '</ul>'; 

?>

</section>