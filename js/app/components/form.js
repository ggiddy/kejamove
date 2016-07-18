"use strict";
(function(){

	window.jQuery(function(){

		window.App.createView('FormComponent', function($, window, document){
			
			var defaults={
				'formID':'#form',
				'formMessageClass':'.form-message',
				'formFieldMessageClass':'.field-message',
				'formFieldClass':'.form-control',
				'onFormSubmitHandler':function(){},
				'onFormFieldChangeHandler':function(){}
			};

			function FormComponent(element, options)
			{
				var self=this;
				self.element=$(element);
				self.options=$.extend({}, defaults, options);
				self.errorRemoveAsyncID=null;
				self.init();
			}

			FormComponent.prototype.initialize=function()
			{
				var self=this;
				self.element.find(self.formMessageClass).hide();
				self.element.find(self.formFieldMessageClass).hide();
			};

			FormComponent.prototype.defaultHandlers=function()
			{
				var self=this;

				return {
					'onFormSubmit': 
					{
						'el':self.formID,
						'event': 'submit',
						'handlers':[function(evnt){
							self.handleFormSubmit();
						}]
					},
					'onFormFieldChange':
					{
						'el':self.formFieldClass,
						'event':'change',
						'handlers':[function(evnt){
							self.handleFormFieldChange(evnt);
						}]
					},
					'onFormMessageCloseBtnClick': 
					{
						'el':self.formMessageClass+' .close',
						'event': 'click',
						'handlers':[function(evnt){
							evnt.preventDefault();
							self.removeFormMessage();
						}]
					},
				};
			};

			FormComponent.prototype.showFormMessage=function(msg, type)
			{
				var self=this,
					formMessage=self.element.find(self.formMessageClass);

				formMessage.removeClass('hidden').addClass(type);
				formMessage.find('.message').html(msg);
				formMessage.fadeIn(500);

				self.errorRemoveAsyncID=setTimeout(function(){
					self.removeFormMessage();
				}, 10000);
			};

		    FormComponent.prototype.removeFormMessage=function()
		    {		
		    	var self=this;
		    	clearTimeout(self.errorRemoveAsyncID);
				self.element.find(self.formMessageClass).hide(500);
		    };

		    FormComponent.prototype.showFormFieldMessage=function(msg, field, type)
		    {
		    	var self=this,
		    		message=$('<span class="'+self.formFieldMessageClass+type+'"></span>');
				self.element.find(field).append(message);
				message.html(msg).fadeIn();
		    };

		    FormComponent.prototype.removeFormFieldMessage=function(msg, field)
		    {
		    	var self=this;
				self.element.find(field+" "+self.formFieldMessageClass).hide();
		    };

		    FormComponent.prototype.handleFormFieldChange=function(evnt)
		    {
		    	var self=this,
		    		onFormFieldChange=self.onFormFieldChangeHandler;
		    	if(onFormFieldChange instanceof Function)
		    		 onFormFieldChange.apply(self, [evnt])

		    };

		    FormComponent.prototype.handleFormSubmit=function(evnt)
		    {
		        var self=this,
		        	onFormSubmitHandler=self.onFormSubmitHandler;
		        if(onFormSubmitHandler instanceof Function)
		        	 onFormSubmitHandler.apply(self,[evnt])
		    };

		    FormComponent.prototype.submitForm=function()
		    {
		    	var self=this;
		    	self.element.find('.form').submit();
		    };

			return FormComponent;
		});
	});
}());