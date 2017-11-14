jQuery(function($) {
	$(document).ready(function(){
		$("#custom_search_submit").on("click", function(){
			var text_value=$("#custom_search_text").val();
			//alert($("#custom_select_dropdown").length);
			if($("#custom_select_dropdown").length>0) {
				var dropdown_value=$("#custom_select_dropdown").val();
			} else {
				var dropdown_value='all';	
			}
			if(dropdown_value!='') {
				if(text_value!='') {
					window.location.href="http://localhost/dev_research/solr-search/content?search=" +text_value+"&content_type="+dropdown_value;
				} else {
					// console.log(dropdown_value);
					window.location.href="http://localhost/dev_research/solr-search/content?search=all&content_type="+dropdown_value;
				}		
			} else {
				if(text_value!='') {
					window.location.href="http://localhost/dev_research/solr-search/content?search=" +text_value+"&content_type=all";
				} else {
					window.location.href="http://localhost/dev_research/solr-search/content?search=all&content_type=all";
				}		
			}
		});
	});
});