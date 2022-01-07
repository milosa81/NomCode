$(function(){
    $('button[data-type=ajax]').click(function(e){
        var $this = $(this);
        $this.find('i').remove();
        $this.prepend('<i class="fa fa-circle-o-notch fa-spin"></i> ');
        e.preventDefault();

        var $form = $(this).parents('form');
        $.ajax({
            data: $form.serialize(),
            url: window.location + '?r=ajax',
            type: 'post',
            statusCode: {
                200: function(){
                    $this.prepend('<i class="fa fa-check"></i> ');
                },
                400: function(){
                    $this.prepend('<i class="fa fa-exclamation-circle"></i> ');
                }
            },
            complete: function(){
                $this.find('.fa-spin').remove();
            }
        });
    })
});