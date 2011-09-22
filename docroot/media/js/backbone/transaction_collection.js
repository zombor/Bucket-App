var TransactionCollection = Backbone.Collection.extend({
	model: Transaction,
	initialize: function() {
		var trans = new Transaction(
		{
			date: '1/1/2012',
			amount: '1.50',
			memo: 'testing',
			cleared_status: false,
			payee: 'foobar',
			bucket_id: 1,
			account_id: 1
		});
		var trans2 = new Transaction(
		{
			date: '1/1/2012',
			amount: '1.50',
			memo: 'testing',
			cleared_status: false,
			payee: 'foobar',
			bucket_id: 1,
			account_id: 1
		});

		this.add(trans);
		this.add(trans2);
	}
});