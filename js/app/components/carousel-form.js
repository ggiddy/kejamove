/**
 *@uses jQuery.fn.FormComponent
 *@uses jQuery.fn.Bootstrap.Carousel
 */
"use strict";
(function(){

	window.jQuery(function(){

		window.App.createView('CarouselFormComponent', function($, window, document){

			var defaults={
				'formID':'#cform',
				'formMessageClass':'.form-message',
				'formFieldMessageClass':'.field-message',
				'formFieldClass':'.cform-control',
				'stepBtnClass':'.btn-step',
				'stepIndicatorClass': '.carousel-indicators li',
				'onFormSubmitHandler': function(){},
				'onFormFieldChangeHandler': function(){},
				'onBootstrapCarouselSlideHandler':function(){},
				'onBootstrapCarouselSlideCompleteHandler':function(){},
				'onStepIndicatorClickHandler':function(){},
				'onStepButtonClickHandler':function(){}
			};

			function CarouselFormComponent(element, options)
			{
				var self=this;
				self.element=$(element);
				self.options=$.extend({}, defaults, options);
				self.formCarousel=null;
				self.init();
			}

			CarouselFormComponent.prototype.initialize=function()
			{
				var self=this;
				/*************/
				self.element.FormComponent({
					'formID':self.formID,
					'formFieldClass':self.formFieldClass,
					'formMessageClass':self.formMessageClass,
					'formFieldMessageClass':self.formFieldMessageClass,
					'onFormFieldChangeHandler':self.onFormFieldChangeHandler,
					'onFormSubmitHandler':self.onFormSubmitHandler
				});
				/*************/
				self.formCarousel=self.element.find('.carousel').carousel({
					'interval':false,
				});
			};

			CarouselFormComponent.prototype.defaultHandlers=function()
			{
				var self=this; 

				return {
					'onBootstrapCarouselSlide':{
						'el':self.formCarousel,
						'event':'slide.bs.carousel',
						'handlers':[function(evnt){
							self.onBootstrapCarouselSlideHandler.apply(self, [evnt])
						}]
					},
					'onBootstrapCarouselSlideComplete':{
						'el':self.formCarousel,
						'event':'slid.bs.carousel',
						'handlers':[function(evnt){
							self.onBootstrapCarouselSlideCompleteHandler.apply(self, [evnt])
						}]
					},
					'onStepIndicatorClick':{
						'el':self.stepIndicatorClass,
						'event':'click',
						'handlers':[function(evnt){
							self.onStepIndicatorClickHandler.apply(self, [evnt])
						}]
					},
					'onStepButtonClick':
					{
						'el':self.stepBtnClass,
						'event':'click',
						'handlers':[function(evnt){
							self.onStepButtonClickHandler.apply(self, [evnt])
						}]
					}
				};
			};

			CarouselFormComponent.prototype.getForm=function()
			{
				var self=this;
			    return self.element.data('plugin_FormComponent');
			};

			CarouselFormComponent.prototype.carouselDo=function(action)
			{
				var self=this;
				self.formCarousel.carousel(action);
			};

			CarouselFormComponent.prototype.moveCarousel=function()
			{
				var self=this;
				self.carouselDo('cycle');
			};

			CarouselFormComponent.prototype.moveTo=function(number)
			{
				var self=this;
				self.carouselDo(number);
			};

			CarouselFormComponent.prototype.moveNext=function()
			{
				var self=this;
				self.carouselDo('next');
			};

			CarouselFormComponent.prototype.movePrev=function()
			{
				var self=this;
				self.carouselDo('prev');
			};

			CarouselFormComponent.prototype.moveFirst=function()
			{
				var self=this;
				self.carouselDo(0);
			};

			CarouselFormComponent.prototype.onStepIndicatorClickHandler=function(evnt)
			{
				var self=this,
					el=$(evnt.currentTarget),
	    		    currentItem = self.formCarousel.find('.carousel-indicators li.active');
				if(el.attr('data-slide-to') > currentItem.attr('data-slide-to'))
				{
					evnt.stopPropagation();
				}
			};

			return CarouselFormComponent;
		});
	});
}());