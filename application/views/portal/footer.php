         </div>  
      </div>
          <!--  <div class="clear"></div> -->
    </div>
  <div class="push"></div>
</div>	

<div id="footer">
	<div class="container"> 

		<?php $copyright = ( date( 'Y' > '2010' ) ) ? '2010&ndash; ' . date( 'Y' ) : '2010'; ?> 

		<p>
		    <small> 
		        &copy; <?php echo $copyright . ' ' . anchor( '', $company_name) . ' All rights reserved' ?>. 
		    </small>
		</p> 
	</div>
</div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js" type="text/javascript"></script>
<script type='text/javascript'>
    $(function () {
	    <?php if($this->session->flashdata('message')){ ;?>
	 	$('div.login-error').html("<?php echo $this->session->flashdata('message') ;?>");
     });
	 <?php } ;?>
</script>

</body>
</html>