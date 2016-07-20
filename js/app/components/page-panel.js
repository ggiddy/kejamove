"use strict";
window.App.createView('PagePanelComponent', function($, window, document){

	var defaults={};

	function PagePanelComponent(element, options)
	{
		var self=this;
		self.element=$(element);
		self.options=$.extend({}, defaults, options);
		self.init();
	}

	PagePanelComponent.prototype.init=function()
	{
		var self=this;
		self.registerHandlers();
	};

	PagePanelComponent.prototype.defaultHandlers=function()
	{
		var self=this;

		return {
			'onScroll':
			{
				'el':window,
				'event':'scroll',
				'handlers': [function(evnt){
					self.fixHeader(evnt);
				}]
			}
		};
	};

	PagePanelComponent.prototype.fixHeader=function(evnt)
	{
		var self=this,
			elementOffset=self.element.offset(),
			windowScrollTop=$(window).scrollTop(),
			breakPoint=(Math.ceil(elementOffset.top));

		if(windowScrollTop >= breakPoint) 
		{
			if(!self.element.hasClass('fixed-header')) 
				self.element.addClass('fixed-header');
		}
		else
		{
			if(self.element.hasClass('fixed-header')) 
				self.element.removeClass('fixed-header');
		}
	};

	return PagePanelComponent;
});