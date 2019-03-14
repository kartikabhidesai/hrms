var Performance = function () {
    var handleList = function () {
   
    var form = $('#performance');
        var rules = {
          amount: {required: true}
        };
        handleFormValidate(form, rules, function (form) {
            handleAjaxFormSubmit(form,true);
        });
    $('#stars li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.star').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.star').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#stars li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var stars = $(this).parent().children('li.star');
        
        for (i = 0; i < stars.length; i++) {
          $(stars[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(stars[i]).addClass('selected');
        }
        
        var availableVal = parseInt($('#stars li.selected').last().data('value'), 10);
       $('#depandiablity').val(availableVal);
      });
  
      $('#knowledge li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.know').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.know').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#knowledge li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var knowledge = $(this).parent().children('li.know');
        
        for (i = 0; i < knowledge.length; i++) {
          $(knowledge[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(knowledge[i]).addClass('selected');
        }
        
        var jobKnow = parseInt($('#knowledge li.selected').last().data('value'), 10);
        $('#jobKnow').val(jobKnow);
      }); 
      $('#quality li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.qlt').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.qlt').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#quality li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var quality = $(this).parent().children('li.qlt');
        
        for (i = 0; i < quality.length; i++) {
          $(quality[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(quality[i]).addClass('selected');
        }
        
        var qualityVal = parseInt($('#quality li.selected').last().data('value'), 10);
        $('#qualityVal').val(qualityVal);
      }); 


      $('#productivity li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.product').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.product').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#productivity li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var productivity = $(this).parent().children('li.product');
        
        for (i = 0; i < productivity.length; i++) {
          $(productivity[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(productivity[i]).addClass('selected');
        }
        
        var productivityVal = parseInt($('#productivity li.selected').last().data('value'), 10);
        $('#productivityVal').val(productivityVal);
      }); 

        //  New Code Start 
      $('#working li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.work').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.work').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#working li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var working = $(this).parent().children('li.work');
        
        for (i = 0; i < working.length; i++) {
          $(working[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(working[i]).addClass('selected');
        }
        
        var workingVal = parseInt($('#working li.selected').last().data('value'), 10);
        $('#workingVal').val(workingVal);
      });  

      //  New Code Start 
      $('#honesty li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.honest').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.honest').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#honesty li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var honesty = $(this).parent().children('li.honest');
        
        for (i = 0; i < honesty.length; i++) {
          $(honesty[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(honesty[i]).addClass('selected');
        }
        var honestyVal = parseInt($('#honesty li.selected').last().data('value'), 10);
        $('#honestyVal').val(honestyVal);
      });

      //  New Code Start 
      $('#availability li').on('mouseover', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
       
        $(this).parent().children('li.available').each(function(e){
            if (e < onStar) {
                $(this).addClass('hover');
            }
            else {
                $(this).removeClass('hover');
            }
        });
        
      }).on('mouseout', function(){
        $(this).parent().children('li.available').each(function(e){
          $(this).removeClass('hover');
        });
      });
  
      $('#availability li').on('click', function(){
        var onStar = parseInt($(this).data('value'), 10); // The star currently selected
        var availability = $(this).parent().children('li.available');
        
        for (i = 0; i < availability.length; i++) {
          $(availability[i]).removeClass('selected');
        }
        
        for (i = 0; i < onStar; i++) {
          $(availability[i]).addClass('selected');
        }
        
        var availableVal = parseInt($('#availability li.selected').last().data('value'), 10);
        $('#availableVal').val(availableVal);
      });
      //  $('.dataTables-example').DataTable({
      //           pageLength:10,
      //           responsive: true,
      //           dom: '<"html5buttons"B>lTfgitp',
      //           buttons: [
      //               // { extend: 'copy'},
      //               // {extend: 'csv'},
      //               // {extend: 'excel', title: 'ExampleFile'},
      //               // {extend: 'pdf', title: 'ExampleFile'},

      //               // {extend: 'print',
      //               //  customize: function (win){
      //               //         $(win.document.body).addClass('white-bg');
      //               //         $(win.document.body).css('font-size', '10px');

      //               //         $(win.document.body).find('table')
      //               //                 .addClass('compact')
      //               //                 .css('font-size', 'inherit');
      //               // }
      //               // }
      //           ]

      //       });

      $('body').on('change', '.checkAll', function () {
        if (this.checked) {
            $('.empId:checkbox').each(function () {
                this.checked = true;
            });
        } else {
            $('.empId:checkbox').each(function () {
                this.checked = false;
            });
        }
    });

    $("body").on('click', '.downloadPdf', function () {
      $("#emparray").val('');
      var arrEmp = [];
      $('.empId:checkbox:checked').each(function () {
          // var invoiceNo = $(this).attr('id');
          var empId = $(this).val();
          arrEmp.push(empId);
          // arrInvoice.push(invoiceNo);
      });
      console.log(arrEmp);
      if (arrEmp.length > 0) {
          $("#emparray").val(arrEmp);
          $('#performanceStatus').submit();
      } else {
          alert('Please Select at least one Record');
      }
    });

    $("body").on('change', '.empSelectionType', function () {
      $('.checkAll').trigger('click');
    });

    

      var emparray = $("#employee").val();
        var department = $("#department").val();
        var dataArr = {"emparray" : emparray, "department" : department};
        var columnWidth = {"width": "10%", "targets": 0};
        
        var arrList = {
            'tableID': '#performanceTable',
            'ajaxURL': baseurl + "company/performance-ajaxAction",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSearchApply': [0],
            'noSortingApply': [0,4],
            'defaultSortColumn': 0,
            'defaultSortOrder': 'desc',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on('click', '.applyBtn', function () {
            var department = $('#department option:selected').val();
            var employee = $('#employee option:selected').val();
            var querystring = (department == '' && typeof department === 'undefined') ? 'department=' : 'department=' + department;
            querystring += (employee == '' && typeof employee === 'undefined') ? '&employee=' : '&employee=' + employee;
            location.href = baseurl + 'company/performance?' + querystring;
        });

        $('body').on('click', '.clearBtn', function () {
            location.href = baseurl + 'company/performance';
        });

}
return {
    init: function () {
        handleList();
    }
}
}();