var AppInbox = function () {

    var content = $('.inbox-content');
    var listListing = '';

    var loadInbox = function (el, name) {
        var url = '';
        var title = el.attr('data-title');
        var category = el.attr('data-category');
        url = 'forapproval_inbox_inbox.php';
        
        if (category != 0) {
            url = 'forapprovalstatus_inbox_inbox.php';
        }
        
        listListing = name;

        App.blockUI({
            target: content,
            overlayColor: 'none',
            animate: true
        });

        toggleButton(el);

        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            data: {
                userId: user, // variable declaration found in leaves.php
                statusId: category
            },
            dataType: "html",
            success: function(res) 
            {
                toggleButton(el);

                App.unblockUI('.inbox-content');

                $('.inbox-nav > li.active').removeClass('active');
                el.closest('li').addClass('active');
                $('.inbox-header > h1').text(title);

                content.html(res);

                if (Layout.fixContentHeight) {
                    //Layout.fixContentHeight();
                }
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });

        // handle group checkbox:
        jQuery('body').on('change', '.mail-group-checkbox', function () {
            var set = jQuery('.mail-checkbox');
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                $(this).attr("checked", checked);
            });
        });
    }

    var loadMessage = function (el, name, resetMenu) {
        var url = 'app_inbox_view.php';

        App.blockUI({
            target: content,
            overlayColor: 'none',
            animate: true
        });

        toggleButton(el);

        var leave_id = el.parent('tr').attr("data-leaveid");  
        var reference_no = el.parent('tr').attr("data-referenceno");
        
        $.ajax({
            type: "GET",
            cache: false,
            url: url,
            dataType: "html",
            data: {'leave_id': leave_id},
            success: function(res) 
            {
                App.unblockUI(content);

                toggleButton(el);

                if (resetMenu) {
                    $('.inbox-nav > li.active').removeClass('active');
                }
                $('.inbox-header > h1').text( reference_no + ' Leave Details');

                content.html(res);
                //Layout.fixContentHeight();
            },
            error: function(xhr, ajaxOptions, thrownError)
            {
                toggleButton(el);
            },
            async: false
        });
    }

    var toggleButton = function(el) {
        if (typeof el == 'undefined') {
            return;
        }
        if (el.attr("disabled")) {
            el.attr("disabled", false);
        } else {
            el.attr("disabled", true);
        }
    }

    var delItem = function () {
        var id = $('#leaveID').val();

        $.ajax({
            type: "POST",
            url: "../class/ajax.php",
            data: {
                nIndex: 41, //Remove Eleave
                Param: id
            },
            success: function (data, response) {
                var action = response;
                if (action) {
                    App.alert({
                        container: '', // alerts parent container(by default placed after the page breadcrumbs)
                        place: $('#alert_place').val(), // append or prepent in container 
                        type: 'danger',  // alert's type
                        message: 'You have removed an eleave from your list.',  // alert's message
                        close: 1, // make alert closable
                        reset: 1, // close all previouse alerts first
                        focus: 1, // auto scroll to the alert after shown
                        closeInSeconds: 5, // auto close after defined seconds
                        icon: 'warning' // put icon before the message
                    });
                }
            }
        });
    }
    
    return {
        //main function to initiate the module
        init: function () {

            // handle discard btn
            $('.inbox').on('click', '.inbox-discard-btn', function(e) {
                e.preventDefault();
                loadInbox($(this), listListing);
            });

            // handle view message
            $('.inbox').on('click', '.view-message', function () {
                loadMessage($(this));
            });

            // handle inbox listing
            $('.inbox-nav > li > a').click(function () {
                loadInbox($(this), 'inbox');
            });

            //handle delete confirmation
            $('.inbox-content').on('click', '#del-btn', function () {
                $('body').find('[data-toggle="confirmation"]').confirmation();
            });

            $(document).delegate('#del-btn', 'confirmed.bs.confirmation', function() { delItem() });

            //handle loading content based on URL parameter
            if (App.getURLParameter("a") === "view") {
                loadMessage();
            } else {
               $('.inbox-nav > li:first > a').click();
            }

        }

    };

    
}();

jQuery(document).ready(function() {
    AppInbox.init();
});