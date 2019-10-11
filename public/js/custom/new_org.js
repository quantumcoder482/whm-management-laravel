$(document).ready(function(){
    $(".create_org").click(function(){

        var orgName = $("input[name='org_name']").val();
        var domain = $("input[name='domain']").val();
        var subdomain = $("input[name='subdomain']").val();
        var superAdminUsername = $("input[name='super_username']").val();
        var superAdminPassword = $("input[name='super_password']").val();
        var adminUsername = $("input[name='admin_username']").val();
        var adminPassword = $("input[name='admin_password']").val();
        var owner_name = $("input[name='owner_name']").val();
        var email_address = $("input[name='email_address']").val();

        var created_by = $("#created_by").val();
        var sale_type = $("#sale_type").val();
        

        if (orgName == '') {
            toastr.error('Please enter the Organization Name', 'Warning');
        } else if (domain == '') {
            toastr.error('Please enter the Domain Name', 'Warning');
        } else if (subdomain == '') {
            toastr.error('Please enter the Subdomain Name', 'Warning');
        } else if (superAdminUsername == '') {
            toastr.error('Please enter the Super Admin Username', 'Warning');
        } else if (superAdminPassword == '') {
            toastr.error('Please enter the Super Admin Password', 'Warning');
        } else if (adminUsername == '') {
            toastr.error('Please enter the Admin Username', 'Warning');
        } else if (adminPassword == '') {
            toastr.error('Please enter the Admin Password', 'Warning');
        } else if (created_by == '') {
            toastr.error('Please enter the Created By', 'Warning');
        } else if (owner_name == '') {
            toastr.error('Please enter the Owner Name', 'Warning');
        } else if (sale_type == '') {
            toastr.error('Please enter the Sale Type', 'Warning');
        } else if (email_address == '') {
            toastr.error('Please enter the Email Address', 'Warning');
        } else if(!validateEmail(superAdminUsername)){
            toastr.error('Please enter the Vaild Super Admin Email Address', 'Warning');
        } else if (!validateEmail(adminUsername)) {
            toastr.error('Please enter the Vaild Admin Email Address', 'Warning');
        } else if (!validateEmail(email_address)) {
            toastr.error('Please enter the Vaild Email Address', 'Warning');
        } else {
            var data = {
                orgName: orgName,
                domain: domain,
                subDomain: subdomain,
                superAdminUsername: superAdminUsername,
                superAdminPassword: superAdminPassword,
                adminUsername: adminUsername,
                adminPassword: adminPassword,
                created_by: created_by,
                owner_name: owner_name,
                sale_type: sale_type,
                email: email_address
            }

            $("body").ajaxloader({
                cssClass: 'lukehaas_tear_ball',
                content: '',
            });

            $('#neworg-form').block({message:''});

            axios.post('/add-organization', data).then(res => {
                setTimeout(function(){
                    $("body").ajaxloader("stop");
                    $('#neworg-form').unblock();
                    if (res.data.error) {
                        toastr.error(res.data.error, 'Warning');
                        location.reload();
                    } else if (res.data.success){
                        toastr.success(res.data.success, 'Success'); 
                        location.reload();
                    }
                }, 2000)
            }, err => {
                toastr.error(err, 'Warning');
                setTimeout(function(){
                    $("body").ajaxloader("stop");
                    $('#neworg-form').unblock();
                    location.reload();
                }, 2000)
            });
        }
    });


    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
});