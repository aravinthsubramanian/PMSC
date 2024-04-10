/*
Author       : Dreamguys
Template Name: DreamGigs
Version      : 1.0
*/

(function ($) {
	"use strict";

	var $slimScrolls = $('.slimscroll');
	var $wrapper = $('.main-wrapper');

	// Sidebar

	if ($(window).width() <= 991) {
		var Sidemenu = function () {
			this.$menuItem = $('.main-nav a');
		};

		function init() {
			var $this = Sidemenu;
			$('.main-nav a').on('click', function (e) {
				if ($(this).parent().hasClass('has-submenu')) {
					e.preventDefault();
				}
				if (!$(this).hasClass('submenu')) {
					$('ul', $(this).parents('ul:first')).slideUp(350);
					$('a', $(this).parents('ul:first')).removeClass('submenu');
					$(this).next('ul').slideDown(350);
					$(this).addClass('submenu');
				} else if ($(this).hasClass('submenu')) {
					$(this).removeClass('submenu');
					$(this).next('ul').slideUp(350);
				}
			});
		}

		// Sidebar Initiate
		init();
	}

	// Sticky Header

	$(window).scroll(function () {
		var sticky = $('.header'),
			scroll = $(window).scrollTop();
		if (scroll >= 50) sticky.addClass('fixed');
		else sticky.removeClass('fixed');
	});

	// Mobile menu sidebar overlay

	$('.header-fixed').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function () {
		$('main-wrapper').toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});

	$(document).on('click', '.sidebar-overlay', function () {
		$('html').removeClass('menu-opened');
		$(this).removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
		$('#task_window').removeClass('opened');
	});

	$(document).on('click', '#menu_close', function () {
		$('html').removeClass('menu-opened');
		$('.sidebar-overlay').removeClass('opened');
		$('main-wrapper').removeClass('slide-nav');
	});

	// Select Favourite

	$('.fav-icon').on('click', function () {
		$(this).toggleClass('selected');
		$(this).children().toggleClass("feather-heart fa-solid fa-heart");
	});

	// Small Sidebar

	$(document).on('click', '#toggle_btn', function () {
		if ($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').slideDown();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').slideUp();
		}
		return false;
	});


	$(document).on('mouseover', function (e) {
		e.stopPropagation();
		if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if (targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').slideDown();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').slideUp();
			}
			return false;
		}
	});

	// Aos Animation 

	if ($('.main-wrapper .aos').length > 0) {
		AOS.init({
			duration: 1200,
			once: true
		});
	}

	// Mobile menu sidebar overlay

	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btns', function () {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').toggleClass('menu-opened');
		return false;
	});

	// Sidebar

	var Sidemenu = function () {
		this.$menuItem = $('#sidebar-menu a');
	};

	function initi() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function (e) {
			if ($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if (!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if ($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}

	// Sidebar Initiate
	initi();


	// Sidebar Slimscroll

	if ($slimScrolls.length > 0) {
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
		var wHeight = $(window).height() - 76;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function () {
			var rHeight = $(window).height() - 76;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}

	$('body').append('<div class="sidebar-notification"></div>');
	$(document).on('click', '.notify-link', function() {
	 $('.sidebar-notification').toggleClass('opened');
	 return false;
	 });

	$(document).on('click', '.sidebar-notification', function() {
	 $('.sidebar-notification').removeClass('opened');
	 });

	// Tooltip
	
	if($('[data-bs-toggle="tooltip"]').length > 0 ){
		var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
		var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
		return new bootstrap.Tooltip(tooltipTriggerEl)
		})
	}
		if($('[data-bs-toggle="popover"]').length > 0 ){
			var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
			var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
			return new bootstrap.Popover(popoverTriggerEl)
		})
	}

	// For Slider

	$(window).on('load resize', function () {
		var window_width = $(window).outerWidth();
		var container_width = $('.container').outerWidth();
		var full_width = window_width - container_width
		var right_position_value = full_width / 2
		$('.slider-service').css('padding-left', right_position_value);

	});

	// Toggle Password

	if($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function() {
			$(this).toggleClass("feather-eye");
			var input = $(".pass-input");
			if (input.attr("type") == "password") {
				input.attr("type", "text");
			} else {
				input.attr("type", "password");
			}
		});
	}

	// Chat

	var chatAppTarget = $('.chat-window');
	(function () {
		if ($(window).width() > 991)
			chatAppTarget.removeClass('chat-slide');

		$(document).on("click", ".chat-window .chat-users-list a.media", function () {
			if ($(window).width() <= 991) {
				chatAppTarget.addClass('chat-slide');
			}
			return false;
		});
		$(document).on("click", "#back_user_list", function () {
			if ($(window).width() <= 991) {
				chatAppTarget.removeClass('chat-slide');
			}
			return false;
		});
	})();

	// Chat sidebar overlay

	if ($(window).width() <= 1199) {
		if ($('#task_chat').length > 0) {
			$(document).on('click', '#task_chat', function () {
				$('.sidebar-overlay').toggleClass('opened');
				$('#task_window').addClass('opened');
				return false;
			});
		}
	}

	if ($(window).width() > 767) {
		if ($('.theiaStickySidebar').length > 0) {
			$('.theiaStickySidebar').theiaStickySidebar({
				// Settings
				additionalMarginTop: 125
			});
		}
	}

	// Gigs Slider

	if($('.owl-carousel.gigs-slider').length > 0) {
		$('.owl-carousel.gigs-slider').owlCarousel({
			loop:true,
			margin:15,
			dots: true,
			nav:true,
			smartSpeed: 2000,
			navText: [ '<i class="fas fa-chevron-left"></i>', '<i class="fas fa-chevron-right"></i>' ], 
			responsive:{
				0:{
					items:1
				},
				500:{
					items:1
				},
				768:{
					items:2
				},
				1000:{
					items:3
				},
				1300:{
					items:4
				}
			}
		})	
	}

	if ($('#company-slider').length > 0) {
		$('#company-slider').owlCarousel({
			items: 8,
			margin: 30,
			dots: false,
			nav: false,
			autoplay: true,
			smartSpeed: 2000,
			navText: [
				'<i class="fas fa-chevron-left"></i>',
				'<i class="fas fa-chevron-right"></i>'
			],
			loop: true,
			responsiveClass: true,
			responsive: {
				0: {
					items: 2
				},
				768: {
					items: 3
				},
				1170: {
					items: 6
				}
			}
		});
	}

	// Select 2
	
	if($('.select').length > 0) {
		$('.select').select2({
			minimumResultsForSearch: -1,
			width: '100%'
		});
	}

	// Wizard

	$(document).ready(function () {
        let progressVal = 0;
        let businessType = 0;
      
		$(".next_btn").click(function () {
			$(this).parent().parent().parent().next().fadeIn('slow');
			$(this).parent().parent().parent().css({
				'display': 'none'
			});
			progressVal = progressVal + 1;
			$('.progress-active').removeClass('progress-active').addClass('progress-activated').next().addClass('progress-active');
		});

		$(".prev_btn").click(function () {
			$(this).parent().parent().parent().prev().fadeIn('slow');
			$(this).parent().parent().parent().css({
				'display': 'none'
			});
			progressVal = progressVal - 1;
			$('.progress-active').removeClass('progress-active').prev().removeClass('progress-activated').addClass('progress-active'); 
		});
  	});

  	// CK Editor

	if ($('#ck-editor').length > 0) {
		ClassicEditor
		.create( document.querySelector( '#ck-editor' ), {
			 toolbar: {
			    items: [
			        'heading', '|',
			        'fontfamily', 'fontsize', '|',
			        'alignment', '|',
			        'fontColor', 'fontBackgroundColor', '|',
			        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
			        'link', '|',
			        'outdent', 'indent', '|',
			        'bulletedList', 'numberedList', 'todoList', '|',
			        'code', 'codeBlock', '|',
			        'insertTable', '|',
			        'uploadImage', 'blockQuote', '|',
			        'undo', 'redo'
			    ],
			    shouldNotGroupWhenFull: true
			}
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	}

	// Buyer Editor

	if ($('#buyer-editor').length > 0) {
		ClassicEditor
		.create( document.querySelector( '#buyer-editor' ), {
			 toolbar: {
			    items: [
			        'heading', '|',
			        'fontfamily', 'fontsize', '|',
			        'alignment', '|',
			        'fontColor', 'fontBackgroundColor', '|',
			        'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', '|',
			        'link', '|',
			        'outdent', 'indent', '|',
			        'bulletedList', 'numberedList', 'todoList', '|',
			        'code', 'codeBlock', '|',
			        'insertTable', '|',
			        'uploadImage', 'blockQuote', '|',
			        'undo', 'redo'
			    ],
			    shouldNotGroupWhenFull: true
			}
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );
	}

	// Selling Add More
	
    $(".selling-details").on('click','.trash', function () {
		$(this).closest('.selling-cont').remove();
		return false;
    });

    $(".add-selling").on('click', function () {
		
		var sellingcontent = '<div class="row selling-cont">' +
			'<div class="col-12 col-md-10 col-lg-11">' +
				'<div class="row align-items-center">' +
					'<div class="col-12 col-md-6 col-lg-6">' +
						'<div class="form-group">' +
							'<label class="selling-title">Earn extra money <span>*</span></label>' +
							'<input type="text" class="form-control" placeholder="I Can">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label class="selling-title">For ($) <span>*</span></label>' +
							'<input type="text" class="form-control">' +
						'</div>' +
					'</div>' +
					'<div class="col-12 col-md-6 col-lg-3">' +
						'<div class="form-group">' +
							'<label class="selling-title">In (Day) <span>*</span></label>' +
							'<input type="text" class="form-control">' +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>' +
			'<div class="col-12 col-md-2 col-lg-1"><div class="form-group"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div></div>' +
		'</div>';
		
        $(".selling-details").append(sellingcontent);
        return false;
    });

    // Datetimepicker Date

	if ($('.datetimepicker').length > 0) {
		$('.datetimepicker').datetimepicker({
			format: 'DD-MM-YYYY',
			icons: {
				up: "fas fa-angle-up",
				down: "fas fa-angle-down",
				next: 'fas fa-angle-right',
				previous: 'fas fa-angle-left'
			}
		});
	}

})(jQuery);