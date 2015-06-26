/**
 * Test of de browser op een telefoon draait
 * 
 * @returns boolean					true = mobiel, false = geen mobiel
 * @since 1.0.0 - 12 november 2012
 * @auhtor http://www.mobile247.eu
 */
function bTestForPhone() {
	var aSmartPhoneUserAgentStrings = new Array('iPhone', 'Nokia', 'MOT', 'Android', 'PalmSource', 'webOS', 'SAMSUNG', 'SonyEricsson', 'LG', 'HTC', 'BlackBerry', 'Windows Phone');
	for (var i=0; i < aSmartPhoneUserAgentStrings.length; ++i ) {
		var oRegularExpression = new RegExp(aSmartPhoneUserAgentStrings[i], "i");
		if (navigator.userAgent.match(oRegularExpression)) return true;
	}
	return false;
}

/**
 * Toont een alert als de gebruikte browser op een mobiele telefoon draait
 * 
 * @param a_sMessageMobile			de melding die getoond wordt indien een mobiel gedetecteerd wordt
 * @param a_sMessageDesktop			de melding die getoond wordt indien geen mobiel gedetecteerd wordt
 * @since 1.0.0 - 12 november 2012
 * @auhtor http://www.mobile247.eu
 */
function vAlertOnPhone(a_sMessageMobile, a_sMessageDesktop) {
	if (bTestForPhone()) alert(a_sMessageMobile);
	else alert(a_sMessageDesktop);
}

/**
 * Schakelt over naar mobiel indien nodig
 * 
 * @param a_sMobileDomain			het domein van de mobiele website
 * @since 1.0.0 - 12 november 2012
 * @auhtor http://www.mobile247.eu
 */
function vSwitchToMobile(a_sMobileDomain) {
	if (bTestForPhone()) document.location = a_sMobileDomain;
}