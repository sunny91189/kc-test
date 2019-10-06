/*  
*	function to call on login form submit
*/
function check(event) {
	event.preventDefault();
	username = document.getElementById('inputUsername').value;
	usrpassword = document.getElementById('inputPassword').value;
					
	if (username === null || username.trim() === "") {
		document.getElementById("message").innerHTML = "Please enter your Username.";
		return false;
	}
	if (usrpassword === null || usrpassword.trim() === "") {
		document.getElementById("message").innerHTML = "Please enter the password.";
		return false;
	}
	
	// Set cookie if user checks Remember me option
	if(document.getElementById("customCheckRemember").checked === true){
		createCookie("username", username, 15);
		createCookie("usrpassword", usrpassword, 15);
	}
	const url = siteURL+"/api/login.php";
	const data = {"username" : username,
					'password' : usrpassword
				};
	try {
		const response = fetch(url, {
			method: 'POST', 
			body: JSON.stringify(data),
			headers: {
			  'Content-Type': 'application/json'
			}
		}).then((resp) => resp.json())
		.then(function(dataresult) {						
			if(dataresult.error){
				document.getElementById("message").innerHTML = dataresult.error;
			}
			if(dataresult.redirect){
				// store jwt to cookie
				createCookie("jwt", dataresult.jwt, 1);
				window.location.href = dataresult.redirect;
			}
		}).catch(function(error) {
			document.getElementById("message").innerHTML = error;
		});
		
	} catch (error) {
	  console.error('Error:', error);
	}
	return true;
}

/*  
*	function to create cookie
*/
function createCookie(cookieName,cookieValue,daysToExpire){
	var d = new Date();
	d.setTime(d.getTime() + (daysToExpire*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
}
	
/*  
*	function to access cookie
*/	
function accessCookie(cookieName){
	var name = cookieName + "=";
	var allCookieArray = document.cookie.split(';');
	for(var i=0; i<allCookieArray.length; i++)
	{
		var temp = allCookieArray[i].trim();
		if (temp.indexOf(name)==0)
		return temp.substring(name.length,temp.length);
	}
	return "";
}

/*  
*	function to check cookie values for Login form input fields
*/
function checkCookie(){
	// remove jwt
	createCookie("jwt", "", 1);
	var usrName = accessCookie("username");
	var usrPssword = accessCookie("usrpassword");

	if (usrName!=""){
		document.getElementById('inputUsername').value = usrName;
		document.getElementById('inputPassword').value = usrPssword;
	}
}

/*  
*	function to run on home page load
*/
function showHomePage(){ 
	// validate jwt to verify access
	var jwt = getCookie('jwt');
	if(jwt==''){
		window.location.href = '/kc-test-task';
	}
	const url = ""+siteURL+"/api/validate_token.php";
	const data = {"jwt" : jwt};
	const response = fetch(url, {
		method: 'POST', 
		body: JSON.stringify(data),
		headers: {
		  'Content-Type': 'application/json'
		}
	}).then((resp) => resp.json())
	.then(function(dataresult) {						
		if(dataresult.error){
			document.getElementById("message").innerHTML = dataresult.error;
		}
		if(dataresult){
			var pageGT = getParameterByName('page');
			const gsurl = ""+siteURL+"/api/liststudents.php";
			const gsdata = {"jwt" : jwt, pageGt: pageGT};
			const response = fetch(gsurl, {
					method: 'POST', 
					body: JSON.stringify(gsdata),
					headers: {
					  'Content-Type': 'application/json'
					}
				}).then((resp) => resp.json())
				.then(function(gsdataresult) {						
					if(gsdataresult.studlist){
						if(gsdataresult.resultCountTotal>gsdataresult.resultPerPage){
							pgNo = Math.ceil(gsdataresult.resultCountTotal/gsdataresult.resultPerPage);
							pgStr = '';							
							for(k=0;k<pgNo;k++){
								j = k+1;
								pgStr = pgStr+'<li id="lid'+j+'"><a href="'+siteURL+'students.html?page='+j+'">'+j+'</a></li>'; 
							}
							nxtPage = +1 + +gsdataresult.resultPage;
							
							if(nxtPage >= gsdataresult.resultPage && nxtPage <= pgNo){
								pgStr = pgStr+'<li id="lidNxt"><a href="'+siteURL+'students.html?page='+nxtPage+'">Next >></a></li>'; 
							}
							document.getElementById("paginationId").innerHTML = pgStr;
							document.getElementById("lid"+gsdataresult.resultPage+"").className = 'active';
						}	
						for (i in gsdataresult.studlist)
						{
							var table = document.getElementById("myTable");

							// Create an empty <tr> element and add it to the 1st position of the table:
							var row = table.insertRow(0);

							// Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
							var cell1 = row.insertCell(0);
							var cell2 = row.insertCell(1);

							// Add some text to the new cells:
							cell1.innerHTML = '<img src="img/right-click.png" class="rightClickTbl" alt="right"/>'+gsdataresult.studlist[i].username+'<br />'+gsdataresult.studlist[i].name;
							cell2.innerHTML = gsdataresult.studlist[i].email;
						}
					}
				}).catch(function(error) {
					console.error('Error:', error);
				});
		}
	}).catch(function(error) {
		console.error('Error:', error);
	});
}

/*  
*	function to get url parameters by name
*/
function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, '\\$&');
	var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
		results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

/*  
*	function to get or read cookie
*/
function getCookie(cname){
	var name = cname + "=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' '){
			c = c.substring(1);
		}
 
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

/*  
*	function to call on logout action
*/
function logUsrOut(){
	createCookie("jwt", "", 1);
	window.location.href = siteURL;
}