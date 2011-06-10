<script type="text/javascript">
/*<![CDATA[*/
	Event.observe(window, 'load', loadTabs, false);
	function loadTabs() 
	{
	  var tabs = new tabset('config'); // name of div to crawl for tabs and panels
	  tabs.autoActivate($('tab_db')); // name of tab to auto-select if none exists in the url
	}
	/* make sure to reopen the same panel after reloading */
	function correctFormAction()
	{
	   var divs=['db','general','interface','autodelete','email','ftp',
	           'cronscript','configfiles'];
	   for (var i=0;i<divs.length;i++)
	   {
	       var d='panel_'+divs[i];
	       if ($(d).style.display!='none') 
	       {
	           var target=$('config_form').action;
	           $('config_form').action=target+'#'+divs[i];
	       }
	   }
	}
/*]]>*/
</script>

<div id="content">
<h2>{L_CONFIG_HEADLINE}: {CONFIGURATION_NAME} <span class="small">({L_MSD_MODE}: {MSD_MODE})</span></h2>
<form method="post" action="index.php?p=config" id="config_form" onsubmit="correctFormAction()">

<div id="config">
	<input type="hidden" name="sel" id="sel" value="db" />
	<input type="hidden" name="save" />
	<ul class="Formbutton" id="tabnav">
		<li><a href="#tab_db" id="tab_db" class="tab Formbutton">{L_DBS}</a></li>
		<li><a href="#tab_general" id="tab_general" class="tab Formbutton">{L_GENERAL}</a></li>
		<li><a href="#tab_interface" id="tab_interface" class="tab Formbutton">{L_CONFIG_INTERFACE}</a></li>
		<li><a href="#tab_autodelete" id="tab_autodelete" class="tab Formbutton">{L_CONFIG_AUTODELETE}</a></li>
		<li><a href="#email" id="tab_email" class="tab Formbutton">{L_EMAIL}</a></li>
		<li><a href="#ftp" id="tab_ftp" class="tab Formbutton">{L_FTP}</a></li>
		<li><a href="#cronscript" id="tab_cronscript" class="tab Formbutton">{L_CRONSCRIPT}</a></li>
		<li><a href="#configfiles" id="tab_configfiles" class="tab Formbutton">{L_CONFIGFILES}</a></li>
	</ul>
</div>

<div>
