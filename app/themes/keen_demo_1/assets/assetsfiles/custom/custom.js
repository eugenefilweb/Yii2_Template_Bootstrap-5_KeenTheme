    $('body').tooltip({selector: '[data-toggle="tooltip"]'});

    $('[data-switch=true]').bootstrapSwitch();

    $('input[type=number]').on('keydown', function(e){
        var invalidChars = [
            "-",
            "+",
            "e",
        ];
                
        if (invalidChars.includes(e.key)) {
            e.preventDefault();
        }
    });
    
    $('input[maxlength]').maxlength({
        limitReachedClass: "label label-light-danger label-rounded label-inline"
    });

    
    const currentDate = new Date();
    const subtractYears = 150;
    currentDate.setFullYear(currentDate.getFullYear() - subtractYears);

    $('.bs-daterangepicker').datepicker({
        startDate : currentDate,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        todayBtn: "linked",
        clearBtn: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
    });

    $('.bs-daterangepicker-max-current').datepicker({
        startDate : currentDate,
        endDate : new Date(),
        format: "yyyy-mm-dd",
        todayHighlight: true,
        todayBtn: "linked",
        clearBtn: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        },
    });


    //email address mask
    $(".js-mask-email-address").inputmask({
        mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
        greedy: false,
        onBeforePaste: function (pastedValue, opts) {
            pastedValue = pastedValue.toLowerCase();
            return pastedValue.replace("mailto:", "");
        },
        definitions: {
            '*': {
                validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                cardinality: 1,
                casing: "lower"
            }
        }
    });


    /* BULK ACTION begin */
    /*$('.select-on-check-all').click(function(){
        var checkedItem = $('.item-checkbox-trigger').length;

        if(this.checked && checkedItem != 0){
            var checkedItem = $('.item-checkbox-trigger').length;
            $('#kt_datatable_selected_records').text(checkedItem);
            $('#kt_datatable_group_action_form').show('fast');
        }else{
            $('#kt_datatable_group_action_form').hide('fast');
        }
    });

    $('.item-checkbox-trigger').click(function(){
        var checkedItem = $('.item-checkbox-trigger:checked').length;

        if(checkedItem > 0){

            $('#kt_datatable_selected_records').text(checkedItem);
            $('#kt_datatable_group_action_form').show('fast');
        }else{
            $('#kt_datatable_group_action_form').hide('fast');
        }
    });

    $('._bulk_action').click(function(event){
        event.preventDefault();

        if (confirm('Are you sure ?')) {

            var actionPerformed = $(this).data('action');

            $.ajax({
                url: $('#bulk-action-form').attr('action'),
                method: 'POST',
                data: $('#bulk-action-form').serialize() + '&action=' + actionPerformed,
                // success: function(data){
                //     console.log(data)
                // }
            })

        }
    });*/
    /* BULK ACTION end */


        
    var lazyLoad = function(){
        $('.img-lazy').lazy({
            effect: 'fadeIn',
            threshold: 0,
            effectTime: 500,
            // defaultImage: base64_image,
            afterLoad: function(element) {
                element.css('background-image', 'none');
            },  
        });
    }
        
    var lazyLoadBg = function(){
        $('.img-lazy-bg').lazy({
            effect: 'fadeIn',
            threshold: 0,
            effectTime: 500,
            // defaultImage: base64_image,
            afterLoad: function(element) {
                // element.css('background-image', 'none');
            },  
        });
    }

    // if request is ajax
    $(document).ajaxComplete(function() {
        $('[data-toggle="tooltip"]').tooltip();
        lazyLoad(); // reload image lazy
        lazyLoadBg(); // reload image lazy
    });

    $(function(){
        $('[data-toggle="tooltip"]').tooltip();
        lazyLoad(); // reload image lazy
        lazyLoadBg(); // reload image lazy
    });


    // if request is pjax
    $(document).on('pjax:end', function() { 
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('pjax:start', function() { 
        $('[data-toggle="tooltip"]').tooltip('dispose');
    });