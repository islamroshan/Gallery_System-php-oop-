<?php
class Paginate 
{
	public $current_page;
	public $items_per_page;
	public $items_total_counts;

	public function __construct($page=1, $items_per_page=4, $items_total_counts=0)
	{
		$this->current_page = (int)$page;
		$this->items_per_page = (int)$items_per_page;
		$this->items_total_counts = (int)$items_total_counts;
	}
	public function next()
	{
		return	$this->current_page + 1;
	}
	public function previous()
	{
		return $this->current_page - 1;
	}
	public function page_total() 
	{
		return ceil($this->items_total_counts/$this->items_per_page);
	}

	public function has_previous()
	{
					//if pre is greater and equal to 1 then it has pre page else not
		return $this->previous() >= 1 ? true : false;
	}
	public function has_next()
	{				
							//if next is smaller and equal to page total then it has next page else not
		return $this->next() <= $this->page_total() ? true : false;
	}
	// it will ecape rest number and start form next num
	public function offset()
	{
		return 	($this->current_page - 1) * $this->items_per_page;
	}
}
 ?>
