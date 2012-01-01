/**
 * 
 */
Auctioneer = {
	init : function () {
		$(".item").each(function(i) {
			$(this).find(".timer").html("test");
		});
	}
};
$(Auctioneer.init);