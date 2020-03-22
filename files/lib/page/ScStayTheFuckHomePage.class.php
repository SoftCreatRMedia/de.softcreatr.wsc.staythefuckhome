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

namespace wcf\page;

use wcf\system\exception\SystemException;
use wcf\system\MetaTagHandler;
use wcf\system\request\LinkHandler;
use wcf\system\WCF;
use wcf\util\StringUtil;

class ScStayTheFuckHomePage extends AbstractPage
{
    /**
     * @inheritDoc
     *
     * @throws SystemException
     */
    public function readParameters()
    {
        parent::readParameters();

        $this->canonicalURL = LinkHandler::getInstance()->getLink('ScStayTheFuckHome');
    }

    /**
     * @inheritDoc
     *
     * @throws SystemException
     */
    public function readData()
    {
        parent::readData();

        MetaTagHandler::getInstance()->addTag('og:locale', 'og:locale', WCF::getUser()->getLanguage()->languageCode . '_' . strtoupper(WCF::getUser()->getLanguage()->countryCode), true);
        MetaTagHandler::getInstance()->addTag('og:title', 'og:title', WCF::getLanguage()->get('wcf.page.staythefuckhome.metaTitle') . ' - #StayTheFuckHome', true);
        MetaTagHandler::getInstance()->addTag('og:url', 'og:url', $this->canonicalURL, true);
        MetaTagHandler::getInstance()->addTag('og:type', 'og:type', 'website', true);
        MetaTagHandler::getInstance()->addTag('og:description', 'og:description', WCF::getLanguage()->get('wcf.page.staythefuckhome.metaDescription') . ' #StayTheFuckHome', true);
        MetaTagHandler::getInstance()->addTag('og:image', 'og:image', WCF::getPath() . 'icon/stayHome.png', true);
        MetaTagHandler::getInstance()->addTag('og:image:width', 'og:image:width', 512, true);
        MetaTagHandler::getInstance()->addTag('og:image:height', 'og:image:height', 512, true);

        MetaTagHandler::getInstance()->addTag('twitter:card', 'twitter:card', 'summary', true);
        MetaTagHandler::getInstance()->addTag('twitter:title', 'twitter:title', WCF::getLanguage()->get('wcf.page.staythefuckhome.metaTitle') . ' #StayTheFuckHome', true);
        MetaTagHandler::getInstance()->addTag('twitter:description', 'twitter:description', WCF::getLanguage()->get('wcf.page.staythefuckhome.metaDescription') . ' #StayTheFuckHome', true);
        MetaTagHandler::getInstance()->addTag('twitter:image', 'twitter:image', WCF::getPath() . 'icon/stayHome.png', true);
        MetaTagHandler::getInstance()->addTag('twitter:image:alt', 'twitter:image:alt', '#StayTheFuckHome', true);
        MetaTagHandler::getInstance()->addTag('twitter:site', 'twitter:site', '@1_2_dev', true);
        MetaTagHandler::getInstance()->addTag('twitter:creator', 'twitter:creator', '@1_2_dev', true);

        MetaTagHandler::getInstance()->addTag('keywords', 'keywords', 'SARS-CoV-2, COVID-19, 2019-nCoV, Coronavirus, Corona Virus, Wuhan flu, China flu');
    }

    /**
     * @inheritDoc
     */
    public function assignVariables()
    {
        parent::assignVariables();

        WCF::getTPL()->assign(['encodedEmailAddress' => StringUtil::encodeAllChars(MAIL_ADMIN_ADDRESS)]);
    }
}
