<?php

/**
* GK Image Show - view file
* @package Joomla!
* @Copyright (C) 2009-2011 Gavick.com
* @ All rights reserved
* @ Joomla! is Free Software
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ version $Revision: GK4 1.0 $
**/

// no direct access
defined('_JEXEC') or die;

?>

<div id="gkIs-<?php echo $this->config['module_id'];?>" class="gkIsWrapper-gk_financial_business">
	<div class="gkIsPreloader"></div>
	
	<div class="gkIsImage" style="height: <?php echo $height; ?>px;">
		<?php for($i = 0; $i < count($this->config['image_show_data']); $i++) : ?>
			<?php if($this->config['image_show_data'][$i]->published) : ?>
				<?php 
								
					unset($path, $title, $link);
	                if($this->config['image_show_data'][$i]->type == "k2"){
	           	        $title = htmlspecialchars($this->articlesK2[$this->config['image_show_data'][$i]->artK2_id]["title"]);
	                     $link =  $this->articlesK2[$this->config['image_show_data'][$i]->artK2_id]["link"];
	                 } else {
				        // creating slide title
					   $title = htmlspecialchars(($this->config['image_show_data'][$i]->type == "text") ? $this->config['image_show_data'][$i]->name : $this->articles[$this->config['image_show_data'][$i]->art_id]["title"]);
	                   // creating slide link
					   $link = ($this->config['image_show_data'][$i]->type == "text") ? $this->config['image_show_data'][$i]->url : $this->articles[$this->config['image_show_data'][$i]->art_id]["link"];	
					}
		            // creating slide path					
					$path = '';
					// check if the slide have to be generated or not
					if($this->config['generate_thumbnails'] == 1) {
						$path = $uri->root().'modules/mod_image_show_gk4/cache/'.GKIS_FinancialBusiness_Image::translateName($this->config['image_show_data'][$i]->image, $this->config['module_id']);
					} else {
						$path = $this->config['image_show_data'][$i]->image;
					}
					
				?>
				
				<div class="gkIsSlide" style="z-index: <?php echo $i+1; ?>;" title="<?php echo $title; ?>"><?php echo $path; ?><a href="<?php echo $link; ?>">link</a></div>
			<?php endif; ?>
		<?php endfor; ?>
		
	</div>
	
	<div class="gkIsText">
		<div class="gkIsTextTitle"></div>
		
		<?php if($this->config['config']->gk_financial_business->gk_financial_business_interface == 1) : ?>
		<div class="gkIsTextInterface">
			<?php for($i = 0; $i < count($this->config['image_show_data']); $i++) : ?>
			<span><?php echo $i; ?></span>
			<?php endfor; ?>
		</div>
		<?php endif; ?>
		
		<div class="gkIsTimeline">
			<div class="gkIsProgress">Progress bar</div>
		</div>
	</div>
	
		
	<div class="gkIsTextData">
		<?php for($i = 0; $i < count($this->config['image_show_data']); $i++) : ?>
			<?php if($this->config['image_show_data'][$i]->published) : ?>
			
			<?php
				// cleaning variables
				unset($link, $content);
				
				if($this->config['image_show_data'][$i]->type == "k2"){
				     $title = htmlspecialchars($this->articlesK2[$this->config['image_show_data'][$i]->artK2_id]["title"]);
				     $date = JHTML::_('date', $this->articlesK2[$this->config['image_show_data'][$i]->artK2_id]['date'], $this->config['config']->gk_financial_business->gk_financial_business_date_format);
				     $link = $this->articlesK2[$this->config['image_show_data'][$i]->artK2_id]["link"];
				 } else {
				    // creating slide title
				   $title = htmlspecialchars(($this->config['image_show_data'][$i]->type == "text") ? $this->config['image_show_data'][$i]->name : $this->articles[$this->config['image_show_data'][$i]->art_id]["title"]);
				   // date
				   $date = JHTML::_('date', $this->articles[$this->config['image_show_data'][$i]->art_id]['date'], $this->config['config']->gk_financial_business->gk_financial_business_date_format);
				   // creating slide link
				   $link = ($this->config['image_show_data'][$i]->type == "text") ? $this->config['image_show_data'][$i]->url : $this->articles[$this->config['image_show_data'][$i]->art_id]["link"];	
				}
				
			?>
		
			<div class="gkIsTextItem">
				<span><?php echo $date; ?></span><a href="<?php echo $link; ?>"><?php echo $title; ?></a>
			</div>
			<?php endif; ?>
		<?php endfor; ?>
	</div>
</div>