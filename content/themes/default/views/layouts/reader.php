<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $template['title']; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<?php
		if ($this->config->item('theme_extends') != '' &&
				$this->config->item('theme_extends') != get_setting('fs_theme_dir') &&
				$this->config->item('theme_extends_css') === TRUE &&
				file_exists('content/themes/' . $this->config->item('theme_extends') . '/style.css'))
		{
			echo link_tag('content/themes/' . $this->config->item('theme_extends') . '/style.css?v='.FOOLSLIDE_VERSION);
		}
		if (file_exists('content/themes/' . get_setting('fs_theme_dir') . '/style.css'))
			echo link_tag('content/themes/' . get_setting('fs_theme_dir') . '/style.css?v='.FOOLSLIDE_VERSION);?>
		
		<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo site_url() . 'assets/css/font-awesome.min.css?v='.FOOLSLIDE_VERSION ?>">
		<link rel="sitemap" type="application/xml" title="Sitemap" href="<?php echo site_url() ?>sitemap.xml" />
		<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo site_url() ?>rss.xml" />
		<link rel="alternate" type="application/atom+xml" title="Atom" href="<?php echo site_url() ?>atom.xml" />
		<link rel='index' title='<?php echo get_setting('fs_gen_site_title') ?>' href='<?php echo site_url() ?>' />
		
		
		
		<!-- THUMBNAIL CODE -->
		
		<?php
		$url = $_SERVER['REQUEST_URI'];
        if (strpos($url,'/grand-blue/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href = "http://helveticascans.com/r/thumbnails/gb.png"/>';
        }
        else if (strpos($url,'/kinema/') !== false)
        {
            echo '<link rel="/image_src/" type="image/gif" href = "http://helveticascans.com/r/thumbnails/kinema.png"/>';
        }
        else if (strpos($url,'/kings-viking/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href = "http://helveticascans.com/r/thumbnails/kv.png"/>';
        }
        else if (strpos($url,'/mousou-telepathy/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/mst.png"/>';
        }
        else if (strpos($url,'/mousou-telepathy-extras/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/mste.png"/>';
        }
        else if (strpos($url,'/tarareba/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/tar.png"/>';
        }
        else if (strpos($url,'/ten-thousand-kinds-of-love/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/thousand.png"/>';
        }
        else if (strpos($url,'/monkey-mountain/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/mb.png"/>';
        }
        else if (strpos($url,'/kumika-no-mikaku/') !== false)
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/kum.png"/>';
        }
        else
        {
            echo '<link rel="image_src" type="image/gif" href="http://helveticascans.com/r/thumbnails/hs.png"/>';
        }
		?>
		
		<!---------------------------------------------------------------------------------------------------------------->
		
		
		
		<meta name="generator" content="FoOlSlide <?php echo FOOLSLIDE_VERSION ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<script src="<?php echo site_url() . 'assets/js/jquery.min.js?v='.FOOLSLIDE_VERSION ?>"></script>
		<script src="<?php echo site_url() . 'assets/js/jquery.plugins.js?v='.FOOLSLIDE_VERSION ?>"></script>
		
		<script type="text/javascript">
		    function alignTopbar()
		    {
		        var element = document.getElementById('topbarID');
		        
		        if(element != null)
		        {
		            location.href = "#";
                    location.href = "#readerNav";
		        }
		    }
		</script>

		<?php if ($this->agent->is_browser('MSIE')) : ?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
			// Let's make placeholders work on IE and old browsers too
			jQuery('[placeholder]').focus(function() {
				var input = jQuery(this);
				if (input.val() == input.attr('placeholder')) {
					input.val('');
					input.removeClass('placeholder');
				}
			}).blur(function() {
				var input = jQuery(this);
				if (input.val() == '' || input.val() == input.attr('placeholder')) {
					input.addClass('placeholder');
					input.val(input.attr('placeholder'));
				}
			}).blur().parents('form').submit(function() {
				jQuery(this).find('[placeholder]').each(function() {
					var input =jQuery(this);
					if (input.val() == input.attr('placeholder')) {
						input.val('');
					}
				})
			});
			});
			
			jQuery(function($){
    	     $( '.menu-btn' ).click(function(){
    	     $('.responsive-menu').toggleClass('expand')
    	     })
        })
		</script>
		<!-----------------------------------------Hamburger menu stuff--------------------------------->
		
		<?php endif; ?>
		<?php echo get_setting('fs_theme_header_code'); ?>
	</head>
	<body class="<?php if (isset($_COOKIE["night_mode"]) && $_COOKIE["night_mode"] == 1) echo 'night '; ?>" style="background-color:#26292C;" onload= "alignTopbar()">
		<div id="wrapper">
			<?php echo get_setting('fs_theme_preheader_text'); ?>
			
			<!-----------------------------------------------------Header Shit--------------------------------------->
<nav>
  <div id="logo"><a href="http://helveticascans.com/" class="logolink" style= "padding: 0px; float:left;"><img id="logo" src="http://helveticascans.com/r/assets/images/r_logo.png"></img></a></div>

  <label for="drop" class="toggle">&#9776;</label>
  <input type="checkbox" id="drop" />
  <ul class="menu">
                        <li class="searchboxstylemobile">
							<?php
							echo form_open("search/");
							echo form_input(array('name' => 'search', 'placeholder' => _('Series Search; Type, then press enter...'), 'id' => 'searchbox', 'class' => 'fright'));
							echo form_close();
							?>
						</li>
                        <li>
						    <a href="http://helveticascans.com/">Home</a>
						</li>
						<li>
							<a href="<?php echo site_url('directory') ?>">Manga</a>
						</li>
						<li>
							<a href="<?php echo site_url('') ?>">Latest Releases</a>
						</li>
						<li>
						    <a href="http://helveticascans.com/project-status">Project Status</a>
						</li>
						<li>
						    <a href="http://helveticascans.com/about-faq">About Us / FAQ</a>
						</li>
						<li>
						    <a href="http://goo.gl/forms/kfic25yLD5bUaVlr1">Join Us</a>
						</li>
						
  </ul>
  <ul id="search_full" class="menu">
      <li class="searchbox_full">
							<?php
							echo form_open("search/");
							echo form_input(array('name' => 'search', 'placeholder' => _('Series Search; Type, then press enter...'), 'id' => 'searchbox', 'class' => 'fright'));
							echo form_close();
							?>
						</li>
  </ul>
</nav>
			<article id="content">

				<?php
				if (!isset($is_reader) || !$is_reader)
					echo '<div class="panel">';

				if (get_setting('fs_ads_top_banner') && get_setting('fs_ads_top_banner_active') && !get_setting('fs_ads_top_banner_reload') && (!isset($is_reader) || !$is_reader))
					echo '<div class="ads banner" id="ads_top_banner">' . get_setting('fs_ads_top_banner') . '</div>';

				if (get_setting('fs_ads_top_banner') && get_setting('fs_ads_top_banner_active') && get_setting('fs_ads_top_banner_reload') && (!isset($is_reader) || !$is_reader))
					echo '<div class="ads iframe banner" id="ads_top_banner"><iframe marginheight="0" marginwidth="0" frameborder="0" src="' . site_url() . 'content/ads/ads_top.html' . '"></iframe></div>';

				//if (isset($show_sidebar))
				//	echo get_sidebar();

				if (isset($is_latest) && $is_latest)
				{
					$loaded_slideshow = FALSE;
					for ($i = 0; $i < 5; $i++)
					{
						$slideshow_img = get_setting('fs_slsh_src_' . $i);
						if ($slideshow_img != FALSE)
						{
							if (!$loaded_slideshow)
							{
								?>
								<link rel="stylesheet" href="<?php echo site_url() ?>assets/js/nivo-slider.css" type="text/css" media="screen" />
								<link rel="stylesheet" href="<?php echo site_url() ?>assets/js/nivoThemes/default/default.css" type="text/css" media="screen" />
								<script src="<?php echo site_url() ?>assets/js/jquery.nivo.slider.pack.js" type="text/javascript"></script>
								<script type="text/javascript">
									jQuery(window).load(function() {
										jQuery('#slider').nivoSlider({
											pauseTime: 6000
										});
									});
								</script>
								<style>
									.nivoSlider {
										width:100% !important; /* Change this to your images width */
										overflow:hidden;
                                        background-size: contain !important;
                                        background-position: center !important;
									}
									.nivoSlider img {
										position:absolute;
										top:0px;
										left:0px;
										display:none;
                                        width: auto;
                                        height: auto;
									}

									.nivoSlider a {
										border:0;
										display:block;
									}
								</style>
								<?php
								echo ' <div class="slider-wrapper theme-default">
									<div id="slider" class="nivoSlider">';
								$loaded_slideshow = TRUE;
							}

							if (get_setting('fs_slsh_url_' . $i))
								echo '<a href="' . get_setting('fs_slsh_url_' . $i) . '">';
							echo '<img src="' . get_setting('fs_slsh_src_' . $i) . '" alt="" ' . ((get_setting('fs_slsh_text_' . $i) != FALSE) ? 'title="#fs_slsh_text_' . $i . '"' : '') . ' />';
							if (get_setting('fs_slsh_url_' . $i))
								echo '</a>';
						}
					}

					if ($loaded_slideshow)
					{
						echo '</div>';
						for ($i = 0; $i < 5; $i++)
						{
							if (get_setting('fs_slsh_text_' . $i))
							{
								echo '<div id="fs_slsh_text_' . $i . '" class="nivo-html-caption">';
								echo get_setting('fs_slsh_text_' . $i);
								echo '</div>';
							}
						}
						echo '</div>';
					}
				}

				// here we output the body of the page
				echo $template['body'];
				
				//if (isset($show_sidebar))
				//	echo get_sidebar();

				if (get_setting('fs_ads_bottom_banner') && get_setting('fs_ads_bottom_banner_active') && !get_setting('fs_ads_bottom_banner_reload') && (!isset($is_reader) || !$is_reader))
					echo '<div class="ads banner" id="ads_bottom_banner">' . get_setting('fs_ads_bottom_banner') . '</div>';

				if (get_setting('fs_ads_bottom_banner') && get_setting('fs_ads_bottom_banner_active') && get_setting('fs_ads_bottom_banner_reload') && (!isset($is_reader) || !$is_reader))
					echo '<div class="ads iframe banner" id="ads_bottom_banner"><iframe marginheight="0" marginwidth="0" frameborder="0" src="' . site_url() . 'content/ads/ads_bottom.html' . '"></iframe></div>';

				if (!isset($is_reader) || !$is_reader)
					echo '</div>';
				?>

			</article>

		</div>
		<div id="footer">
			<div class="text">
				<div>
					<?php echo get_setting('fs_gen_footer_text'); ?>
				</div>
			</div>
		</div>

		<div id="messages">
		</div>
	</body>
	<?php echo get_setting('fs_theme_footer_code'); ?>
</html>