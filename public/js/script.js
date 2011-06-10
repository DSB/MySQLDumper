// Tooltips
ShowTooltip = function(e)
{
    var text = $(this).next('.tooltip-text');
    if (text.attr('class') != 'tooltip-text')
        return false;

    text.delay(200)
        .fadeIn(300)
        .css('top', e.pageY+16)
        .css('left', e.pageX+16);

    return false;
}
HideTooltip = function(e)
{
    var text = $(this).next('.tooltip-text');
    if (text.attr('class') != 'tooltip-text')
        return false;

    text.clearQueue().hide(0);
}

SetupTooltips = function()
{
    $('.tooltip')
        .each(function(){
            $(this)
                .after($('<span class="tooltip"/>')
                .attr('class', 'tooltip-text')
                .html($(this).attr('title').replace(/\n/g, '<br />')))
                .attr('title', '');
        })
        .hover(ShowTooltip, HideTooltip);
}

// enable one object
function obj_enable(objid) {
      if ($(objid))
          $(objid).removeAttr('disabled');
}
// disable one object
function obj_disable(objid) {
      if ($(objid))
            $(objid).attr('disabled', 'disabled');
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

function setVal(id, value) {
      $(id).value = value;
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

function getLog(requestUri) {
    jQuery.ajax({
          url: requestUri,
          beforeSend: function() {
              $('.ajax-reload').show();
          },
          success: function(data) {
              $('#ilog').html(data);
          },
          error: function(data) {
              $('#ilog').html(data);
          },
          complete: function() {
              $('.ajax-reload').hide();
          }
    });
}

function setOpacity(domElement, value) {
    $(domElement).css({ opacity: value });
}

function setPageInactive() {
    setOpacity("body", 0.3);
    $('#page-loader').show();
}
addEvent(window, 'beforeunload', setPageInactive);
$(document).ready(function () {
    getNewWindowLinks();
    setOpacity("body", 1);
    $('#page-loader').hide();
});

// Check all selected checkboxes (selection is done via parameter "selector").
// "selector" must be a jQuery seletor. See http://api.jquery.com/category/selectors/
function checkAll(selector)
{
    $(selector).attr('checked', 'checked');
}
// Same as above, but it removes the selection.
function unCheckAll(selector)
{
    $(selector).removeAttr('checked');
}

function hasCheckedElements(selector) {
    return $(selector + ':checked').size() > 0 ? true:false;
}

/** Mouse over functions for tabs, which don't use jquery.ui.tabs (static page requests without AJAX) */
function tabOver(selector)
{
    $(selector).addClass("ui-state-active");
}
function tabOut(selector)
{
    $(selector).removeClass("ui-state-active");
}

/* Changes the action url of a form, found by a selector. */
function changeFormAction(selector, targetUrl)
{
    $(selector).get(0).setAttribute('action', targetUrl);
}