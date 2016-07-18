"use strict";
window.App.createView('InfoManageFormComponent', function($, window, document){

	var defaults={};

	function InfoManageFormComponent(element, options)
	{
		var self=this;
		self.element=$(element);
		self.options=$.extend({}, defaults, options);
		self.registerHandlers();
	}

	InfoManageFormComponent.prototype.defaultHandlers=function()
	{
		var self=this;

		return {
			'onEditField':
			{
				'el': self.options['editBtnClass'] ? self.options['editBtnClass'] : '.info-field .edit-btn',
				'event':'click',
				'handlers':[function(evnt){
					evnt.preventDefault();
					self.showInputField($(evnt.currentTarget).attr('data-field-id'));
				}]
			}
		};
	};

	InfoManageFormComponent.prototype.showInputField=function(fieldId)
	{
		var self=this,	
			formField=self.element.find(fieldId),
			editBtnClass=self.options['editBtnClass'] ? self.options['editBtnClass'] : '.info-field .edit-btn',
			infoLabelClass=self.options['infoLabelClass'] ? self.options['infoLabelClass'] : '.info-label',
			infoValueClass=self.options['infoValueClass'] ? self.options['infoValueClass'] : '.info-value',
			inputType=(formField.attr('data-input-type').toLowerCase()),
			saveUrl=formField.attr('data-info-saveurl'),
			fieldLabel=formField.attr('data-info-label'),
			fieldName=formField.attr('data-info-name'),
			fieldValue=$.trim(self.element.find(fieldId+' .info-value').text()),
			inputField=null;

		formField.find(infoLabelClass+','+infoValueClass+','+editBtnClass).hide();

		switch(inputType)
		{
			case 'textarea': inputField=$('<textarea></textarea>'); break;
			case 'select': inputField=$('<select></select>'); break;
			case 'radio': inputField=$('<input type="radio"/>'); break;
			case 'checkbox': inputField=$('<input type="checkbox"/>'); break;
			case 'text': 
			default: inputField=$('<input type="text"/>'); break;
		}

		if(inputType=='text' || inputType=='textarea')
		{
			inputField.attr('name', fieldName);
			inputField.attr('placeholder', fieldLabel);
			inputField.val(fieldValue);
			inputField.addClass('input-field');
			formField.append(inputField);
			inputField.on('keypress', function(evnt){
				var keycode = (evnt.keyCode ? evnt.keyCode : evnt.which);
				if(keycode == '13'){
					evnt.preventDefault();
					self.saveField({
						'input':inputField,
						'saveurl':saveUrl,
						'field':formField
					});
				}
			});
		}
	};

	InfoManageFormComponent.prototype.saveField=function(context)
	{
		var self=this,
		    saveHandler=self.options['saveHandler'],
		    inputField=context['input'],
		    infoField=context['field'],
		    saveUrl=context['saveurl'],
		    data={};

		data[inputField.attr('name')]=inputField.val();
		data['usr_submit']=true;

		saveHandler.apply(this, [$.ajax({
			'url':saveUrl,
			'type':'post',
			'dataType':'json',
			'data':data
		}), {'inputField':inputField, 'infoField': infoField, 'saveUrl': saveUrl, 'value': inputField.val()}]);;
	};

	return InfoManageFormComponent;
});