<?php


if(!isset($totolText)) {
	
}
?>
<div class="pagination pagination-right">
	<ul>
<?php
		
		$firstP=$this->Paginator->first(__('First'), array('tag' => 'li'));
		if(!empty($firstP)) {
			echo $firstP;
		} else {
			echo "<li class='disabled'><span>First</span></li>";
		}
		if($this->Paginator->hasPrev()) {
			echo $this->Paginator->prev(__('Previous'), array('tag' => 'li'));;
		} else {
			echo "<li class='disabled'><span>Previous</span></li>";
		}
		echo $this->Paginator->numbers(array('separator'=>'', 'tag' => 'li', 'currentTag'=>'span'));
		if($this->Paginator->hasNext()) {
			echo $this->Paginator->next(__('Next'), array('tag' => 'li'));;
		} else {
			echo "<li class='disabled'><span>Next</span></li>";
		}
		$lastP=$this->Paginator->last(__('Last'), array('tag' => 'li'));
		if(!empty($lastP)) {
			echo $lastP;
		} else {
			echo "<li class='disabled'><span>Last</span></li>";
		}
		echo "<li><span>".$this->Paginator->counter(array('format' => __('Page %s of %s', '%page%', '%pages%')))."</span></li>";
		echo "<li><span style='padding-top: 3px;height:21px;width:21px'>".$this->Html->image(SITE_URL.'usermgmt/img/loading-circle.gif', array('id' => 'busy-indicator', 'style'=>'display:none;'))."</span></li>";
?>
	</ul>
</div>
<?php echo $this->Js->writeBuffer();  ?>