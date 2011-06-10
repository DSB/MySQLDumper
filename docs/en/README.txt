$Id$

MySQLDumper - Readme
====================

  MySQLDumper is a PHP and Perl based tool for backing up MySQL databases.
  You can easily dump your data into a backup file and - if needed - restore it.
  It is especially suited for shared hosting webspaces, where you don't have
  shell access.

  Version 1.25
  ---------------
  http://www.MySQLDumper.net/

	Copyright (C) 2004-2010 Daniel Schlichtholz (admin@MySQLDumper.de) and more
	
	This program is free software; you can redistribute it and/or modify it under 
	the terms of the GNU General Public License as published by the Free Software 
	Foundation; either version 2 of the License, or (at your option) any later 
	version.
	
	This program is distributed in the hope that it will be useful, but WITHOUT 
	ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS 
	FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more 
	details.
	
	You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	
	
  Requirements:
    PHP 4 or later
    MySQL 4.1 or later
    a web-browser
    optional Perl for cronscript

  Summary:
	The problem:
	A PHP script has a maximum execution time that is usually set to 30 seconds on
	most server installations. A script running longer than this limit will simply
	stop working. This behavior makes backing up large databases impossible. Maybe
	you already had this specific problem when using other tools.
	
	MySQLDumper uses a proprietary technique to avoid this problem. It only reads
	and saves a certain amount of data, then calls itself recursively via JavaScript
	and remembers how far in the backup process it was. The script then resumes
	backing up from that point.
	
	The restore process is similar. Unlike other tools, splitting and splicing of
	large backup files is no longer necessary.
	
	MySQLDumper can write the data directly into a compressed .gz file. The restore
	script is able to read this file directly without unpacking it. You can also
	use the script without compression, but using Gzip saves a lot of bandwidth.
	You can even configure the script to automatically send the backup file to an
	FTP account or your email adress. 

  Download:
    You can get the newest version at http://www.MySQLDumper.net/

  Credits:
    Please see http://www.MySQLDumper.net/credits/

  Installation:
    Please see the install_english.txt file.

  Security:
  	To protect MySQLDumper, you have to create a directory protection. Point your web
  	browser to your MySQLDumper installation and push the button 'Create
  	directory protection' (works only with apache) or create it manually
  
  Changelog:
    Please see changelog_english.txt

  Support:
    See support forum under http://forum.MySQLDumper.de/
    
   Enjoy!
    The MySQLDumper team