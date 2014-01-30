var activeobj; var tmr; var scrollpos=0; var endpoint=0; var scrollfluc=100; var scrollmode="+"; var lastcompleted=true;
var brname=getBrName();
function scrollToLink(lnkid)
	{
	try
		{
		clearTimeout(tmr)
		}
	catch(e)
		{
		}
		
	var obj=document.getElementById("_"+lnkid)
	endpoint=obj.offsetTop+500;
	//alert(endpoint);

	if(brname=="fire")
		scrollpos=window.pageYOffset;
	else if(brname=="ie")
		scrollpos=document.documentElement.scrollTop;
	else
		scrollpos=document.body.scrollTop;
		
		//alert(scrollpos);

	if(endpoint<scrollpos)
		{
		scrollmode="-";
		scrollfluc=Math.round((scrollpos-endpoint)/10)
		}
	else
		{
			
		scrollmode="+";
		scrollfluc=Math.round((endpoint-scrollpos)/10)
		//alert(scrollfluc);
		}

	animateScroll()	;
	}

function animateScroll()
	{
		
	if(brname=="fire")
		{
		var scrollpos=window.pageYOffset
		var currentpos=window.pageYOffset
		}
	else if(brname=="ie")
		{
		var scrollpos=document.documentElement.scrollTop
		var currentpos=document.documentElement.scrollTop
		}
	else
		{
		var scrollpos=document.body.scrollTop
		var currentpos=document.body.scrollTop
		}

	if(scrollmode=="+")
		{
		if(scrollpos<endpoint)
			{
				
			if(currentpos+scrollfluc>endpoint)
				{
				if(brname=="fire")
					window.scroll(0,endpoint)
				else if(brname=="ie")
					document.documentElement.scrollTop=endpoint
				else
					document.body.scrollTop=endpoint
				}
			else
				{
					
				if(brname=="fire")
					window.scroll(0,window.pageYOffset+scrollfluc)
				else if(brname=="ie")
					document.documentElement.scrollTop=document.documentElement.scrollTop+scrollfluc
				else
					document.body.scrollTop=document.body.scrollTop+scrollfluc
				
				}


			//document.title=getCurrentScrollPos() + " " + endpoint + " " + getOverallDocHeight();
			/*
			if(getCurrentScrollPos()>=getOverallDocHeight())
				{
				clearTimeout(tmr)
				return;
				}			
			*/
			tmr=setTimeout("animateScroll()",50)
			}
		}
	else if(scrollmode=="-")
		{
		if(scrollpos>endpoint)
			{
			if(currentpos-scrollfluc<endpoint)	
				{
				if(brname=="fire")
					window.scroll(0,endpoint)
				else if(brname=="ie")
					document.documentElement.scrollTop=endpoint
				else
					document.body.scrollTop=endpoint
				}
			else
				{
				if(brname=="fire")
					window.scroll(0,window.pageYOffset-scrollfluc)
				else if(brname=="ie")
					document.documentElement.scrollTop=document.documentElement.scrollTop-scrollfluc
				else
					document.body.scrollTop=document.body.scrollTop-scrollfluc
				}
			tmr=setTimeout("animateScroll()",50)
			}
		}
	}


function getCurrentScrollPos()
	{
	if(brname=="fire")
		return window.pageYOffset;
	else if(brname=="ie")
		return document.documentElement.scrollTop;
	else
		return document.body.scrollTop;
	}


function getOverallDocHeight()
	{
	if(brname=="fire")
		return document.body.offsetHeight-window.innerHeight;
	else if(brname=="ie")
		return document.documentElement.scrollHeight-document.documentElement.clientHeight;
	else
		return document.body.offsetHeight-window.innerHeight;
	}
	
