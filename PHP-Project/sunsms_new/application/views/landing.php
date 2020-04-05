<?php if($header!="")$this->load->view($header); ?>
	
<!--   **************** INCLUDE MIDDLE CONTENT HERE **************  -->

<?php
if($left_menu!="") $this->load->view($left_menu);
  $this->load->view($middle_content);
?>
	<!--   **************** INCLUDE FOOTER HERE **************  -->

<?php if($footer!="")$this->load->view($footer);?>	
