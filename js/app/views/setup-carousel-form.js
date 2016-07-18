"use strict";
(function(){
	window.jQuery(function(){
		var $=window.jQuery,
		setupCarouselFormView=$('#setup-request-carousel-form-view')
		.CarouselFormComponent({
			'onFormFieldChangeHandler':function(evnt){
				var self=this;
			},
			'onStepButtonClickHandler':function(evnt){
				var self=this,
					form=self.getForm(),
					field=$($(evnt.currentTarget).attr('data-target')),
					value=field.val();

				if(value)
				{
					if(field.hasClass('moving-from'))
					{
						self.moveNext();
					}
					else if(field.hasClass('moving-to'))
					{
						self.moveNext();
					}
					else if(field.hasClass('phone-number'))
					{
						if((/^[0-9-+]+$/).test(value))
						{
							form.submitForm();
						}
						else
						{
							form.showFormMessage(
								"Invalid phone number <i class='fa fa-exclamation'></i>", 'danger');
				
						}
					}
				}
				else
				{
					form.showFormMessage("The field is required <i class='fa fa-exclamation'></i>", 'danger');
				}
			}
		}),
		movingFromInputField=setupCarouselFormView.find('.moving-from').get(0),
		movingToInputField=setupCarouselFormView.find('.moving-to').get(0),
		fromAutocomplete=new google.maps.places.Autocomplete(movingFromInputField),
		toAutocomplete=new google.maps.places.Autocomplete(movingToInputField);
	});
}());