$(document).ready(function(){
    $('#user-lists-table').DataTable({
        fixedHeader: true,
        pageLength: 15,
        lengthMenu: [ 5, 15, 25, 50, 100 ]
    })
    $(".permission-action .btn").on("click", function() {
        var permission = $(this).attr("permission");
        var id = $(this).siblings("input[name='id']").val();
        $("body").ajaxloader({
            cssClass: 'lukehaas_tear_ball',
            content: '',
        });
        axios.put(`users/${id}`, {state: permission}).then(res => {
            let _this = $(this);
            setTimeout(function(){
                $("body").ajaxloader("stop");
                if (res.data.result == 'delete') {
                    _this.parents("tr").remove();
                } else {
                    _this.siblings("button.permission-active").removeClass("permission-active");
                    _this.addClass("permission-active");
                }
            }, 1500);
        }, err => {
            console.log(err);
        })
    })
});
    
