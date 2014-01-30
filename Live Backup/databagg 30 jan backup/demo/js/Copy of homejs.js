var activeobj; var tmr; var scrollpos=0; var endpoint=0; var scrollfluc=100; var scrollmode="+"; var lastcompleted=true;
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
	endpoint=obj.offsetTop-100; //findPosY(obj)-100
	scrollpos=document.body.scrollTop;

	if(endpoint<scrollpos)
		{
		scrollmode="-";
		scrollfluc=Math.round((scrollpos-endpoint)/10)
		}
	else
		{
		scrollmode="+";
		scrollfluc=Math.round((endpoint-scrollpos)/10)
		}


	animateScroll()	
	}

function animateScroll()
	{
	var scrollpos=document.body.scrollTop
	var currentpos=document.body.scrollTop
	if(scrollmode=="+")
		{
		if(scrollpos<endpoint)
			{
			if(currentpos+scrollfluc>endpoint)
				document.body.scrollTop=endpoint
			else
				document.body.scrollTop=document.body.scrollTop+scrollfluc
			tmr=setTimeout("animateScroll()",50)
			}
		}
	else if(scrollmode=="-")
		{
		if(scrollpos>endpoint)
			{
			if(currentpos-scrollfluc<endpoint)
				document.body.scrollTop=endpoint
			else
				document.body.scrollTop=document.body.scrollTop-scrollfluc
			tmr=setTimeout("animateScroll()",50)
			}
		}
	}