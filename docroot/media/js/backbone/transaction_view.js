var TransactionView = Backbone.View.extend(
{
	initialize: function(args)
	{
		_.bindAll(this, 'changePayee');

		this.model.bind('change:payee', this.changePayee);
	},
	events:
	{
		'click .payee': 'handlePayeeClick'
	},
	render: function()
	{
		this.el = ich.template_transaction(this.model.toJSON());
		return this;
	},
	changePayee: function()
	{
		this.$('.payee').text(this.model.get('payee'));
	},
	handlePayeeClick: function()
	{
		alert('you clicked the payee: '+this.model.get('payee'));
	}
});