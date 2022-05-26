
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('jquery-ui/ui/position');

window.preventCollapse = false;

jQuery(document).ready(function(){
	// устанавливает курсор waiting
	axios.interceptors.request.use(function (config) {
		jQuery('body').addClass('waiting');
    	return config;
	}, function (error) {
		jQuery('body').removeClass('waiting');
		return Promise.reject(error);
	});
	// восстанавливает курсор
	jQuery('body').on('axios.ready hide.bs.collapse', function(){
		jQuery('body').removeClass('waiting');			
	});

	// Событие, запрещающее закрытие collapse
	jQuery(document).on('collapse.disable', function(){
		preventCollapse = true;
	}).on('collapse.enable', function(){
		preventCollapse = false;
	});


	jQuery('#service, #doctor').on('click', function(){
		if (preventCollapse === false) {
			jQuery('.collapse').collapse('hide');
		}
	});
	jQuery('[data-dismiss="collapse"]').on('click', function(){
		preventCollapse = false;
		jQuery('.collapse').collapse('hide');
	});


	jQuery('section[role="main"]').imagesLoaded().progress( function( instance, image ) {
	    // set to default image if none present
	    if (!image.isLoaded){
			image.img.src = '/img/tools/dummy-'+jQuery(image.img).data('gender')+'.jpg';
	    }
	});
	if (page == 'pakalpojumi' || page == 'arsti') {	
 		jQuery('section[role="main"]').imagesLoaded().progress( function( instance, image ) {
		    var result = image.isLoaded ? 'loaded' : 'broken';
		});

		jQuery('#accordeon').on('show.bs.collapse', function() {
			var self = jQuery(event.target).closest('section[role="main"] > div > div[data-toggle="collapse"]');
			jQuery('#service, #doctor').css({
				'width': jQuery('#accordeon').width(),
				'left' : jQuery('#accordeon').position().left, 
			});
			jQuery(window).resize(function(){
				jQuery('#service, #doctor').css({
					'width': jQuery('#accordeon').width(),
					'left' : jQuery('#accordeon').position().left, 
				});
			});

			jQuery('body').append('<div class="modal-backdrop fade show"></div>');
			
			var target = '#service';
			if (page == 'pakalpojumi') target = '#service';
			if (page == 'arsti') target = '#doctor';

			// Загружаем данные страницы
			axios.get('/'+page+'?id='+self.data('id')+'&layout=minimal')	
			    .then(function(response){
				  	jQuery(target)
				  	.html(response.data).imagesLoaded().progress( function( instance, image ) {
				    // set to default image if none present
				    if (!image.isLoaded){
								image.img.src = '/img/tools/dummy-'+jQuery(image.img).data('gender')+'.jpg';
				    		}
						});
				  	jQuery('body').trigger('axios.ready');
					jQuery('html,body').animate({scrollTop: jQuery(target).offset().top}, 300);
			    	jQuery('#accordeon').trigger('accordeon.loaded');
			    	jQuery('.doctors a').on('click', function(event){
			    		event.stopPropagation();
			    	});
				});
		
			jQuery('#accordeon').on('hide.bs.collapse', function(event) {
				jQuery('body').find('.modal-backdrop').remove();
				jQuery(target).empty();
			});
		});
	}



	// обработка аккордеона цен
	if (page == 'cenas'){

		jQuery('[data-toggle="collapse"]').on('mouseover', function(event){
			event.stopPropagation();
			if (!jQuery(this).hasClass('active')) {
				jQuery(this).find('i').removeClass('fa-chevron-left').addClass('fa-chevron-down');
			}
		}).on('mouseout', function(event){
			event.stopPropagation();
			if (!jQuery(this).hasClass('active')) {
				jQuery(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-left');
			}
		});

		jQuery(document).on('show.bs.collapse hide.bs.collapse', function(e) {
			/* eslint-disable */
			if (e.type=='show'){
				console.log($(e.target));
		    	$(e.target).prev().addClass('active');
			} else {
		    	$(e.target).prev().removeClass('active');
			}
		});  
	}

	/**
	 * Mobile Callback button handler
	 *
	 **/ 	
	jQuery('#callme').on('click', function(){
		jQuery(this).find('div').find('div').toggleClass('active');
	});
	/**
	 * Callback form handler
	 *
	 * TODO: not closing mobile collapse back
	 **/ 
	jQuery('form[role="callback"]').submit(function(e){
		e.preventDefault();
		var self = this;
		axios.post(jQuery(this).attr('action'), jQuery(this).serialize())
			.then(function(response){
				jQuery(self).html(response.data);
				jQuery('body').trigger('axios.ready');
				// hides mobile callback window after 5 sec
				var hide = setInterval(function(){
					// hides mobile callback result
					jQuery('#callme').find('div').find('div').toggleClass('active').off();
					jQuery('#mobile').collapse('hide');
					// reloads mobile version of callback form
					axios.get('callback-reload',{
						params: {
							'ver':'mobile'
						}
					}).then(function(response){
						jQuery('body').trigger('axios.ready');
						// reloads form
						jQuery(self).html(response.data);
						// reloads handlers
						jQuery('#callme').on('click', function(){
							jQuery(this).find('div').find('div').toggleClass('active');
						});
					});
					clearInterval(hide);
				}, 5000	);
			}).catch(function(error){
				jQuery('body').trigger('axios.ready');
				jQuery(self).html(error.response.data);
				jQuery(self).find('[role="alert"]').css({'display':'block'});		
			});
		jQuery(document).on('hide.bs.modal', function(){
			var self_ = this;
			axios.get('callback-reload',{
				params: {
					'ver':'desktop'
				}
			}).then(function(response){
				jQuery('body').trigger('axios.ready');
				jQuery(self).html(response.data);
				jQuery(self_).off();
			});
		});
	});
});

