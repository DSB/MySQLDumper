// enable one object
function obj_enable(objid) {
      if ($(objid))
            $(objid).disabled = false;
}
// disable one object
function obj_disable(objid) {
      if ($(objid))
            $(objid).disabled = true;
}
// enable array of objects
function objs_enable(objids) {
      for (i = 0; i < objids.length; i++) {
            obj_enable(objids[i]);
      }
}
// disable array of objects
function objs_disable(objids) {
      for (i = 0; i < objids.length; i++) {
            obj_disable(objids[i]);
      }
}
// enable/disable object-array depending on current state of one checkbox or
// radio button
function obj_toggle(obj, objects_to_toggle) {
      var disable = true;
      if ((obj.type == "checkbox") || (obj.type == "radio")) {
            if (obj.checked) {
                  disable = false;
            }
      }
      for (i = 0; i < objects_to_toggle.length; i++) {
            document.getElementById(objects_to_toggle[i]).disabled = disable;
      }
}
// slide down DIV
function mySlideDown(objid) {
      if (document.getElementById(objid).style.display == 'none') {
            new Effect.SlideDown(objid, {
                  duration : .5
            });
      }
}
// slide up DIV
function mySlideUp(objid) {
      if (document.getElementById(objid).style.display != 'none') {
            new Effect.SlideUp(objid, {
                  duration : .5
            });
      }
}
// slide DIV up or down depending on current state
function mySlide(objid) {
      if (document.getElementById(objid).style.display != 'none') {
            mySlideUp(objid);
      } else {
            mySlideDown(objid);
      }
}

// jQuery Slide Togle
function slide(element) {
      jQuery(element).slideToggle();
}

// get list of selected file/s
function GetSelectedFilename() {
      var a = "";
      var obj = document.getElementsByName("file[]");
      var anz = 0;
      if (!obj.length) {
            if (obj.checked) {
                  a += obj.value;
            }
      } else {
            for (i = 0; i < obj.length; i++) {
                  if (obj[i].checked) {
                        a += "\n" + obj[i].value;
                        anz++;
                  }
            }
      }
      return a;
}
// build message with selected file/s
function SetSelectedFile(i, k) {
      var anz = 0;
      var s = "";
      var smp;
      var ids = document.getElementsByName("file[]");
      var mp = document.getElementsByName("multipart[]");
      for ( var j = 0; j < ids.length; j++) {
            if (ids[j].checked) {
                  s = ids[j].value;
                  smp = (mp[j].value == 0) ? "" : " (Multipart: " + mp[j].value + ")";
                  anz++;
                  if (k == 0)
                        break;
            }
      }
      if (anz == 0) {
            WP("", "gd");
      } else if (anz == 1) {
            WP(s + smp, "gd");
      } else {
            WP("> 1", "gd");
      }
}
function SelectMD(v, anz) {
      for (i = 0; i < anz; i++) {
            n = "db_multidump_" + i;
            obj = document.getElementsByName(n)[0];
            if (obj) {
                  obj.checked = v;
            }
      }
}
function checkAllCheckboxes(formName, check) {
      var form = $(formName);
      var i = form.getElements('checkbox');
      if (check) {
            i.each(function(item) {
                  item.checked = true;
            });
      } else {
            i.each(function(item) {
                  item.checked = false;
            });
      }
}
function setVal(id, value) {
      $(id).value = value;
}
// Check if a checkbox of the given form is checked - returns true or false
function tablesChecked(formName) {
      var form = $(formName);
      var i = form.getElements('checkbox');
      var checked = false;
      i.each(function(item) {
            if (item.checked == true)
                  checked = true;
      });
      return checked;
}

function WP(s, obj) {
      document.getElementById(obj).innerHTML = s;
}
function resizeSQL(i) {
      var obj = $('sqltextarea');
      var h = 0;
      if (i == 0) {
            s = '4';
      } else {
            if (i == 1)
                  h = -30;
            if (i == 2)
                  h = 30;
            var oh = obj.style.height;
            var s = Number(oh.substring(0, oh.length - 2)) + h;
            if (s < 24)
                  s = 24;
      }
      obj.morph('height:' + s + 'px', {
            duration : 0.5
      });
}
function InsertLib(i) {
      var obj = document.getElementsByName('sqllib')[0];
      if (obj.selectedIndex > 0) {
            document.getElementById('sqlstring' + i).value = obj.options[obj.selectedIndex].value;
            document.getElementById('sqlname' + i).value = obj.options[obj.selectedIndex].text;
      }
}
function DisplayExport(s) {
      document.getElementById("export_working").InnerHTML = s;
}
function SelectedTableCount() {
      var obj = document.getElementsByName('f_export_tables[]')[0];
      var anz = 0;
      for ( var i = 0; i < obj.options.length; i++) {
            if (obj.options[i].selected) {
                  anz++;
            }
      }
      return anz;
}
function SelectTableList(s) {
      var obj = document.getElementsByName('f_export_tables[]')[0];
      for ( var i = 0; i < obj.options.length; i++) {
            obj.options[i].selected = s;
      }
}
function hide_csvdivs(i) {
      document.getElementById("csv0").style.display = 'none';
      if (i == 0) {
            document.getElementById("csv1").style.display = 'none';
            document.getElementById("csv4").style.display = 'none';
            document.getElementById("csv5").style.display = 'none';
      }
}
function check_csvdivs(i) {
      hide_csvdivs(i);
      if (document.getElementById("radio_csv0").checked) {
            document.getElementById("csv0").style.display = 'block';
      }
      if (i == 0) {
            if (document.getElementById("radio_csv1").checked) {
                  document.getElementById("csv1").style.display = 'block';
            } else if (document.getElementById("radio_csv2").checked) {
                  document.getElementById("csv1").style.display = 'block';
            } else if (document.getElementById("radio_csv4").checked) {
                  document.getElementById("csv4").style.display = 'block';
            } else if (document.getElementById("radio_csv5").checked) {
                  document.getElementById("csv5").style.display = 'block';
            }
      }
}

/* target="_blank" for links */
/*
 * addEvent function from
 * http://www.quirksmode.org/blog/archives/2005/10/_and_the_winner_1.html
 */
function addEvent(obj, type, fn) {
      if (obj.addEventListener)
            obj.addEventListener(type, fn, false);
      else if (obj.attachEvent) {
            obj["e" + type + fn] = fn;
            obj[type + fn] = function() {
                  obj["e" + type + fn](window.event);
            }
            obj.attachEvent("on" + type, obj[type + fn]);
      }
}

function removeEvent(obj, type, fn) {
      if (obj.removeEventListener)
            obj.removeEventListener(type, fn, false);
      else if (obj.detachEvent) {
            obj.detachEvent("on" + type, obj[type + fn]);
            obj[type + fn] = null;
            obj["e" + type + fn] = null;
      }
}

/* Create the new window */
function openInNewWindow(e) {
      var event;
      if (!e)
            event = window.event;
      else
            event = e;
      // Abort if a modifier key is pressed
      if (event.shiftKey || event.altKey || event.ctrlKey || event.metaKey) {
            return true;
      } else {
            // Change "_blank" to something like "newWindow" to load all links in
            // the same new window
            var newWindow = window.open(this.getAttribute('href'), '_blank');
            if (newWindow) {
                  if (newWindow.focus) {
                        newWindow.focus();
                  }
                  return false;
            }
            return true;
      }
}

/*
 * Add the openInNewWindow function to the onclick event of links with a class
 * name of "new-window"
 */
function getNewWindowLinks() {
      // Check that the browser is DOM compliant
      if (document.getElementById && document.createElement
            && document.appendChild) {
            // Change this to the text you want to use to alert the user that a new
            // window will be opened
            var strNewWindowAlert = "";
            // Find all links
            var links = document.getElementsByTagName('a');
            var objWarningText;
            var link;
            for ( var i = 0; i < links.length; i++) {
                  link = links[i];
                  // Find all links with a class name of "non-html"
                  if (/\bnew-window\b/.test(link.className)) {
                        // Create an em element containing the new window warning text
                        // and insert it after the link text
                        objWarningText = document.createElement("span");
                        objWarningText.appendChild(document
                              .createTextNode(strNewWindowAlert));
                        link.appendChild(objWarningText);
                        link.onclick = openInNewWindow;
                  }
            }
            objWarningText = null;
      }
}

addEvent(window, 'load', getNewWindowLinks);

// get log by ajax request
function get_log(details) {
      var ret = jQuery.ajax({
            url: 'ajax/show_log_entry.php?'+details,
            beforeSend: function() {
                  jQuery('.ajax-reload').show();
            },
            success: function(data) {
                  jQuery('#ilog').html(data);
                  jQuery('.ajax-reload').hide();
            },
            error: function() {
		var g = new Growler({location:'right', width:"650px"});
		g.growl("There was an error while log request. Please reload this page.", {header:"<strong>Error<\/strong>:", className:"message",life: 4, speedin: 1.2 });
            }
      }).responseText;

      return false;
}