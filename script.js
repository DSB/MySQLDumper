var NS = (document.layers);
var IE = (document.all);

//Filemanagement
function GetSelectedFilename()
{
	var a="";
	var obj=document.getElementsByName("file[]");
	var anz=0;
	if(!obj.length) 
	{
		if(obj.checked){a=obj.value;}
	} 
	else 
	{
		for (i=0; i<obj.length; i++)
		{
 				if(obj[i].checked){a=obj[i].value;anz++;}
		}
	}
	return a;
}

function Check(i,k)
{
	var anz=0;
	var s="";
	var smp;
	
	
	var ids=document.getElementsByName("file[]");
	var mp=document.getElementsByName("multipart[]");
	
	for(var j=0; j<ids.length; j++) {
   		if(ids[j].checked)
		{ s=ids[j].value;
		  smp= (mp[j].value==0) ? "" : " (Multipart: "+mp[j].value+" files)";
		  anz++;
		  if(k==0) break;
		}
	}
	if(anz==0) {
		WP("","gd");
	} else if (anz==1) {
		WP(s+smp,"gd");
	} else {WP("more than 1 file selected","gd");}
	
}
//config

function SelectMD(v,anz)
{
	for (i = 0; i < anz; i++) {
		n="db_multidump_" + i;
		obj=document.getElementsByName(n)[0];
		if(obj) {
			obj.checked=v; 
		}
	}
	
}

//tabellenabfrage
function Sel(v)
{
	var a=document.frm_tbl;
	if(!a.chk_tbl.length) 
	{
		a.chk_tbl.checked = v;
	} else {
		for (i = 0; i < a.chk_tbl.length; i++) {
			a.chk_tbl[i].checked = v;
		}
	}
}


function ConfDBSel(v,adb)
{
	for (i = 0; i < adb; i++) {
		var a=document.getElementsByName("db_multidump["+i+"]");
		if(a) a.checked = v;
	}
}

function chkFormular()
{
	var a=document.frm_tbl;
	a.tbl_array.value="";
	
	if(!a.chk_tbl.length) 
	{
		if(a.chk_tbl.checked==true) 
				a.tbl_array.value += a.chk_tbl.value + "|";
	} else {
		for (i = 0; i < a.chk_tbl.length; i++) {
			if(a.chk_tbl[i].checked==true) 
				a.tbl_array.value += a.chk_tbl[i].value + "|";
		}
	}
	if(a.tbl_array.value==""){
		alert("Ohne Tabellen geht es nicht :)");
		return false;
	} else {
		//alert(a.tbl_array.value);
		return true;
	}
}

function insertHTA(s,tb)
{
	if(s==1) ins="AddHandler php-fastcgi .php .php4\nAddhandler cgi-script .cgi .pl\nOptions +ExecCGI";
	
	if(s==101) ins="DirectoryIndex /cgi-bin/script.pl" 
	if(s==102) ins="AddHandler cgi-script .extension";
	if(s==103) ins="Options +ExecCGI";
	if(s==104) ins="Options +Indexes";
	if(s==105) ins="ErrorDocument 400 /errordocument.html";
	if(s==106) ins="# (macht aus http://domain.de/xyz.html ein\n# http://domain.de/main.php?xyz)\nRewriteEngine on\nRewriteBase  /\nRewriteRule  ^([a-z]+)\.html$ /main.php?$1 [R,L]";
	if(s==107) ins="Deny from IPADRESS\nAllow from IPADRESS";
	if(s==108) ins="Redirect /service http://foo2.bar.com/service";
	if(s==109) ins="ErrorLog /path/logfile"
	tb.value+="\n"+ins;
}


//restore
function WP(s,obj) {
	//if(IE)
		//alert(obj);
		document.getElementById(obj).innerHTML=s;
	/*else
		document.layers[obj].document.open();
		document.layers[obj].document.write s;
		document.layers[obj].document.close();
	*/
}	

function resizeSQL(i){
	
	var obj=document.getElementById("tb_sql");
	
	if(IE) {
		//alert("IE");
		if(i==0) obj.style.pixelHeight=4;
		if(i==1 && obj.style.pixelHeight>23) obj.style.pixelHeight=obj.style.pixelHeight - 20;
		if(i==2) obj.style.pixelHeight=obj.style.pixelHeight + 40;
	} else {
		//alert("not IE");
		if(i==0) obj.style.height=4;
		if(i==1) obj.style.height=20;
		if(i==2) obj.style.height=240;
	}
}

function GetSQLHeight() {
	var obj=document.getElementById("tb_sql");
	if(IE) {
		return obj.style.pixelHeight;
	} else {
		return obj.style.height;
	}
}