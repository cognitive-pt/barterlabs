<div id="thumbnail_gallery">
	<div class="gallery_big">
		<ul>
			<?php 
				$i = 1;
				foreach($labPics as $labPic): { 
					echo "<li id=\"slide".$i."\">";   
							echo $this->Html->link($this->Html->image('pics/' . $labPic['Pic']['name'], 
								array(
									'alt'=> $labPic['Pic']['id'], 
									)), 
								array('controller' => 'labs', 
									'action' => 'viewPic', $labPic['Pic']['id'],'plugin'=>''), 
						    	array('escape' => false)); 
					echo "</li>";
				$i++;
				} endforeach;
			?>
		</ul>
	</div>
	<div class="gallery_preview">
		<ul>
			<?php 
				$i = 1;
				foreach($labPics as $labPic): {?>
					<div class = "labDispPicViewElementPics">
						<?php echo "<li><a href=\"#slide".$i."\">";
								echo $this->Html->image('pics/' . $labPic['Pic']['name'], 
									array(
										'alt'=> $labPic['Pic']['id'], 
										'height'=>'55', 
										'width'=>'55'
										)
									); 
								echo "</a></li>";?>
					</div>
				<?php $i++;
				} endforeach;
			?>
		</ul>
	</div>
</div>