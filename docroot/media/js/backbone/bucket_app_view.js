var BucketAppView = Backbone.View.extend(
{
	initialize: function()
	{
		_.bindAll(this, 'addTransaction', 'removeTransaction');
		this.model.transactions.bind('add', this.addTransaction);
		this.model.transactions.bind('remove', this.removeTransaction);
	},
	events: {
		'click #add'   : 'addTransactionLinkClick',
		'click #remove': 'removeTransactionLinkClick'
	},
	render: function()
	{
		$(this.el).html(ich.template_app(this.model.toJSON()));

		// store a reference to our movie list
		this.transactionList = this.$('table#transactions');

		return this;
	},
	addTransaction: function(transaction)
	{
		var view = new TransactionView({model: transaction, id: transaction.cid});

		// here we use our stored reference to the transaction list element and
		// append our rendered movie view.
		this.transactionList.append(view.render().el);
	},
	removeTransaction: function(transaction)
	{
		// here we can use the html ID we stored to easily find
		// and remove the correct element/elements from the view if the 
		// collection tells us it's been removed.
		this.$('#' + transaction.cid).remove();
	},
	addTransactionLinkClick: function(transaction)
	{
		this.model.transactions.add(transaction);
	},
	removeTransactionLinkClick: function()
	{
		var to_delete = this.model.transactions.select(
			function(transaction)
			{
				if (transaction.get('selected'))
				{
					return true;
				}
			}
		);

		this.model.transactions.remove(to_delete);
	}
});