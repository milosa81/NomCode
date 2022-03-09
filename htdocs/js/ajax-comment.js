$(function(){
    $('.comments button[data-type=ajax]').click(function(e){
        e.preventDefault();
        var $this = $(this), $form = $(this).parents('form'), $section = $(this).parents('form').parents('section.comments');
        $this.find('i').remove();
        $this.prepend('<i class="fa fa-circle-o-notch fa-spin"></i> ');
        $this.prop('disabled', true);
        $section.find('.bulle-top').fadeOut(400, function() { $(this).remove(); });

        var $form = $(this).parents('form');
        $.ajax({
            data: $form.serialize(),
            url: window.location + '?r=ajax',
            type: 'post',
            statusCode: {
                200: function(e){
                    $section.find('[data-purpose=help]').slideUp(400, function() { $(this).remove(); });
                    $form.after(e).slideUp(400, function() { $(this).remove(); });
                    $section.find('.comment').first().hide().slideDown();
                },
                400: function(e){
                    $this.prepend('<i class="fa fa-exclamation-circle" style="color:#EC7676;"></i> ');
                    $form.prepend('<p class="bulle bulle-top bulle-danger bulle-helper-article" style="display:none;"><i class="fa fa-exclamation-circle"></i> '+e.responseText+'</p>')
                    $form.find("p.bulle-danger").fadeIn();
                }
            },
            complete: function(){
                $this.find('.fa-spin').remove();
                $this.prop('disabled', false);
            }
        });
    })
});