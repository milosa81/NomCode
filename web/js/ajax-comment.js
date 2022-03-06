$(function(){
    $('.comments button[data-type=ajax]').click(function(e){
        var $this = $(this);
        $this.find('i').remove();
        $this.prepend('<i class="fa fa-circle-o-notch fa-spin"></i> ');
        e.preventDefault();
        $this.prop('disabled', true);

        var $form = $(this).parents('form');
        $.ajax({
            data: $form.serialize(),
            url: window.location + '?r=ajax',
            type: 'post',
            statusCode: {
                200: function(e){
                    alert("publié");
                    //$this.prepend('<i class="fa fa-check"></i> ');
                },
                400: function(e){
                    $this.parents('form').before('<p class="bulle bulle-top bulle-danger"><i class="fa fa-exclamation-circle"></i> '+e.responseText+'</p>');

                    //$this.prepend('<i class="fa fa-exclamation-circle"></i> ');
                }
            },
            complete: function(){
                $this.find('.fa-spin').remove();
                $this.prop('disabled', false);
            }
        });
    })
});