"use strict";
(function($, window, document, undefined){
	
	var App=window.App || (window.App={});

	App.Events={
		appEvents:[]
	};

	App.Events.subscribe=function()
	{

	};

	App.Events.publish=function()
	{

	};

	App.Events.unsubscribe=function()
	{

	};

	App.throwError=function(errorMsg)
	{
		console.error(errorMsg);
	};

	App.jQueryPluginExists=function(name)
	{
		if($.fn[name] instanceof Function) return $.fn[name];
		return null;
	};

	App.extendjQuery=function(pluginName, plugin)
	{
		$.fn[pluginName]=function(options)
		{
			var self=this;

			return self.each(function () {

				var self=this;

				if (!$.data(self, 'plugin_' + pluginName)) 
				{
					$.data(self, 'plugin_' + pluginName,
							new plugin(self, options));
				}
			});
		};
	};

	App.createDaemon=function(daemonName, daemonDef)
	{

	};

	App.createView=function(viewName, viewDef){

		if(!(viewDef instanceof Function)) 
			App.throwError("Invalid view definition, No definition function!. Name: "+viewName+", DefinitionArray=>"+viewDef);

		var view = viewDef.apply(window, [$, window, document]);

		view.prototype.registerHandlers=function()
		{	
			var self=this,
				defaultHandlers=self.defaultHandlers(),
				userHandlers=(self.options['handlers'] || {});

			for(var handler in defaultHandlers)
			{
				handler=defaultHandlers[handler];

				if(handler.hasOwnProperty('el') 
						&& handler.hasOwnProperty('event')
								&& handler.hasOwnProperty('handlers'))
					for(var i=0; i < handler['handlers'].length; i++)
						self.registerHandler(handler['el'], handler['event'], handler['handlers'][i]);
				
			}

			if(userHandlers)
			{
				for(var handler in userHandlers)
				{
					handler=userHandlers[handler];

					if(handler.hasOwnProperty('el') 
							&& handler.hasOwnProperty('event')
									&& handler.hasOwnProperty('handlers'))
						for(var i=0; i < handler['handlers'].length; i++)
							self.registerHandler(handler['el'], handler['event'], handler['handlers'][i]);
				}
			}

		};

		view.prototype.registerHandler=function(el, evnt, handler)
		{
			var self=this,
				element=self.element.find(el);

			if(element.length < 1) element=$(el);

			if(handler instanceof Function)
			{
				element.on(evnt, function(evntObj){
					handler.apply(self, [evntObj]);
				});
			}
		};

		view.prototype.extendInstanceApi=function()
		{
			var self=this;
			for(var func in self.options)
			{
				var api=self.options[func];

				if(!(func in self)) self[func]=api;
			}
		};

		view.prototype.init=function()
		{
			var self=this;
			self.extendInstanceApi();
			self.registerHandlers();
			if(self.initialize instanceof Function) 
				self.initialize();
		};

		if(!(view.prototype.defaultHandlers instanceof Function))
			  view.prototype.defaultHandlers=function(){};

		App.extendjQuery(viewName, view);
	};
}(window.jQuery, window, document));