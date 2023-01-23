<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>Activity Logs</title>
		<style>
		 @page  {
					header: html_myHTMLHeader1;
					footer: html_myHTMLFooter1;
					margin-top: 10%;
					margin-bottom:10%;
					margin-left:40px;
					margin-right:40px;
					margin-header:4%;
					margin-footer:3%;	

				}
		</style>
	</head>
	<body>
		
		<?php echo $this->element('custom_header', array('data'=>$data)); ?>
			
		<sethtmlpageheader name="myHTMLHeader1" value="on" show-this-page="1" />
		
		<?php echo $this->element('custom_body', array('results'=>$results)); ?>
		
		
		 <sethtmlpagefooter name="myHTMLFooter1" value="on" show-this-page="1" />	
		 
		 <?php echo $this->element('custom_footer'); ?>
	    
	</body>
</html>