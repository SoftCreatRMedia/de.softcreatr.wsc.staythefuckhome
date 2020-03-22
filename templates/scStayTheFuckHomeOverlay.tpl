<!-- scStayTheFuckHomeOverlay.tpl -->
<div id="scStayTheFuckHomeOverlay">
	<div id="scStayTheFuckHomeOverlayBox">
		<a href="#" class="jsTooltip" id="scStayTheFuckHomeOverlayCloseLink" title="{lang}wcf.global.button.close{/lang}"><span class="icon icon24 fa-times"></span></a>
        
		<div id="scStayTheFuckHomeOverlayIcon"><img src="{@$__wcf->getPath()}icon/coronaVirusInfo.png" alt="#StayTheFuckHome"></div>
		
		<p>{lang}wcf.staythefuckhome.overlay.text{/lang}</p>
        
        <p class="text-right"><a class="button buttonPrimary" onclick="setStfhOverlayCookie()" href="{link controller='ScStayTheFuckHome'}{/link}">{lang}wcf.staythefuckhome.overlay.moreInfoButton{/lang}</a></p>
	</div>
</div>

<script data-relocate="true">
    elById('scStayTheFuckHomeOverlayCloseLink').addEventListener(WCF_CLICK_EVENT, function() {
        // hide overlay
        elHide(elById('scStayTheFuckHomeOverlay'));
        
        // restore scrolling
        if (document.all) {
            elBySel('body').style.setAttribute('cssText', 'overflow: auto !important' );
        } else {
            elBySel('body').setAttribute('style', 'overflow: auto !important' );
        }
        
        // set cookie
        setStfhOverlayCookie();
    });
    
    function setStfhOverlayCookie() {
        var date = new Date();
        date.setTime(date.getTime() + (60 * 60 * 24 * 1000));
        
        document.cookie = "{COOKIE_PREFIX}hideStfhOverlay=1; expires=" + date.toUTCString() + "; path=/";
    }
</script>
<!-- /scStayTheFuckHomeOverlay.tpl -->
