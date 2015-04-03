(function($) {
    $(function() {
        function bind_actions(target) {
            $(target+' form').ajaxForm({
                'target': target,
                'success': function(response, status, xhr, form) {
                    bind_actions(target);
                }
            });

            $(target+' .link-action').bind('click', function(event) {
                var url = $(this).attr('href');

                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(result, status) {
                        $(target).html(result);
                        bind_actions(target);
                    }
                });

                return false;
            });

            bind_del($('.del-form'));
        }

        bind_actions('#workspace');

        $(".accordion").accordion({
            autoHeight: false,
            collapsible: true,
            navigation: true
        });

        var target;

        $('#acl-workspace .accordion form').ajaxForm({
            'success': function(response, status, xhr, form) {
                //$(target).next().effect("highlight", {}, 'slow');
                var orig = $(target).parent().css('background-color');
                $(target).parent().animate({
                    backgroundColor: '#FFFF78'
                }, 'normal', 'linear'/*'swing'*/, function() {
                    $(this).animate({
                        backgroundColor: orig
                    });
                }
                );
            }
        });

        $('#acl-workspace .accordion input[type="checkbox"]').bind('click', function(event) {
            target = this;
            $(this).trigger('submit');
        });

        $('#group-view .ren-form').ajaxForm({
            'success': function(response, status, xhr, form) {

            }
        });

        function bind_del(element) {
            element.ajaxForm({
                'success': function(response, status, xhr, form) {
                    var id = $('input[type="hidden"]', form).val();
                    form.parent().parent().fadeOut('slow', function() {
                        $(this).detach();
                    });
                    /*$('.center-col \
                        form \
                        input[name="group_id"][value="'+id+'"]').parent().fadeOut('slow', function() {
                        $(this).detach();
                    });*/
                }
            });
        }

        bind_del($('.del-form'));

        $('#group-view .add-form').ajaxForm({
            'success': function(response, status, xhr, form) {
                form.context.reset();
                form.parent().parent().before(response);
                bind_del($('.del-form', form.parent().parent().prev()));
            }
        });
    });
})(jQuery);
