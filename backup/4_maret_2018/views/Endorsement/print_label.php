<?php
	ob_start();
?>
<style type="text/css" media="print">
    @page
    {
        size: auto;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */
    }
</style>
<html>
	<head>
		<title>LABEL</title>
		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>" type="text/javascript"></script>
		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() {
					window.print();
				}, 400);
			});
		</script>
	</head>
	<body>
		<div id="printArea" style="font-size:8pt; width: 210px;">
			<div style="margin-left:-6px; margin-top:-11px;">
			<strong>DATE
			<?=strtoupper(date("F.d.Y"));?>
			<br/>
			SEEN BY,<br/>
			INDONESIAN ECONOMIC AND TRADE<br/>
			OFFICE TO <?php echo strtoupper($namainstitusi) ?></strong><br/>
			<div style="margin-top:10px;">
			<img src="<?php echo base_url()?>pk/printStamp" /><br />
			<img src="<?php echo base_url('pk/printBarcode/') . $bc?>" /><br />
			<br />
			</div>
			<div style="margin-top:-14px;">
			For validation of this endorsement, visit:<br/>
			http://validation.kdei-taipei.org
			</div>
			</div>
		</div>
	</body>
</html>

<?
	ob_end_flush();
?>
