<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
?>

<div class="reader_top_panel">
	<div class="topbar" id="readerNav">
		<div>
			<div class="topbar_left" style="display: inline-block">
				<h1 class="tbtitle dnone"><?php echo $comic->url() ?> :: <?php echo $chapter->url() ?></h1>
				
				<button class="btnPrev" onclick="prevPage()">Prev</button>
				<div class="tbtitle dropdown_parent mmh"><div class="text"><?php echo $comic->url() ?> ⤵</div>
					<?php
					echo '<ul class="dropdown">';
					foreach ($comics->all as $co)
					{
						echo '<li>' . $co->url() . '</li>';
					}
					echo '</ul>'
					?>
				</div>
                
				<div class="tbtitle dropdown_parent mmh"><div class="text"><?php echo '<a href="' . $chapter->href() . '">' . ((strlen($chapter->title()) > 58) ? (substr($chapter->title(), 0, 50) . '...') : $chapter->title()) . '</a>' ?> ⤵</div>
					<?php
					echo '<ul class="dropdown">';
					foreach ($chapters->all as $ch)
					{
						echo '<li>' . $ch->url() . '</li>';
					}
					echo '</ul>'
					?>
				</div>
				
                <span class="dh_left">
                    <?php
					echo '<select id="csel" class="asel selecto">';
					foreach ($chapters->all as $ch)
					{
						echo '<option value="' . $ch->href() . '">' . $ch->title() . '</option>';
					}
					echo '</select>'
					?>
                </span>
                
				<?php /* echo $chapter->download_url(NULL, "fleft larg"); */?>
			</div>
			<div class="topbar_right" style="display: inline-block">
				<div class="tbtitle dropdown_parent dropdown_right mmh"><div class="text"><?php echo count($pages); ?> ⤵</div>
					<?php
					$url = $chapter->href();
					echo '<ul class="dropdown" style="width:90px;">';
					for ($i = 1; $i <= count($pages); $i++)
					{
						echo '<li><a href="' . $url . 'page/' . $i . '" onClick="changePage(' . ($i - 1) . '); return false;">' . _("Page") . ' ' . $i . '</a></li>';
					}
					echo '</ul>'
					?>
				</div><span class="dh_right">
                <?php
                echo ' <select id="psel" class="selecto">';
                for ($i = 1; $i <= count($pages); $i++)
                {
                    echo '<option>' . $i . '</option>';//onClick="changePage(' . ($i - 1) . ');
                }
                echo '</select>'
                ?></span>
				<div class="divider mmh"></div>
				<span id="pagenumDrop" class="numbers mmh">
					<?php
					/*for ($i = (($val = $current_page - 3) <= 0)?(1):$val; $i <= count($pages) && $i < $current_page + 3; $i++) {*/
					for ($i = (($val = $current_page + 2) >= count($pages)) ? (count($pages)) : $val; $i > 0 && $i > $current_page - 3; $i--)
					{
						$current = ((count($pages) / 100 > 1 && $i / 100 < 1) ? '0' : '') . ((count($pages) / 10 > 1 && $i / 10 < 1) ? '0' : '') . $i;
						echo '<div class="number number_' . $i . ' ' . (($i == $current_page) ? 'current_page' : '') . '"><a href="' . $chapter->href . '' . $i . '">' . $current . '</a></div>';
					}
					?>
				</span>
				<button class="btnNext" onclick="nextPage()">Next</button> 
			</div>
		</div>
		<div class="clearer"></div>
	</div>
</div>

<?php
if (get_setting('fs_ads_top_banner') && get_setting('fs_ads_top_banner_active') && !get_setting('fs_ads_top_banner_reload'))
					echo '<div class="ads banner" id="ads_top_banner">' . get_setting('fs_ads_top_banner') . '</div>';

if (get_setting('fs_ads_top_banner') && get_setting('fs_ads_top_banner_active') && get_setting('fs_ads_top_banner_reload'))
    echo '<div class="ads iframe banner" id="ads_top_banner"><iframe marginheight="0" marginwidth="0" frameborder="0" src="' . site_url() . 'content/ads/ads_top.html' . '"></iframe></div>';
?>

<div id="page">

	<div class="inner">
		<a href="<?php echo $chapter->next_page($current_page); ?>" onClick="return nextPage();" >
			<img class="open" src="<?php echo $pages[$current_page - 1]['url'] ?>" />
		</a>
	</div>
</div>

<div class="clearer"></div>

<?php
if (get_setting('fs_ads_bottom_banner') && get_setting('fs_ads_bottom_banner_active') && !get_setting('fs_ads_bottom_banner_reload'))
					echo '<div class="ads banner" id="ads_bottom_banner">' . get_setting('fs_ads_bottom_banner') . '</div>';

if (get_setting('fs_ads_bottom_banner') && get_setting('fs_ads_bottom_banner_active') && get_setting('fs_ads_bottom_banner_reload'))
    echo '<div class="ads iframe banner" id="ads_bottom_banner"><iframe marginheight="0" marginwidth="0" frameborder="0" src="' . site_url() . 'content/ads/ads_bottom.html' . '"></iframe></div>';
?>

<div id="bottombar" onload="topbarAlign()">
    <div class="pagenumber">
		<?php echo _('Page') . ' ' . $current_page ?>
    </div>
	<div class="clearer"></div>
	
    <?php
    if (get_setting('fs_disqus_active')){ ?>
	<div id="disqus_thread" style="background-color: transparent;"></div>
	<script type="text/javascript">
    var disqus_shortname = '<?php echo get_setting('fs_disqus_name'); ?>';
    var disqus_title = '<?php echo $comic->title() ?> - <?php echo $chapter->title() ?> - Page <?php echo $current_page; ?>';
    var disqus_identifier = '<?php echo $comic->title() ?> :: <?php echo $chapter->title() ?> :: <?php echo $current_page; ?>';
    
    (function() {
        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    })();
    
    /* * * Disqus Reset Function * * */
    function dreset(newUrl, pageNum) {
        if(typeof(DISQUS) != "undefined" && DISQUS !== null) {
            DISQUS.reset({
                reload: true,
                config: function () {
                    this.page.identifier = '<?php echo $comic->title() ?> :: <?php echo $chapter->title() ?> :: ' + pageNum;
                    this.page.url = newUrl;
                    this.page.title = '<?php echo $comic->title() ?> - <?php echo $chapter->title() ?> - Page ' + pageNum;
                }
            });
        }
        return true;
    };
	</script><noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
    <?php } ?>
</div>



<script type="text/javascript">
	var title = document.title;
	var pages = <?php echo json_encode($pages); ?>;

	var next_chapter = "<?php echo $next_chapter; ?>";
	var preload_next = 5;
	var preload_back = 2;
	var current_page = <?php echo $current_page - 1; ?>;

	var initialized = false;

	var base_url = '<?php echo $chapter->href() ?>';
	var site_url = '<?php echo site_url() ?>';

	var gt_page = '<?php echo addslashes(_("Page")) ?>';
	var gt_key_suggestion = '<?php echo addslashes(_("Use W-A-S-D or the arrow keys to navigate")) ?>';
	var gt_key_tap = '<?php echo addslashes(_("Double-tap to change page")) ?>';

	function changePage(id, noscroll, nohash)
	{
		id = parseInt(id);
        
		if (initialized && id == current_page){
			return false;
        }

		initialized = true;
        
		if(id > pages.length-1)
		{
			location.href = next_chapter;
			return false;
		}
		if(id < 0)
		{
            if (current_chapter_index > 0) 
            {
                // Go to the previous chapter. Which might be across volumes!
                location.href = previous_chapter;
            } 
            else 
            {
                // If there's not a previous chapter, either stay on page 0 - or return to the series page.
               location.href = series_homepage;
            }
		}
        
		preload(id);
        
        <?php if (get_setting('fs_disqus_active')){ ?>
        /*Disqus*/
        dreset(base_url+'page/' + (id + 1), (id + 1));
        <?php } ?>
        
		current_page = id;
        
		next = parseInt(id+1);
        
		jQuery("html, body").stop(true,true);
        
		if(!noscroll) jQuery.scrollTo('.panel', 0, {'offset':{'top':-6}});

		if(pages[id].loaded !== true) {
			jQuery('#page .inner img.open').css({'opacity':'0'});
			jQuery('#page .inner img.open').attr('src', pages[id].url);
		}
		else {
			jQuery('#page .inner img.open').css({'opacity':'1'});
			jQuery('#page .inner img.open').attr('src', pages[id].url);
		}

		resizePage(id);
        
		if(!nohash) History.pushState(null, null, base_url+'page/' + (current_page + 1));
        jQuery(document).prop('title', gt_page + ' ' + (current_page+1) + ' :: ' + title);
        
		update_numberPanel();
		jQuery('#pagelist .current').removeClass('current');

		jQuery("#ads_top_banner.iframe iframe").attr("src", site_url + "content/ads/ads_top.html");
		jQuery("#ads_bottom_banner.iframe iframe").attr("src", site_url + "content/ads/ads_bottom.html");
        
        

		return false;
	}


	function resizePage(id) {
		var doc_width = jQuery(document).width();
		var page_width = parseInt(pages[id].width);
		var page_height = parseInt(pages[id].height);
		var nice_width = 980;
		var perfect_width = 980;

		if(doc_width > 1200) {
			nice_width = 1120;
			perfect_width = 1000;
		}
		if(doc_width > 1600) {
			nice_width = 1400;
			perfect_width = 1300;
		}
		if(doc_width > 1800) {
			nice_width = 1600;
			perfect_width = 1500;
		}

		if (page_width > nice_width && (page_width/page_height) > 1.2) {
			if(page_height < 1610) {
				width = page_width;
				height = page_height;
			}
			else {
				height = 1600;
				width = page_width;
				width = (height*width)/(page_height);
			}
			jQuery("#page").css({'max-width': 'none', 'overflow':'auto'});
			jQuery("#page").animate({scrollLeft:9000},400);
			jQuery("#page .inner img.open").css({'max-width':'99999px'});
			jQuery('#page .inner img.open').attr({width:width, height:height});
			if(jQuery("#page").width() < jQuery("#page .inner img.open").width()) {
				isSpread = true;
				create_message('is_spread', 3000, 'Tap the arrows twice to change page');
			}
			else {
				jQuery("#page").css({'max-width': width+10, 'overflow':'hidden'});
				isSpread = false;
				delete_message('is_spread');
			}
		}
		else{
			if(page_width < nice_width && doc_width > page_width + 10) {
				width = page_width;
				height = page_height;
			}
			else {
				width = (doc_width > perfect_width) ? perfect_width : doc_width - 10;
				height = page_height;
				height = (height*width)/page_width;
			}
			jQuery('#page .inner img.open').attr({width:width, height:height});
			jQuery("#page").css({'max-width':(width + 10) + 'px','overflow':'hidden'});
			jQuery("#page .inner img.open").css({'max-width':'100%'});
			isSpread = false;
			delete_message('is_spread');
		}
	}
    
	function nextPage()
	{
	    var element = document.getElementById('psel');
		changePage(current_page+1);
		element.value = current_page+1;
		window.scrollTo(0, 53);
		return false;
	}

   


	function prevPage()
	{
	    var element = document.getElementById('psel');
		changePage(current_page-1);
		element.value = current_page+1;
		window.scrollTo(0, 53);
		return false;
	}
	
	function toggleZoomScreen() {
    document.body.style.zoom="100%"
    } 
	
	function zoom(scale) {
    var scale = 'scale(1)';
    document.body.style.webkitTransform =  scale;    // Chrome, Opera, Safari
    document.body.style.msTransform =   scale;       // IE 9
    document.body.style.transform = scale;  
    };

	function preload(id)
	{
		var array = [];
		var arraydata = [];
		for(i = -preload_back; i < preload_next; i++)
		{
			if(id+i >= 0 && id+i < pages.length)
			{
				array.push(pages[(id+i)].url);
				arraydata.push(id+i);
			}
		}

		jQuery.preload(array, {
			threshold: 40,
			enforceCache: true,
			onComplete:function(data)
			{
				var idx = data.index;
				if(data.index == page)
					return false;
				var page = arraydata[idx];
				pages[page].loaded = true;
				jQuery('.numbers .number_'+ (page+1)).addClass('loaded');
				if(current_page == page)
				{
					jQuery('#page .inner img.open').animate({'opacity':'1.0'}, 800);
					jQuery('#page .inner img.open').attr('src', pages[current_page].url);
				}
			}

		});
	}

	function create_numberPanel()
	{
		result = "";
		for (j = pages.length+1; j > 0; j--) {
			nextnumber = ((j/1000 < 1 && pages.length >= 1000)?'0':'') + ((j/100 < 1 && pages.length >= 100)?'0':'') + ((j/10 < 1 && pages.length >= 10)?'0':'') + j;
			result += "<div class='number number_"+ j +" dnone'><a href='" + base_url + "page/" + j + "' onClick='changePage("+(j-1)+"); return false;'>"+nextnumber+"</a></div>";
		}
		jQuery(".topbar_right .numbers").html(result);
	}

	function update_numberPanel()
	{
		jQuery('.topbar_right .number.current_page').removeClass('current_page');
		jQuery('.topbar_right .number_'+(current_page+1)).addClass('current_page');
		jQuery('.topbar_right .number').addClass('dnone');
		for (i = ((val = current_page - 1) <= 0)?(1):val; i <= pages.length && i < current_page + 4; i++) {
			jQuery('.number_'+i).removeClass('dnone');
		}
		jQuery('.pagenumber').html(gt_page + ' ' + (current_page+1));
	}

	function chapters_dropdown()
	{
		location.href = jQuery('#chapters_dropdown').val();
	}

	function togglePagelist()
	{
		jQuery('#pagelist').slideToggle();
		jQuery.scrollTo('#pagelist', 300);
	}


	var isSpread = false;
	var button_down = false;
	var button_down_code;

	jQuery(document).ready(function() {
        window.stateChangeIsLocal = true;//keep from trigering statechange;
                
        document.title = gt_page+' ' + (current_page+1) + ' :: ' + title;
		jQuery(document).keydown(function(e){

			if(!button_down && !jQuery("input").is(":focus"))
			{
				button_down = true;
				code = e.keyCode || e.which;

				if(e.keyCode==37 || e.keyCode==65)
				{
					if(!isSpread) prevPage();
					else if(e.timeStamp - timeStamp37 < 400 && e.timeStamp - timeStamp37 > 150) prevPage();
					timeStamp37 = e.timeStamp;

					button_down = true;
					e.preventDefault();
					button_down_code = setInterval(function() {
						if (button_down) {
							jQuery('#page').scrollTo("-=13",{axis:"x"});
						}
					}, 20);
				}
				if(e.keyCode==39 || e.keyCode==68)
				{ 
					if(!isSpread) nextPage();
					else if(e.timeStamp - timeStamp39 < 400 && e.timeStamp - timeStamp39 > 150) nextPage();
					timeStamp39 = e.timeStamp;

					button_down = true;
					e.preventDefault();
					button_down_code = setInterval(function() {
						if (button_down) {
							jQuery('#page').scrollTo("+=13",{axis:"x"});
						}
					}, 20);
				}


				if(code == 40 ||code == 83)
				{
					e.preventDefault();
					button_down_code = setInterval(function() {
						if (button_down) {
							jQuery.scrollTo("+=13");
						}
					}, 20);
				}

				if(code == 38 || code == 87)
				{
					e.preventDefault();
					button_down_code = setInterval(function() {
						if (button_down) {
							jQuery.scrollTo("-=13");
						}
					}, 20);

				}
			}

		});

		jQuery(document).keyup(function(e){
			button_down_code = window.clearInterval(button_down_code);
			button_down = false;
		});

		timeStamp37 = 0;
		timeStamp39 = 0;

		jQuery(window).bind('statechange',function(){
            if(window.stateChangeIsLocal){
                var State = History.getState();
                url = parseInt(State.url.substr(State.url.lastIndexOf('/')+1));
                changePage(url-1, false, true);
                document.title = gt_page+' ' + (current_page+1) + ' :: ' + title;
            }
		});



		State = History.getState();
		url = State.url.substr(State.url.lastIndexOf('/')+1);
		if(url < 1){
			url = 1;
        }
		current_page = url-1;
		History.pushState(null, null, base_url+'page/' + (current_page+1));
		changePage(current_page, false, true);
		create_numberPanel();
		update_numberPanel();
		document.title = gt_page+' ' + (current_page+1) + ' :: ' + title;

		jQuery(window).resize(function() {
			resizePage(current_page);
		});
        
        $('.asel').on('change', function() {//chapter
            window.stateChangeIsLocal = false;
            location.href = $(this).val();
        });
        
        $('#osel').val("<?php echo $comic->href(); ?>");
        $('#csel').val("<?php echo $chapter->href(); ?>");
        
        $('#psel').on('change', function() {//page
            changePage($(this).find("option:selected").text() - 1);
        });
	});
	
	
	
</script>

<script type="text/javascript">
	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
</script>
