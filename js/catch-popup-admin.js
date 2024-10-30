jQuery(function($) {

    var count;
    // Tabs
    $('.catch-popup-container .vtab .nav-tab-wrapper a').on('click', function(e){
        e.preventDefault();

        if( ! $(this).hasClass('nav-tab-active') ) {
            $('.vnav-tab').removeClass('nav-tab-active');
            $('.verticaltab').removeClass('active').hide(0);

            $(this).addClass('nav-tab-active');

            var anchorAttr = $(this).attr('href');

            $(anchorAttr).addClass('active').show();
        }

    });

    $('.catch-popup-container .htab .nav-tab-wrapper a').on('click', function(e){
        e.preventDefault();

        if( !$(this).hasClass('nav-tab-active') ) {
            $('.verticaltab.active .hnav-tab').removeClass('nav-tab-active');
            $('.verticaltab.active .horizontaltab').removeClass('active').hide(0);

            $(this).addClass('nav-tab-active');

            var anchorAttr = $(this).attr('href');

            $(anchorAttr).addClass('active').show(500);
        }

    });

    // jQuery UI Tooltip initializaion
    $(document).ready(function() {
        $('.tooltip').tooltip();
    });

    /* Range Controller */
    $('input[type=range]').on('input change', function () {
        $(this).next('input[type=number]').val($(this).val());
    });

    $('input[type=number]').on('input change', function () {
        $(this).prev('input[type=range]').val($(this).val());
    });

    /* Popup size */
    $('[name="popup[catch_popup_size]"]').on('change', function(){
        //console.log($('[name="popup[catch_popup_auto_height]"]').val());
        if( 'auto' == $(this).val() ) {
            $('[name="popup[catch_popup_min_width]"').parent().hide();
            $('[name="popup[catch_popup_max_width]"').parent().hide();
            $('[name="popup[catch_popup_width]"').parent().hide();
            $('[name="popup[catch_popup_auto_height]"').parent().hide();
            $('[name="popup[catch_popup_height]"').parent().hide();
        } else if( 'custom' == $(this).val() ) {
            $('[name="popup[catch_popup_min_width]"').parent().show();
            $('[name="popup[catch_popup_max_width]"').parent().show();
            $('[name="popup[catch_popup_width]"').parent().show();
            $('[name="popup[catch_popup_auto_height]"').parent().show();
            console.log($('[name="popup[catch_popup_auto_height]"]').val());
            if( 1 == $('[name="popup[catch_popup_auto_height]"]').val() ){
                $('[name="popup[catch_popup_height]"').parent().hide();
            }else{
                $('[name="popup[catch_popup_height]"').parent().show();
            }
            
        } else {
            $('[name="popup[catch_popup_min_width]"').parent().show();
            $('[name="popup[catch_popup_max_width]"').parent().show();
            $('[name="popup[catch_popup_width]"').parent().hide();
            $('[name="popup[catch_popup_auto_height]"').parent().hide();
            $('[name="popup[catch_popup_height]"').parent().hide();
        }
    });

    /* Popup Delay */
    $('[name="popup[catch_popup_style]"').on('change', function(){
        if( 'click' == $(this).val() ) {
            $('[name="popup[catch_popup_delay]"').parent().hide();
        } else {
            $('[name="popup[catch_popup_delay]"').parent().show();
        }
    });

    /* Popup size */
    $('[name="popup[catch_popup_auto_height]"]').on('change', function(){
        if( $(this).is(":checked") ) {
            $('[name="popup[catch_popup_height]"').parent().hide();
        } else {
            $('[name="popup[catch_popup_height]"').parent().show();
        }
    });

    /* Location */
    $('[name="popup[catch_popup_location]"]').on('change', function(){
        if( 'topleft' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().show();
            $('[name="popup[catch_popup_left]"').parent().show();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'topcenter' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().show();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'topright' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().show();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().show();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'middleleft' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().show();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'middlecenter' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'middleright' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().show();
            $('[name="popup[catch_popup_bottom]"').parent().hide();
        } else if( 'bottomleft' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().show();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().show();
        } else if( 'bottomcenter' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().hide();
            $('[name="popup[catch_popup_bottom]"').parent().show();
        } else if( 'bottomright' == $(this).val() ) {
            $('[name="popup[catch_popup_top]"').parent().hide();
            $('[name="popup[catch_popup_left]"').parent().hide();
            $('[name="popup[catch_popup_right]"').parent().show();
            $('[name="popup[catch_popup_bottom]"').parent().show();
        }
    });

    $('[name="popup_theme[close_button_location]"]').on('change', function(){
        if( 'topleft' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().show();
            $('[name="popup_theme[close_button_left]"').parent().show();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'topcenter' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().show();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'topright' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().show();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().show();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'middleleft' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().show();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'middlecenter' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'middleright' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().show();
            $('[name="popup_theme[close_button_bottom]"').parent().hide();
        } else if( 'bottomleft' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().show();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().show();
        } else if( 'bottomcenter' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().hide();
            $('[name="popup_theme[close_button_bottom]"').parent().show();
        } else if( 'bottomright' == $(this).val() ) {
            $('[name="popup_theme[close_button_top]"').parent().hide();
            $('[name="popup_theme[close_button_left]"').parent().hide();
            $('[name="popup_theme[close_button_right]"').parent().show();
            $('[name="popup_theme[close_button_bottom]"').parent().show();
        }
    });
    
    $('#catch-popup-targeting').on('change', '.target-condition', function(){
        var $this = $(this);
        var selected_value = $(this).val();
        switch( selected_value ) {
            case 'category-post':
            target = 'categories';
            break;
            case 'tag-post':
            target = 'tags';
            break;
            case 'select-post':
            target = 'posts';
            break;
            case 'select-page':
            case 'ancestor-page':
            case 'child-page':
            target = 'pages';
            break;
            default:
            target='';
            break;
        }
    
        if( target == '' ){
            $this.next('.dynamic-populate').hide();
            $this.next('.dynamic-populate').next('.chosen-container').hide();
            return;
        }


        var data = {
            'action': 'catch_popup_get_data',
            'target': target
        };
        $.post(ajaxurl, data, function(response) {
            $this.next('.dynamic-populate').html('');
            var options = [];
            var string = '';
                $.each(JSON.parse(response), function(key, value){
                    var temp = [];  
                    if( undefined == value.name ){
                        temp[value.id] = value.title.rendered
                        string += '<option value="' + value.id + '">' + value.title + '</option>';
                    }
                
                    var filtered = temp.filter(function (el) {
                        return el != null;
                    });
                    
                    options.push(filtered);
                });
            $this.next('.dynamic-populate').append(string);
            $this.next('.dynamic-populate').next('.chosen-container').show();
            $this.next('.dynamic-populate').trigger('chosen:updated');
            $this.next('.dynamic-populate').chosen();
        });

    });

    $(function(){
        var i = 0;
        var string;
        count = $('.target_value').length;
        $('.add_more').on('click', function(){
            if( count == 0 ) {
                string = $('.or').html();
            } else {
                string = $('.condition-wrap').html() + $('.or').html();
            }
            $(this).before('<div class="more-conditional" style="display: inline-block;">' + string + '</div>' + '<span class="remove-conditional"><span class="dashicons dashicons-no"></span>Remove</span><br />');
            i++;
            count++;
        });
    });

    $('#catch-popup-targeting').on('click', '.remove-conditional', function(e){
        $(this).parent('.target_value').remove();
        $(this).prev('.more-conditional').remove();
        $(this).next('br').remove();
        $(this).remove();
        count--;
    });


    $('#catch-popup-targeting').on('change', '.dynamic-populate', function(e){
        var value = $(this).chosen().val();
        if( null != value ) {
            $(this).next('div').next('.target-text').html(value.toString());
        } else {
            $(this).next('div').next('.target-text').html('');
        }
    });

    $(window).on('load', function(){
        $('#catch-popup-targeting .target-condition').each(function(){
            var $this = $(this);
            var selected_value = $(this).val();
            switch( selected_value ) {
                case 'category-post':
                target = 'categories';
                break;
                case 'tag-post':
                target = 'tags';
                break;
                case 'select-post':
                target = 'posts';
                break;
                case 'select-page':
                case 'ancestor-page':
                case 'child-page':
                target = 'pages';
                break;
                default:
                target='';
                break;
            }
            if( target == '' ){
                $this.next('.dynamic-populate').hide();
                $this.next('.dynamic-populate').next('.chosen-container').hide();
                return;
            }

            var data = {
                'action': 'catch_popup_get_data',
            'target': target
            };
            $.post(ajaxurl, data, function(response) {
                $this.next('.dynamic-populate').html('');
                var options = [];
                var string = '';
                var option_str;
                    
                    $.each(JSON.parse(response), function(key, value){
                        var temp = [];
                        
                        var selected_title = '';
                            temp[value.id] = value.title
                            for( i=0; i<cpop_object.settings.catch_popup_target_text.length; i++){
                                $.each(cpop_object.settings.catch_popup_target_text[i].split(','), function(k,v){
                                    if( v == value.id ){
                                        selected_title = 'selected';
                                    }
                                
                                option_str = '<option value="' + value.id + '" ' + selected_title + '>' + value.title + '</option>';
                                if(string.indexOf(option_str) == -1){
                                    string += option_str;
                                } 
                            });
                            }              
                        
                        var filtered = temp.filter(function (el) {
                            return el != null;
                        });
                        options.push(filtered);
                    });
                $this.next('.dynamic-populate').append(string);
                $this.next('.dynamic-populate').next('.chosen-container').show();
                $this.next('.dynamic-populate').trigger('chosen:updated');
                $this.next('.dynamic-populate').chosen();
            });
        });
    });

    $(window).on('load', function(){
        $('#publish').on('click', function(){
            if( $('.condition-wrap').attr('rel') == 'placeholder' ) {
                $('.condition-wrap').remove();
            }
            if( $('.or').attr('rel') == 'placeholder' ) {
                $('.or').remove();
            }
        });
        $('.components-button.editor-post-publish-button.is-button.is-default.is-primary.is-large').on('click', function(){
            if( $('.condition-wrap').attr('rel') == 'placeholder' ) {
                $('.condition-wrap').remove();
            }
            if( $('.or').attr('rel') == 'placeholder' ) {
                $('.or').remove();
            }
        })
    });

});