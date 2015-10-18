(function($) {
	// $('.ui.search')
	//   .search({
	//     apiSettings: {
	//       url: '/index.php?act=procRhclaimSearchProducts&search_keyword={query}'
	//     },
	//     fields: {
	//       results : 'output_data',
	//       title   : 'variables["title"]',
	//       url     : 'html_url'
	//     },
	//     minCharacters : 3
	//   })
	// ;

$('.ui.search')
  .search({
    minCharacters : 3,
    apiSettings   : {
      onResponse: function(serverResponse) {
        var response = {
            results : []
          };

        // translate github api response to work with search
        $.each(serverResponse.output_data, function(index, item) {
        	console.log(index, item);
          
          
          // add result to category
          response.results.push({
            title       : item.variables.title,
            description : item.description,
            url         : item.html_url
          });
        });

        console.log(response);
        return response;

      },
      url: '/index.php?act=procRhclaimSearchProducts&search_keyword={query}'
    }
  })
;
	
})(jQuery);





// jQuery(function($) {
// 	console.log('test');
// });
