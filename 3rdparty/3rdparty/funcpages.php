<?php Class pages
{
var $start=0;	
var $apage=25;
var $link='';
var $number=0;
var $pages=0;
var $html='';
var $shownext=1;

function total()
{
	if(strpos($this->link,'?')==0) $this->link .='?setpages=1'; else $this->link .='&setpages=1';
	$this->setbefore();
	$this->start();
	$this->main();
	$this->setend();
}

function afterstart()
{
	return $res="&apage=$this->apage&number=$this->number";
}
function start()
{
	global $lang;
	$this->pages=round (($this->number/$this->apage)+0.4);
	if(($this->start>=$this->apage) and ($this->shownext==1) )
	{
		$this->html .= '<div style="float:left; padding: 3px; background-color: #CCFF99; margin-left: 3px; border: 1px  #CCCCCC solid; cursor: pointer">'.'<a href="'.$this->link.'&start='.($this->start-$this->apage).$this->afterstart().'">'.'&laquo;Previous</a></div>';
	} 
	else if($this->shownext==1) 
		$this->html .= '<div style="float:left; padding: 3px; background-color: #333333; margin-left: 3px;color: #FFFFFF; font-weight: bold; font-size: 12px;">&laquo;Previous</div>';

	
}

function setbefore()
{
	$this->html .= '<div style="list-style: none">';
}
function setend()
{
	$this->html .= '</div>';
}

function main()
{
	global $lang;
	$this->html .= $lang['page'].'  ';
	$curpage=($this->start/$this->apage)+1;
	$untill=$this->pages;
	$from=1;
	
	if(($untill-$from)>10)
	{
		if($curpage>4)
		{
			$from=$curpage-4;
			$untill=$curpage+4;
			if($untill>$this->pages) $untill=$this->pages;
		}
		else
		{
			$from=1;
			$untill=10;
			if($untill>$this->pages) $untill=$this->pages;
		}
	}
	
	for($i=$from;$i<=$untill;$i++)
	{
		$sh=$this->apage*($i-1);
		if(($sh != $this->start) or ($this->shownext==0))
		$this->html .= '<div style="float:left; padding: 3px; background-color: #CCFF99; margin-left: 3px; border: 1px  #CCCCCC solid; cursor: pointer">'."<a href=\"$this->link&start=$sh".$this->afterstart()."\">".$i.'</a></div>';
		else $this->html .= '<div style="float:left; padding: 3px; background-color: #333333; margin-left: 3px;color: #FFFFFF; font-weight: bold; font-size: 12px;">'.$i.'</div>';
	}

	
	if(($this->start+$this->apage)<$this->number) 
	{
		$this->html .= '<div style="float:left; padding: 3px; background-color: #CCFF99; margin-left: 3px; border: 1px  #CCCCCC solid; cursor: pointer">'.'<a href="'.$this->link.'&start='.($this->start+$this->apage).$this->afterstart().'">'.'Next&raquo;</a></div>';
	}
	else {
		$this->html .= '<div style="float:left; padding: 3px; background-color: #333333; margin-left: 3px;color: #FFFFFF; font-weight: bold; font-size: 12px;">Next</div>';
	}
}
}
?>