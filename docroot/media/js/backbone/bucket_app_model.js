var BucketAppModel = Backbone.Model.extend(
{
	initialize: function()
	{
		this.transactions = new TransactionCollection();
	}
});