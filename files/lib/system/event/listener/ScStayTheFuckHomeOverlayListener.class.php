<?php
/*
 * Copyright by SoftCreatR Media.
 * This file is part of de.softcreatr.wsc.staythefuckhome.
 *
 * License: https://support.softcreatr.de/lizenzbedingungen/#kostenfreie-produkte
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 *
 * The above copyright notice and this disclaimer notice shall be included in all
 * copies or substantial portions of the Software.
 */

namespace wcf\system\event\listener;

use wcf\system\application\ApplicationHandler;
use wcf\system\request\RouteHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

class ScStayTheFuckHomeOverlayListener implements IParameterizedEventListener {
    /**
     * @inheritDoc
     */
    public function execute($eventObj, $className, $eventName, array &$parameters) {
        $cookieName = COOKIE_PREFIX . 'hideStfhOverlay';
        
        if (isset($_COOKIE[$cookieName])) {
            return;
        }
        
        $expire = TIME_NOW + (24 * 60 * 60);
        $application = ApplicationHandler::getInstance()->getActiveApplication();
        $addDomain = (mb_strpos($application->cookieDomain, '.') === false || StringUtil::endsWith($application->cookieDomain, '.lan') || StringUtil::endsWith($application->cookieDomain, '.local')) ? false : true;
        $cookieDomain = $application->cookieDomain;
        
        if ($addDomain && strpos($cookieDomain, ':') !== false) {
            $cookieDomain = explode(':', $cookieDomain, 2)[0];
        }
        
        WCF::getTPL()->assign([
            'showStfhOverlay' => true,
            'cookieString' => rawurlencode($cookieName) . '=1; expires=' . gmdate('D, d-M-Y H:i:s', $expire) . ' GMT; max-age='.($expire - TIME_NOW) . '; path=/' . ($addDomain ? '; domain=' . mb_strtolower($cookieDomain) : '') . (RouteHandler::secureConnection() ? '; secure' : '')
        ]);
    }
}
