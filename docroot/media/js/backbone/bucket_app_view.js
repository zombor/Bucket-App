var BucketAppView = Backbone.View.extend(
{
	initialize: function()
	{
		this.model.transactions.bind('add', this.addTransaction);
		this.model.transactions.bind('remove', this.removeTransaction);
	},
	events: {
		
	},
	render: function()
	{
		this.el = ich.template_app(this.model.toJSON());

		// store a reference to our movie list
		this.transactionList = this.$('#transactions');

		return this;
	},
	addTransaction: function(transaction)
	{
		var view = new TransactionView({model: transaction});

		// here we use our stored reference to the movie list element and
		// append our rendered movie view.
		this.transactionList.append(view.render().el);
	},
	removeTransaction: function(transaction)
	{
		// here we can use the html ID we stored to easily find
		// and remove the correct element/elements from the view if the 
		// collection tells us it's been removed.
		this.$('#' + transaction.get('htmlId')).remove();
	}
});