    document.addEventListener("DOMContentLoaded", (event) => {
		console.log('DOM is ready.');	

		var scripts = document.getElementsByTagName('script');
		for(var i = 0, l = scripts.length; i < l; i++){	
			
			var x = scripts[i].hasAttribute("data-stateRdgWidgetArticles");
			if(x==true){

				var state = scripts[i].getAttribute("data-stateRdgWidgetArticles");
				console.log(state);

				if(state == "true"){

						var categories = scripts[i].getAttribute("data-categories");
						console.log(categories);
				
						var amount = scripts[i].getAttribute("data-amount");
						console.log(amount);

						var snippet = scripts[i].getAttribute("data-snippet");
						console.log(snippet);
						
						var target = scripts[i].getAttribute("data-target");
						console.log(target);

						var src = scripts[i].getAttribute("data-src");
						console.log(src);
				
						var source = src+"/widget/"+snippet+"/"+amount;
						console.log(source);
								if(categories == "")
								{
									var xmlHttp = new XMLHttpRequest();
									xmlHttp.open( "GET", src+"/widget/"+snippet+"/"+amount, false ); // false for synchronous request
									xmlHttp.send(null);
								}
								else{
									var xmlHttp = new XMLHttpRequest();
									xmlHttp.open( "GET", src+"/widget/"+snippet+"/"+amount+"/"+categories, false ); // false for synchronous request
									xmlHttp.send(null);
								}
								document.getElementById(target).innerHTML = xmlHttp.responseText;	
								
								scripts[i].setAttribute("data-state", "false");	
					}
			}
			
		}
	});