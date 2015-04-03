var introspect = function(target) {
    var prop_list = "",
    prop_name;

    for (prop_name in target) {
        if (typeof(target[prop_name]) != "undefined") {
            prop_list += (prop_name + ", ");
        }
    }

    return prop_list;
};

(function($) {
    $(function() {
        function bind_cart() {
            $('#mini_shopping_cart form').ajaxForm({
                'target': '#mini_cart',
                'success': function(response, status, xhr, form) {
                    bind_cart();
                }
            });

            $('#reset-action').bind('click', function() {
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('href'),
                    success: function(result, status) {
                        $('#mini_cart').html(result);
                        bind_cart();
                    }
                });
                return false;
            });

            $('#ship-button').bind('click', function() {
                $.ajax({
                    type: 'POST',
                    url: '/cart/reset_cart/', //$(this).attr('href'),
                    success: function(result, status) {
                        $('#mini_cart').html(result);
                        bind_cart();
                        return false;
                    }
                });
            });
        }

        /*$('#buyit-dialog').dialog({
            autoOpen: false,
            //height: 300,
            minHeight: 0,
            width: 250,
            modal: true,
            buttons: {},
            close: function() {
                $("#buyit-form").resetForm();
            }
        });*/

        $('#buyit-form').ajaxForm({
            'target': '#mini_cart',
            'success': function(response, status, xhr, form) {
                bind_cart();
            }
        });

        bind_cart();

        $("div.product_box_foto a").each(function(key, element) {
            $(element).fancybox({
                'titlePosition' : 'over',
                'transitionIn'	: 'elastic',
                'transitionOut'	: 'elastic',
                'easingIn'      : 'easeOutBack',
                'easingOut'     : 'easeInBack',
                'speedIn'       : 500,
                'speedOut'      : 300
            });
        });

        $('#payment-options input').bind('click', function() {
            var target = $(this).attr('class');
            $('#payment-mask').html($('#'+target+'-mask').clone());
        });
    });
})(jQuery);
