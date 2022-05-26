/*
	Admin part
*/
require('./bootstrap');

require('jquery-ui/ui/widgets/dialog');
require('jquery-ui/ui/widgets/sortable');
require('jquery-ui/ui/position');
require('jquery-ui/themes/base/all.css');
const dropzone = require('dropzone');
dropzone.autoDiscover = false;
require('jquery-cropper');
require('X-editable/dist/bootstrap4-editable/js/bootstrap-editable.js');
require('X-editable/dist/bootstrap4-editable/css/bootstrap-editable.css');
require('jquery-notebook/src/js/jquery.notebook.css');
require('jquery-notebook/src/js/jquery.notebook.js');
require('icheck');
require('icheck/skins/all.css');

var editorEnabled = false;

jQuery(document).ready(function(){
 	if (page == 'pakalpojumi' || page == 'arsti') {
		jQuery('[data-dismiss="collapse"]').on('click', function(){
			preventCollapse = false;
			editorEnabled = false;
			jQuery('.collapse').collapse('hide');
		}); 		
 		// сортировка услуг и врачей в UI
 		// работает
 		jQuery('#accordeon').sortable({
 			items: '.sortable',
 			opacity: 0.8,
 			stop: function(event, ui){
				axios.post('/updates',
					jQuery('#accordeon').sortable('serialize')+
	    			'&target='+jQuery('#accordeon').data('target')+'&method=updateOrder'
	    		).then(function(){
			    	jQuery('body').trigger('axios.ready');
	    		});
 			},
 		});
 		
 		jQuery(document).on('editor.enable', function(){
 			editorEnabled = true;
 		});
 		jQuery(document).on('editor.disable', function(){
 			editorEnabled = false;
 		});

 		// при срабатывании collapse
 		jQuery('#accordeon').on('show.bs.collapse', function(){
 			// ждем загрузки контента
 			jQuery('body').on('axios.ready', function(){
 				jQuery(document).trigger('collapse.disable');
			    // устанавливаем mousein/mouseout
	 			jQuery('[data-service="notebook"], [data-service="editable"], .editable-container')
	 			.on('mouseover', function(event){
	 				jQuery(document).trigger('collapse.disable');
	 				event.stopPropagation();
	 			})
	 			.on('mouseout', function(event){
	 				if (editorEnabled !== false) {
		 				setTimeout(function () {
		 				//	jQuery(document).trigger('collapse.enable');
		 				}, 1000);
	 				}
	 			});

	 			// обрабатываем картинки
 				jQuery('#service .w-30, #doctor .w-30').imagesLoaded().progress( function( instance, image ) {
					// перезапускаем dropzone
					dropzoneLoad(image.img);
				});

 				// запускаем редактор
				jQuery('[data-service="notebook"]')
					.notebook()
					.on('contentChange', function(event) {
					    var content = event.originalEvent.detail.content;
					    var self = this;
					    axios.post('/update',{
				    			data: content,
				    			target: jQuery(this).data('target'),
				    			id: jQuery(this).data('id')
				    	}).then(function(){
					    	//jQuery(event.target).html(content);
					    	jQuery('body').trigger('axios.ready');
				    	});
					});

				// обработка загрузки отредактированных данных
				jQuery('[data-service="editable"]').on('shown', function(e, editable) {	
	    		   	editable.container.$form.find('input').css({'font-size': jQuery('.editable-open').css('font-size')});
	    		   	jQuery(document).trigger('editor.enable');
	    		   	editable.container.$form.find('.editable-submit').on('click', function(e){
	    		   		// останавливаем замену
	    		   		e.preventDefault();
	    		   		e.stopPropagation();
	    		   		// отправляем данные своим путем
	    		   		return axios.post(editable.options.url,{
		 					id: editable.options.id,
		 					target: editable.options.target,
		 					data: editable.input.$input.val(),
		 				}).then(function(response){
		 					jQuery('body').trigger('axios.ready');
		 					// убираем диалог
		 					editable.hide();
		 					// передаем новое значение
		 					editable.$element.html(response.data);
		 					// возвращаем новое значение
							jQuery('body').trigger('services.refresh', editable.options.id);
		 					return (response, response.data);
		 				});
	    		   	});
	    		   	editable.container.$form.find('.editable-cancel').on('click', function(e){
	    		   		e.stopPropagation();
	    		   	});

				});
				jQuery('[data-service="editable"]').on('hidden', function(e, editable) {	
	    		   	jQuery(document).trigger('editor.disable');
	    		});
			
	 			// подключаем editable
				jQuery('[data-service="editable"]').editable({
			 			name: 'data',
			 			type: jQuery(this).data('type'),
			 			url: '/update',
			 			clear: false,
			 			escape: true,
			 			mode: 'inline',
			 			emptytext: 'Your text here...'
 				});	


 				jQuery('section[role="price"] ul').sortable({
 					items: '> li',
		 			opacity: 0.8,
		 			start: function() {
		 				axios.post('/updates', jQuery.param({
		 					id: jQuery(this).data('id'),
		 					method: 'servicesPivotSorting',
		 					class: 'ServicesPivot',
		 					target: 'order'})+'&'+
		 					jQuery(this).sortable('serialize')
		 				).then(function(){
		 					jQuery('body').trigger('axios.ready');
		 				});
		 			},
		 			stop: function(event, ui){
		 				setTimeout(function () {
		 				//	jQuery(document).trigger('collapse.enable');
		 				}, 1000);
	 				}				
	 			});
	 			jQuery('section[role="price"] .fa-list').on('click', function(){
	    			if (editorEnabled === false){
		    			jQuery(document).trigger('collapse.disable');
		    			jQuery(document).trigger('editor.enable');
		 				var self = this;
		 				axios.get('/updates',{
		 					params:{
		 						id: jQuery(this).closest('ul').data('id'),
		 						method: 'updatePrices',
		 					}
		 				}).then(function(response){
							// создаем обьект из шаблона загрузки файла
							/* eslint-disable */
							console.log('ready');
		    				jQuery('#service').append(response.data);
							// открываем диалог загрузки файла
							jQuery('section[role="prices"]').dialog({
				    		title: 'Services',
				    		appendTo: '#service',
				    		width: jQuery('body').innerWidth()*0.7,
				    		height: 'auto',
				    		minWidth: 400,
				    		minHeight: 300,
				    		position: { my: 'center center' },
				    		buttons: [
					    			{
							    		text: 'Saglabāt',
							      		click: function() {
						      				var checked = [];
											jQuery('input[type="checkbox"]:checked').each(function(){
										    		checked.push(parseInt(jQuery(this).val()));
											});
											axios.post('/updates', {
												id: jQuery(self).closest('ul').data('id'),
												target: jQuery(self).closest('ul').data('target'),
												services2_id: checked,
												method: 'updatePricesPost',
											}).then(function(){
												jQuery('body').trigger('axios.ready');
											});
						        			jQuery( this ).dialog('close');
								    	}
								    },
								    {
							    		text: 'Atcelt',
							      		click: function() {
							        		jQuery( this ).dialog('close');
								    	}
								    }
								],
								close: function(){
					    			jQuery('section[role="prices"]').off();
					    			jQuery('section[role="prices"]').remove();
									jQuery(document).trigger('editor.disable');
								},

								open: function(){
									jQuery(function () {
										jQuery('input[type="checkbox"] ').iCheck({
											checkboxClass: 'icheckbox_square-blue',
											increaseArea: '20%',
											hoverClass: 'none',
										}); 
									});
					    			jQuery('[data-toggle="collapse"]').on('click', function(event){
					    				event.stopPropagation();
					    				jQuery(jQuery(this).data('target')).collapse('toggle');
					    			});

					    			jQuery('section[role="prices"]').on('show.bs.collapse', function(event){
					    				event.stopPropagation();
					    			});
					    			jQuery('section[role="prices"]').on('hide.bs.collapse', function(event){
					    				event.stopPropagation();
					    			});
								}
			 				});
							jQuery('body').trigger('axios.ready');
				 		});
			 		}
			 	});
	 		});
 		}).on('hide.bs.collapse', function(){
		    jQuery('[data-service="editable"]').editable('destroy');
		    jQuery('#service, #doctor').off('axios.ready');
 		});

		// обрабатываем картинки
 		jQuery('section[role="main"]').imagesLoaded().progress( function( instance, image ) {
 			imagesLoad(image.img);
	 	});
	 	jQuery(document).on('accordeon.loaded', function(event, id){
	 			
		});

	 	// перезагружает услугу на главном окне
	 	jQuery('body').on('refresh.services refresh.doctors', function(event, id){
	 		axios.get('/refresh',{
	 			params: {
		 			id: id,
		 			method: event.namespace,
	 			}
	 		}).then(function(response){
	 			jQuery('body').trigger('axios.ready');
	 			jQuery('.sortable[data-id="'+id+'"]').html(jQuery(response.data).html());
	 			jQuery('.sortable[data-id="'+id+'"]').find('img').off();
	 			imagesLoad(jQuery('.sortable[data-id="'+id+'"]').find('img'));
	 		});

	 	});
	}
});


// обработчик загрузки картинок
function imagesLoad(img){
	// запускаем dropzone
	dropzoneLoad(img); 
	// overlay для publish
	jQuery(img).parent().find('.overlay').removeClass('hide').position({
		my: 'right bottom',
		at: 'right bottom',
		of: jQuery(img),
		within: jQuery(img)
	});

	// действия для кнопоки publish, сохраняем значение
	jQuery(img).parent().find('.overlay').on('click',function(event){
		event.stopPropagation();
		axios.post('/updates',{
			id: jQuery(event.target).parent().data('id'),
			method: 'publishToggle',
			class: jQuery(event.target).parent().data('model'),
			target: jQuery(event.target).parent().data('target')
		}).then(function(){
			jQuery('body').trigger('axios.ready');
			jQuery('body').trigger('refresh.'+jQuery(event.target).parent().data('refresh'), jQuery(event.target).parent().data('id'));
		});
	});
}

function dropzoneLoad(img) {
	jQuery(img).dropzone({ 
		url: '/update',
		maxFiles: 1,
		acceptedFiles: 'image/*',
		autoProcessQueue: false,
		clickable: false,
		init: function(event) {
			this.on('dragenter', function(event){
				// класс показывает рамочку вокруг загрузочной области
				jQuery(img).addClass('dropzone');
			});
			this.on('dragleave', function(event){
				jQuery(img).removeClass('dropzone');
			});
			this.on('addedfile', function(file) { 
				jQuery(img).removeClass('dropzone');
				// скачивакм шаблон загрузки файла
		    	axios.get('/updates',{
				    params: {
						id: jQuery(img).data('id'),
						target: jQuery(img).data('target'),
						method: jQuery(img).data('method'),
				    }
				}).then(function(response){
					jQuery('body').trigger('axios.ready');
					// создаем обьект из шаблона загрузки файла
	    			jQuery(img).append(response.data);
	    			// открываем диалог загрузки файла
					jQuery('#upload').dialog({
			    		title: jQuery(img).parent().find('h4').text(),
			    		appendTo: 'body',
			    		width: jQuery('body').innerWidth()/2,
			    		height: 'auto',
			    		minWidth: 400,
			    		minHeight: 300,
			    		position: { my: 'center center' },
			    		buttons: [
			    			{
					    		text: 'Saglabāt',
					      		click: function() {
					      			// устанавливаем размер файла исходя типа страницы
					      			var size = {width:240, height:165};
							        if (jQuery(img).data('target') == 'doctors.image') size = {width:167, height:167};
							        if (jQuery(img).data('target') == 'services.image') size = {width:240, height:165};
					      			var result = jQuery('#image').cropper('getCroppedCanvas', size).toDataURL();
									/* eslint-disable */
									console.log(jQuery(img).data('method'));
									axios.post('/updates',{
										id: jQuery(img).data('id'),
										target: jQuery(img).data('target'),
										method: jQuery(img).data('method')+'Post',
										data: result.replace(/^data:image\/[a-z]+;base64,/, '')
								  	}).then(function(){
								  		jQuery('body').trigger('axios.ready');
								  		jQuery(img).attr('src', result);
								  	});
					        		jQuery( this ).dialog('close');
						    	}
						    },
						    {
					    		text: 'Atcelt',
					      		click: function() {
					        		jQuery( this ).dialog('close');
						    	}
						    }
						],
			    		open: function(event, ui){
			    			jQuery('.ui-dialog-buttonset').find('.ui-button').attr('class','btn btn-lg btn-secondary');
			    			jQuery('.ui-dialog-buttonset').find('.btn').eq(0).addClass('btn-primary').removeClass('btn-secondary');
			    			
			    			jQuery(document).trigger('collapse.disable');
			    			jQuery(this).parent().css('z-index','1042');
			    			
			    			// читаем загруженный файл
			    			var reader = new FileReader();
						    reader.readAsDataURL(file);
						    reader.onload = function(event) {
						        var contents = event.target.result;
				      			// устанавливаем aspect ratio исходя типа страницы

						        var aspect = 240/165;
						        if (jQuery(img).data('target') == 'doctors.image') aspect = 240/240;
						        if (jQuery(img).data('target') == 'services.image') aspect = 240/165;
						        // запускаем редактор CropperJS
								jQuery('#image').attr('src', contents).cropper({
								  	aspectRatio: aspect,
								  	highlight: false,
								  	cropBoxResizable: false,
								  	minContainerWidth: 400,
								  	minContainerHeight: 300,
								});
								// кнопки управление CropperJS
								jQuery('.docs-buttons').on('click', '[data-method]', function () {
									var $this = jQuery(this);
									var data = $this.data();
									var cropper = jQuery('#image').data('cropper');
									var cropped;
									var $target;
									var result;

									if (cropper && data.method) {
										data = $.extend({}, data); // Clone a new one
									  	if (typeof data.target !== 'undefined') {
											$target = $(data.target);

											if (typeof data.option === 'undefined') {
												try {
													data.option = JSON.parse($target.val());
											  	} catch (e) {
												}
											}
										}
										result = jQuery('#image').cropper(data.method, data.option, data.secondOption);
									}
								});										
							};	
						},
			    		close: function(event, ui){
			    			jQuery(document).trigger('collapse.enable');
			    			jQuery(document).trigger('popover.enable');
			    			jQuery('#upload').remove();
			    		},
			    	});	
				});
			});
		},
	});
}

