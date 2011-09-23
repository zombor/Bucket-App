var TransactionView = Backbone.View.extend(
{
	tagName: 'tr',
	initialize: function(args)
	{
		_.bindAll(this, 'changePayee');

		this.model.bind('change:payee', this.changePayee);
	},
	events:
	{
		'dblclick td': 'handleDblClick',
		'keydown input': 'handleKeydown',
	},
	render: function()
	{
		$(this.el).html(ich.template_transaction(this.model.toJSON()));
		return this;
	},
	changePayee: function()
	{
		this.$('.payee').text(this.model.get('payee'));
	},
	handleDblClick: function(e)
	{
		// convert the text into an input to change the data
		var klass = e.currentTarget.className
		this.$('.'+klass).html('<input type="text" class="'+klass+'" name="'+klass+'" value="'+this.model.get(klass)+'" />');
	},
	handleKeydown: function(e)
	{
		// Save the model when enter is pressed
		if (e.keyCode == 13)
		{
			var klass = e.currentTarget.className
			var val = this.$('input[name='+klass+']').val();
			this.$('.'+klass).html(val);
			var model_attributes = {};
			model_attributes[klass] = val;
			this.model.set(model_attributes);
		}
	}
});