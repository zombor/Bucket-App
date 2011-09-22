var BucketAppController = {
	init: function(spec)
	{
		// default config
		this.config = {
			connect: true
		};

		_.extend(this.config, spec);

		this.model = new BucketAppModel({});
		this.view = new BucketAppView({model: this.model});

		return this;
	}
};