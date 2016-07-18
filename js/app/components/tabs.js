"use strict";
window.App.createView('TabsComponent', function($, window, document){

	var defaults={};

	function TabsComponent(element, options)
	{
		var self=this;
		self.element=$(element);
		self.options=$.extend({}, defaults, options);
		self.tabClass=self.options['tabClass'] ? self.options['tabClass'] : '.tab';
		self.tabPaneClass=self.options['tabPaneClass'] ? self.options['tabPaneClass'] : '.tab-pane';
		self.init();
	}

	TabsComponent.prototype.init=function()
	{
		var self=this;
		self.registerHandlers();
		self.render();
	};

	TabsComponent.prototype.defaultHandlers=function()
	{
		var self=this;

		return {
			'tabClick':
			{
				'el': self.tabClass,
				'event':'click',
				'handlers': [function(evnt){
					evnt.preventDefault();
					var tabClicked=$(evnt.currentTarget);
					self.changeTab(tabClicked);
				}]
			}
		};
	};

	TabsComponent.prototype.render=function()
	{
		var self=this;

		self.element.find(self.tabPaneClass+':not(.active)').hide();
	};

	TabsComponent.prototype.changeTab=function(selectedTab)
	{
		var self=this,
			selectedTabPane=self.element.find(selectedTab.find('a').attr('href')),
			selectedTabFx=((selectedTab.attr('data-fx') || 'fade-in').toLowerCase()),
			activeTab=self.element.find(self.tabClass+'.active'),
			activeTabPane=self.element.find(activeTab.find('a').attr('href'));

		activeTab.removeClass('active');
		activeTabPane.removeClass('active');

		selectedTab.addClass('active').show();
		selectedTabPane.addClass('active').show();

		self.element.find(self.tabPaneClass+':not(.active)').hide();

		switch(selectedTabFx)
		{
			case 'slide-in-right': 
				  selectedTabPane.css({
					'position':'absolute',
					'right':'-400000px'
				  }).animate({'right':'0px'}, (selectedTab.attr('data-fx-speed') || 'slow')).css({'position':'relative'});
				  break;
		    case 'slide-in-left': 
		    	  selectedTabPane.css({
					'position':'absolute',
					'left':'-400000px'
		    	  }).animate({'left':'0px'}, (selectedTab.attr('data-fx-speed') || 'slow')).css({'position':'relative'});break;
		    case 'fade-in': 
		    default: selectedTabPane.fadeIn();break;
		}
	};

	return TabsComponent;
});