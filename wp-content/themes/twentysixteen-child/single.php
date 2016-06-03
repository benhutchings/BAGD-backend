<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen_child
 * @since Twenty Sixteen Child 1.0
 */

get_header(); ?>

<div id="primary">
	<div id="content" role="main">
		<h1><?php the_field('name'); ?></h1>

		<p>ID: <?php the_field('student_number'); ?></p>
		<p>Route: <?php the_field('route'); ?></p>
		<p>Website: <?php the_field('link_to_personal_website'); ?></p>
		<p>Email: <?php the_field('email'); ?></p>

		<p>
		<h3>Social Media</h3>
		<?php
		$social_media = get_field("social_media_accounts");

		for ($i=0; $i<count($social_media); $i++){
			if ($social_media[$i] == "Twitter"){
				echo "Twitter: ";
				the_field('twitter');
				echo "<br>";
			}else if ($social_media[$i] == "Instagram"){
				echo "Instagram: ";
				the_field('instagram');
				echo "<br>";
			}else if ($social_media[$i] == "Youtube"){
				$str = get_field('youtube');
				echo "Youtube: <a href='" . $str . "' target=_blank>" . $str . "</a><br>";
			}else if ($social_media[$i] == "Vimeo"){
				$str = get_field('vimeo');
				echo "Vimeo: <a href='" . $str . "' target=_blank>" . $str . "</a><br>";
			}
		}
		?>
		</p>

		<p>
		<h3>Bio</h3>
		<?php the_field("bio") ?>
		</p>

		<p>
		<h3>Tags:</h3>
		<ul>
		<?php
			$tags = get_field("tags");

			for ($i=0; $i<count($tags); $i++){
				if ($tags[$i] != "Other"){
					echo "<li>" . $tags[$i] . "</li>";
				}else{
					$other = explode(",", get_field("other:"));
					foreach ($other as &$value) {
						$value = trim($value);
						echo "<li>" . $value . "</li>";
					}
				}
			}
		?>
		</ul>
		</p>

		<p>
		Question: <?php the_field("question") ?>
		</p>
		<div id="gallery">
			<h3>Gallery</h3>

			<p><h4>Hero Image/Video:</h4><br>
			<?php
				$hero = get_field("hero_image_video");
				if ($hero == "Image"){
					echo "<img src='";
					the_field('hero_image');
					echo "' width='700px'>";
				}else if ($hero == "Video"){
					echo "<pre>";
					the_field("hero_video");
					echo "</pre>";
				}
				echo "<br>Hero caption: ";
				the_field("caption_hero");
			?>
			</p>

			<?php
				$support1 = get_field("image_video_1");
				if ($support1 !== null){
					echo "<br><p><h4>Supporting Image/Video 1:</h4><br>";

					if ($support1 == "Image"){
						echo "<img src='";
						the_field('image_1');
						echo "' width='700px'>";
					}else if ($support1 == "Video"){
						echo "<pre>";
						the_field("video_1");
						echo "</pre>";
					}
					echo "<br>Caption 1: ";
					the_field("caption_1");

					echo "</p>";
				}

				$support2 = get_field("image_video_2");
				if ($support2 !== null){
					echo "<br><p><h4>Supporting Image/Video 2:</h4><br>";

					if ($support2 == "Image"){
						echo "<img src='";
						the_field('image_2');
						echo "' width='700px'>";
					}else if ($support2 == "Video"){
						echo "<pre>";
						the_field("video_2");
						echo "</pre>";
					}
					echo "<br>Caption 2: ";
					the_field("caption_2");

					echo "</p>";
				}
			?>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->


<?php get_sidebar(); ?>
<?php get_footer(); ?>
