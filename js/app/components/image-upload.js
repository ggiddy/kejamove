"use strict";
window.App.createView('ImageUploadComponent', function($, window, document){

	var defaults={};

	function ImageUploadComponent(element, options)
	{
		var self=this;
		self.element=$(element);
		self.options=$.extend({}, defaults, options);
		self.init();
	}

	ImageUploadComponent.prototype.init=function()
	{
		var self=this;
		self.registerHandlers();
	};

	ImageUploadComponent.prototype.defaultHandlers=function()
	{
		var self=this;

		return {
			'onImageChangeBtnClicked': 
			{
				'el':self.options['changeBtnClass'] ? self.options['changeBtnClass'] : '.change-btn',
				'event':'click',
				'handlers':[function(evnt){
					evnt.preventDefault();
					var editBtn=$(evnt.currentTarget);
					self.startChangeUpload(editBtn);
				}]
			}
		};
	};

	ImageUploadComponent.prototype.startChangeUpload=function(contextBtn)
	{
		var self=this,
		    FileInput=self.createUploadInput(contextBtn);

		self.showUploadProgress(contextBtn);

		FileInput.on('change', function(evnt){
			var context=null;
			self.startUpload(context, contextBtn);
		});

		FileInput.click();
	};

	ImageUploadComponent.prototype.createUploadInput=function(contextBtn)
	{
		var self=this,
			FileInput=$('<input name="upload_photo" type="file"/>');
		return FileInput;
	};

	ImageUploadComponent.prototype.startUpload=function(context, contextBtn)
	{
		var self=this,
			clientUploadHandler=self.options['uploadHandler'];

		if(clientUploadHandler && clientUploadHandler instanceof Function)
		{
			self.showUploadProgress(contextBtn);

			clientUploadHandler.apply(this,[$.ajax({
				//'url':context['uploadUrl'],
				'type':'post',
				'dataType':'json',
				//'data':context['files']
			}), contextBtn]);
		}
	};

	ImageUploadComponent.prototype.showUploadMessage=function()
	{
		var self=this;
	};


	ImageUploadComponent.prototype.removeUploadMessage=function()
	{
		var self=this;
	};

	ImageUploadComponent.prototype.showUploadProgress=function(contextBtn)
	{
		var self=this,
		    imageFrame=self.element.find(contextBtn.attr('data-imageframe-id')),
		    currentImage=imageFrame.find('img');
		
		self.options['previousImageSrc']=currentImage.attr('src');
		currentImage.attr('src', self.options['progressAnimation']);
	};

	ImageUploadComponent.prototype.removeUploadProgress=function(contextBtn)
	{
		var self=this,
		    imageFrame=self.element.find(contextBtn.attr('data-imageframe-id')),
		    currentImage=imageFrame.find('img');

		currentImage.attr('src', self.options['previousImageSrc']);
	};

	return ImageUploadComponent;
});