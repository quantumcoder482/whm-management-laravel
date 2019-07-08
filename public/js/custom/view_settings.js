$(function() {
    
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html);
    });

    var _token = $('meta[name="csrf-token"]').attr('content');

    $('.js-switch').on("change", function(e){

        var opt = e.target.id;
        $('.card-body').block({message:null});
        $(".card-body").ajaxloader({
            cssClass: 'lukehaas_tear_ball',
            content: '',
        });
        
        if ($(this).prop('checked')) {
            $.post('/update-setting', {
                    opt: opt,
                    val: "1",
                    _token:_token
                })
                .done(function (data) {
                    $('.card-body').unblock();
                    $('.card-body').ajaxloader('stop');
                    console.log(data);
                });
        } else {
            $.post('/update-setting', {
                    opt: opt,
                    val: "0",
                    _token: _token
                })
                .done(function (data) {
                    $('.card-body').unblock();
                    $('.card-body').ajaxloader('stop');
                    console.log(data);
                });
        }

    });

});