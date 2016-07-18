"use strict";
(function(){

	window.jQuery(function(){

		window.App.createView('FlipPanelsComponent', function($, window, document){
			
			var defaults={
				'flipBtnClass':'.btn-flip',
				'flipPanelClass': '.flip-panel'
			};

			function FlipPanelsComponent(element, options)
			{
				var self=this;
				self.element=$(element);
				self.options=$.extend({}, defaults, options);
				self.init();
			}

			FlipPanelsComponent.prototype.initialize=function()
			{
				var self=this;
				self.extendInstanceApi();
				self.registerHandlers();
				self.initPanels();
			};

			FlipPanelsComponent.prototype.defaultHandlers=function()
			{
				var self=this;

				return {
					'onFlipButtonClick': 
					{
						'el':self.flipBtnClass,
						'event': 'click',
						'handlers':[function(evnt){
							evnt.preventDefault();
							self.flipPanels(evnt);
						}]
					}
				};
			};

			FlipPanelsComponent.prototype.hidePanels=function()
			{
				var self=this;
				self.element.find(self.flipPanelClass).hide().removeClass('active');
			};

			FlipPanelsComponent.prototype.getActivePanel=function()
			{
				var self=this;
				return self.element.find(self.flipPanelClass+'.active');
			};

			FlipPanelsComponent.prototype.showPanel=function(panel)
			{
				var self=this;
				self.element.find(panel).addClass('active').show().slideDown();
			};

			FlipPanelsComponent.prototype.flipPanels=function(evnt)
			{
				var self=this,
					targetPanel=$(evnt.currentTarget).attr('data-target');
				self.hidePanels();
				self.showPanel(targetPanel);
			};

			FlipPanelsComponent.prototype.initPanels=function()
			{
				var self=this,
					activePanel=self.getActivePanel();
				self.hidePanels();
				self.showPanel(activePanel);
			};

			return FlipPanelsComponent;
		});
	});
}());