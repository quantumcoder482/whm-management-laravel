$(document).ready(function() {
    $("#org_lists_table").DataTable({
        fixedHeader: true,
        pageLength: 15,
        lengthMenu: [5, 15, 25, 50, 100],
        ordering: true,
        columnDefs: [{
            "targets": [0,],
            "orderable": false
        }],
        responsive: true,
    });

});


function changeStatus(permission, subdomain){
    
    
    $("#org_lists_table").block({
        message: null
    });

    $("body").ajaxloader({
        cssClass: "lukehaas_tear_ball",
        content: ""
    });

    if (permission == 1 || permission == 0) {
        // var _this = $(this);
        var token = $('meta[name="csrf-token"]').attr("content");

        $.post("org-suspend", {
            subdomain: subdomain,
            status: permission,
            _token: token
        }).then(
            res => {
                setTimeout(function () {
                    $("body").ajaxloader("stop");
                    $("#org_lists_table").unblock();
                    if (res.success) {
                        toastr.success(res.success, "Success");
                        location.reload();
                    } else {
                        toastr.error(res.error, "Warning")
                    }
                    
                    // _this
                    //     .siblings("button.permission-active")
                    //     .removeClass("permission-active");
                    // _this.addClass("permission-active");
                }, 1500);
            },
            err => {}
        );

    } else {
        var url = "delete-organization";
        var _this = $(this);
        var token = $('meta[name="csrf-token"]').attr("content");

        $.post(url, {
            subdomain: subdomain,
            _token: token
        }).then(
            res => {
                setTimeout(function () {
                    console.log(res);
                    $("body").ajaxloader("stop");
                    $("#org_lists_table").unblock();
                    if (res.success) {
                        _this.parents("tr").remove();
                        toastr.success(res.success, "Success");
                        location.reload();
                    } else {
                        toastr.error(res.error, "Warning");
                    }
                }, 1000);
            },
            err => {
                console.log(err);
            }
        );
    }
}


function changeLimited(id){

     $("#org_lists_table").block({
         message: null
     });

     $("body").ajaxloader({
         cssClass: "lukehaas_tear_ball",
         content: ""
     });
    

     var token = $('meta[name="csrf-token"]').attr("content");

     $.post("org-unlimited", {
         id: id,
         _token: token
     }).then(
         res => {
             setTimeout(function () {
                 $("body").ajaxloader("stop");
                 $("#org_lists_table").unblock();
                 if (res.success) {
                     toastr.success(res.success, "Success");
                     location.reload();
                 } else {
                     toastr.error(res.error, "Warning")
                 }

             }, 1500);
         },
         err => {}
     );
     
}