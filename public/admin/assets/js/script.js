/*
Author       : Dreamguys
Template Name: Gigs - Bootstrap Admin Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');

	feather.replace();
	
	// Sidebar
	
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}
	
	// Sidebar Initiate
	init();
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	// Sidebar overlay
	
	$(".sidebar-overlay").on("click", function () {
		$wrapper.removeClass('slide-nav');
		$(".sidebar-overlay").removeClass("opened");
		$('html').removeClass('menu-opened');
	});
	
	// Page Content Height
	
	if($('.page-wrapper').length > 0 ){
		var height = $(window).height();	
		$(".page-wrapper").css("min-height", height);
	}
		 // Editor
	if ($('#editor').length > 0) {
		ClassicEditor
		.create( document.querySelector( '#editor' ), {
			 toolbar: [  'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	}
	// Logo Hide Btn

	$(document).on("click",".logo-hide-btn",function () {
		$(this).parent().hide();
	});
	// Experience Add More
	
    $(".settings-form").on('click','.trash', function () {
		$(this).closest('.links-cont').remove();
		return false;
    });

    $(document).on("click",".add-links",function () {
		var experiencecontent = '<div class="row form-row links-cont">' +
			'<div class="col-12 col-md-11">' +
				'<div class="form-group d-flex">' +
					'<button class="btn social-icon"><i class="feather-github"></i></button>' +
					'<input type="text" class="form-control" placeholder="Social Link">' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-1 col-lg-1"><a href="#" class="btn trash"><i class="feather-trash-2"></i></a></div>' +
		'</div>';
		
        $(".settings-form").append(experiencecontent);
        return false;
    });
    
	// Checkbox Select
	
	$('.app-listing .selectBox').on("click", function() {
        $(this).parent().find('#checkBoxes').fadeToggle();
        $(this).parent().parent().siblings().find('#checkBoxes').fadeOut();
    });

    $('.invoices-main-form .selectBox').on("click", function() {
        $(this).parent().find('#checkBoxes-one').fadeToggle();
        $(this).parent().parent().siblings().find('#checkBoxes-one').fadeOut();
    });

		// Invoices Checkbox Show

	$(function() {
		$("input[name='invoice']").click(function() {
			if ($("#chkYes").is(":checked")) {
				$("#show-invoices").show();
			} else {
				$("#show-invoices").hide();
			}
		});
	});
   
	// Page Content Height Resize
	
	$(window).resize(function(){
		if($('.page-wrapper').length > 0 ){
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});
	
	// Select 2
	if ($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}
	// Datetimepicker
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa fa-angle-down",
				next: 'fa fa-angle-right',
				previous: 'fa fa-angle-left'
			}
		});
		$('.datetimepicker').on('dp.show',function() {
			$(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
		}).on('dp.hide',function() {
			$(this).closest('.temp').addClass('table-responsive').removeClass('temp')
		});
	}

	// Tooltip
	
	if($('[data-toggle="tooltip"]').length > 0 ){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
    // Datatable

    if ($('.datatable').length > 0) {
		$('.datatable').DataTable({
			retrieve: true,
				lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
			language: {
				search: ' ',
				searchPlaceholder: "Search",
				info:  "Showing _START_ - _END_ of _TOTAL_ entries",
				"lengthMenu": "Show Per Page _MENU_",
				paginate: {
				  next: '<i class="fas fa-angle-right"></i>',
				  previous: '<i class="fas fa-angle-left"></i>'  
				}
			},
			initComplete: (settings, json)=>{
                $('.dataTables_info').appendTo('#tableinfo');
                $('.dataTables_paginate').appendTo('#tablepage');
                $('.dataTables_length').appendTo('#tablelength');
                $('.dataTables_filter').appendTo('#tablefilter');
            },
		});
	}

	// Checkbox Select All

	var selectAllItems = "#select-all";
	var checkboxItem = ":checkbox";
	$(selectAllItems).click(function() {
		
		if (this.checked) {
		$(checkboxItem).each(function() {
			this.checked = true;
		});
		} else {
		$(checkboxItem).each(function() {
			this.checked = false;
		});
		}
		
	});
	
	// Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			allowPageScroll: false,
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height() - 60;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function() {
			var rHeight = $(window).height() - 60;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}
	
	// Small Sidebar

	$(document).on('click', '#toggle_btn', function() {
		if($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').slideDown();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').slideUp();
		}
		setTimeout(function(){ 
			mA.redraw();
			mL.redraw();
		}, 300);
		return false;
	});
	$(document).on('mouseover', function(e) {
		e.stopPropagation();
		if($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if(targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').slideDown();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').slideUp();
			}
			return false;
		}
	});

	
})(jQuery);