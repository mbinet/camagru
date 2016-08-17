// This function intends to transfer a js data to php.

function getXMLHttpRequest() {
    
    var xhr = null;
    	
    if (window.XMLHttpRequest || window.ActiveXObject) {
    	if (window.ActiveXObject) {
    		try {
    			xhr = new ActiveXObject("Msxml2.XMLHTTP"); // new
    		}
    		catch(e) {
    			xhr = new ActiveXObject("Microsoft.XMLHTTP"); // old
    		}
    	}
    	else {
    		xhr = new XMLHttpRequest(); 
    	}
    }
    else {
    	alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
    	return null;
    }
    return (xhr);
}


