/**
 * Created by JetBrains PhpStorm.
 * User: Darky
 * Date: 04.06.11
 * Time: 19:24
 * To change this template use File | Settings | File Templates.
 */
(function( $ ) {
$.widget( "ui.combobox", {
    _create: function() {
        var self = this,
            select = this.element.hide(),
            selected = select.children( ":selected" ),
            value = selected.val() ? selected.text() : "";
        var input = this.input = $( "<input>" )
            .insertAfter( select )
            .val( value )
            .autocomplete({
                delay: 0,
                minLength: 0,
                source: function( request, response ) {
                    var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
                    response( select.children( "option" ).map(function() {
                    var text = $( this ).text();
                    if ( this.value && ( !request.term || matcher.test(text) ) )
                        return {
                            label: text.replace(
                                new RegExp(
                                    "(?![^&;]+;)(?!<[^<>]*)(" +
                                    $.ui.autocomplete.escapeRegex(request.term) +
                                    ")(?![^<>]*>)(?![^&;]+;)", "gi"
                                ), "<strong>$1</strong>" ),
                                value: text,
                                option: this
                            };
                    }) );
                },
                select: function( event, ui ) {
                    ui.item.option.selected = true;
                    self._trigger( "selected", event, {
                        item: ui.item.option
                    });
                    select.trigger('change');
                },
                change: function( event, ui ) {
                                        //window.location = '';
                    if ( !ui.item ) {
                        var matcher = new RegExp( "^" + $.ui.autocomplete.escapeRegex( $(this).val() ) + "$", "i" );
                        var valid = false;
                        select.children( "option" ).each(function() {
                            if ( $( this ).text().match( matcher ) ) {
                                this.selected = valid = true;
                                return false;
                            }
                        });
                        if ( !valid ) {
                            // remove invalid value, as it didn't match anything
                            $( this ).val( "" );
                            select.val( "" );
                            input.data( "autocomplete" ).term = "";
                            return false;
                        }
                        select.trigger('change');
                    }
                }
            })
            .addClass( "ui-widget ui-widget-content ui-corner-left" );
            input.data( "autocomplete" )._renderItem = function( ul, item ) {
                return $( "<li></li>" )
                .data( "item.autocomplete", item )
                .append( "<a>" + item.label + "</a>" )
                .appendTo( ul );
            };
            input.bind('keyup', function(event) {
                if (event.keyCode && (event.keyCode == 13 || event.keyCode == 10)) {
                    input.trigger('change');
                } else if (event.which && (event.which == 13 || event.which == 10)) {
                    input.trigger('change');
                }
            });

            this.button = $( "<button type='button'>&nbsp;</button>" )
            .attr( "tabIndex", -1 )
            .attr( "title", "Show All Items" )
            .insertAfter( input )
            .button({
                icons: {
                    primary: "ui-icon-triangle-1-s"
                },
                text: false
            })
            .removeClass( "ui-corner-all" )
            .addClass( "ui-corner-right ui-button-icon" )
            .click(function() {
                // close if already visible
                if ( input.autocomplete( "widget" ).is( ":visible" ) ) {
                    input.autocomplete( "close" );
                    return;
                }

                // work around a bug (likely same cause as #5265)
                $( this ).blur();

                // pass empty string as value to search for, displaying all results
                input.autocomplete( "search", "" );
                input.focus();
            });
        },

        destroy: function() {
            this.input.remove();
            this.button.remove();
            this.element.show();
            $.Widget.prototype.destroy.call( this );
        }
    });
})( jQuery );
