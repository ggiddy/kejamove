/**
 *@uses jQuery.fn.FormComponent
 */
"use strict";
(function(){

	window.jQuery(function(){

		window.App.createView('ItemInventoryFormComponent', function($, window, document){

			var defaults={
				'formID':'#iform',
				'formMessageClass':'.form-message',
				'formFieldMessageClass':'.field-message',
				'formFieldClass':'.iform-field-control',
				'inventoryItemsClass': '.inventory-item',
				'itemValueClass': '.item-value',
				'itemCountClass': '.item-count',
				'onFormSubmitHandler': function(){},
				'onFormFieldChangeHandler': function(){}
			};

			function ItemInventoryFormComponent(element, options)
			{
				var self=this;
				self.element=$(element);
				self.options=$.extend({}, defaults, options);
				self.init();
			}

			ItemInventoryFormComponent.prototype.initialize=function()
			{
				var self=this;
				/*----------------------------------------*/
				self.element.FormComponent({
					'formID':self.formID,
					'formFieldClass':self.formFieldClass,
					'formFieldErrorClass':self.formFieldErrorClass,
					'formErrorClass':self.formErrorClass,
					'onFormFieldChangeHandler':self.onFormFieldChangeHandler,
					'onFormSubmitHandler':self.onFormSubmitHandler
				});

				self.initInventoryItems();
			};

			ItemInventoryFormComponent.prototype.handleItemCountChange=function(countField)
			{
				var self=this,
					itemField=countField.parent(),
					itemValueField=itemField.find(self.itemValueClass),
					itemName=itemField.attr('data-item-name');
				if(countField.val() > 0){
					itemValueField.prop('checked', true);
					itemValueField.val(countField.val()+" "+itemName+":"+itemName);
				}
			};



			ItemInventoryFormComponent.prototype.handlerItemChecked=function(field)
			{
				var self=this,
					numberField=field.parent().find(self.itemCountClass);
				
				if(numberField.val() < 1) numberField.val(1);
			};

			ItemInventoryFormComponent.prototype.onFormFieldChangeHandler=function(evnt)
			{ 
				evnt.preventDefault();
				var self=this,
					field=$(evnt.currentTarget),
					inventoryForm=self.element.data('plugin_ItemInventoryFormComponent');
				
				 if(field.attr('type')=='checkbox')
				{
					if(field.is(':checked'))
					{
						ItemInventoryFormComponent.prototype.handlerItemChecked.apply(
							inventoryForm, [field]);
					}
				}
				else
				{

					ItemInventoryFormComponent.prototype.handleItemCountChange.apply(
						inventoryForm, [field]);
				}

			};

			ItemInventoryFormComponent.prototype.initInventoryItems=function()
			{
				var self=this,
					inventoryItems=self.element.find(self.inventoryItemsClass);

				inventoryItems.each(function(index, thisItem) {
					var thisItem=$(thisItem),
						itemValueField=thisItem.find(self.itemValueClass),
						itemName=thisItem.attr('data-item-name');
					itemValueField.val(itemValueField.val()+":"+itemName);
				});
			}

			return ItemInventoryFormComponent;
		});
	});
}());