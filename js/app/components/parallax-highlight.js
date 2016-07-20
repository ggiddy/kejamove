"use strict";
window.App.createView('ParallaxHighlightComponent', function($, window, document){

	var defaults={};

	function ParallaxHighlightComponent(element, options)
	{
		var self=this;
		self.element=$(element);
		self.options=$.extend({}, defaults, options);
		self.itemClass=self.options['itemClass'] ? self.options['itemClass'] : '.parallax-item';
		self.itemContentClass=self.options['itemContentClass'] ? self.options['itemContentClass'] : '.parallax-item-content';
	}

	ParallaxHighlightComponent.prototype.defaultHandlers=function()
	{
		var self=this;

		return {
			'tabClick':
			{
				'el': window,
				'event':'scroll',
				'handlers': [function(evnt){
					self.calculateEffects(evnt);
				}]
			}
		};
	};

	ParallaxHighlightComponent.prototype.calculateEffects=function(evnt)
	{
		var self=this,
			elementOffset=self.element.offset(),
			windowScrollTop=$(window).scrollTop(),
			topBreakPoint=(Math.ceil(elementOffset.top));
			bottomBreakPoint=(Math.ceil(elementOffset.bottom));
	};

	ParallaxHighlightComponent.prototype.fixHeader=function(evnt)
	{

	};


	ParallaxHighlightComponent.prototype.unfixHeader=function(evnt)
	{

	};


	ParallaxHighlightComponent.prototype.render=function()
	{
		var self=this;
	};

	return ParallaxHighlightComponent;
});