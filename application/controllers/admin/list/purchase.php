<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144250205-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144250205-2');
</script>



<script>
	jQuery(document).ready(function()
	{
		document.getElementById('total_notification').innerHTML = 0;
		document.getElementById('view_notification').innerHTML = "<li class='header'>You have 0 notification</li><li></li>";
		
		document.getElementById('total_logerror').innerHTML = 0;
		document.getElementById('view_logerror').innerHTML = "<li class='header'>You have 0 log error</li><li></li>";
		getNotification();
		getLogerror();
	});
	
	setInterval(function (){getNotification();}, 300000);
	setInterval(function (){getLogerror();}, 600000);
	
	function getNotification()
	{
		
		var uri = 'https://dashboard.wms.haistar.co.id/index.php?r=Dashboard/getOrderNotification';
		jQuery.ajax(
		{
			type: 'POST',
			async: false,
			dataType: "json",
			cache: false,
			url: uri,
			data: {},
			success: function(result) 
			{
				var msgs = result.split("^~^");
				document.getElementById('total_notification').innerHTML = msgs[0];
				document.getElementById('view_notification').innerHTML = msgs[1];
				
				if(msgs[0] != "0")
				{
					var element = document.getElementById("total_notification");
					element.classList.add("blink");
					var audio = document.getElementById("myAudio");
					audio.play();
				}
			}
		});
	}
	
	function getLogerror()
	{
		var uri = 'https://dashboard.wms.haistar.co.id/index.php?r=Dashboard/getLogError';
		jQuery.ajax(
		{
			type: 'POST',
			async: false,
			dataType: "json",
			cache: false,
			url: uri,
			data: {},
			success: function(result) 
			{
				var msgs = result.split("^~^");
				document.getElementById('total_logerror').innerHTML = msgs[0];
				document.getElementById('view_logerror').innerHTML = msgs[1];
				
				if(msgs[0] != "0")
				{
					var element = document.getElementById("total_logerror");
					element.classList.add("blink");
				}
			}
		});
	}
</script>	
	<!-- Require the navigation -->