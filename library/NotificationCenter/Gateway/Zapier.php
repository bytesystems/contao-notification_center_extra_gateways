<?php

namespace NotificationCenter\Gateway;

use NotificationCenter\MessageDraft\ZapierMessageDraft;
use NotificationCenter\Gateway\Base;
use NotificationCenter\Gateway\GatewayInterface;
use NotificationCenter\MessageDraft\MessageDraftFactoryInterface;
use NotificationCenter\MessageDraft\PostmarkMessageDraft;
use NotificationCenter\Model\Language;
use NotificationCenter\Model\Message;


class Zapier extends Base implements GatewayInterface
{


    /**
     * Send Postmark request message
     * @param   Message
     * @param   array
     * @param   string
     * @return  bool
     */
    public function send(Message $objMessage, array $arrTokens, $strLanguage = '')
    {
        if ($this->objModel->zapier_url == '') {
            \System::log(sprintf('Please provide the Zapier URL for message ID "%s"', $objMessage->id), __METHOD__, TL_ERROR);

            return false;
        }
//
//        /**
//         * @var $objDraft \NotificationCenter\MessageDraft\PostmarkMessageDraft
//         */
//        $objDraft = $this->createDraft($objMessage, $arrTokens, $strLanguage);
//
//        // return false if no language found for BC
//        if ($objDraft === null) {
//            return false;
//        }
//
//        $strFrom = $objDraft->getSenderEmail();
//        // Generate friendly name from address if possible
//        if ($strSenderName = $objDraft->getSenderName()) {
//            // Don't do this if the sender name contains the email address
//            if ($strFrom !== $strSenderName) {
//                $strFrom = $strSenderName . ' <' . $strFrom . '>';
//            }
//        }
//
//        // Recipients
//        $arrTo  = $objDraft->getRecipientEmails();
//        $arrCc  = $objDraft->getCcRecipientEmails();
//        $arrBcc = $objDraft->getBccRecipientEmails();
//
//        if (count(array_merge($arrTo, $arrCc, $arrBcc)) >= 20) {
//            \System::log(
//                sprintf('The Postmark gateway does not support sending to more than 20 recipients (CC and BCC included) for message ID "%s".',
//                    $objMessage->id
//                ),
//                __METHOD__,
//                TL_ERROR);
//
//            return false;
//        }
//
//        // Set basic data
//        $arrData = array
//        (
//            'From'       => $strFrom,
//            'To'         => implode(',', $arrTo),
//            'Subject'    => $objDraft->getSubject(),
//            'HtmlBody'   => $objDraft->getHtmlBody(),
//            'TextBody'   => $objDraft->getTextBody(),
//            'TrackOpens' => $objDraft->getTrackOpen()
//        );
//
//        // Set CC recipients
//        if (!empty($arrCc)) {
//            $arrData['Cc'] = implode(',', $arrCc);
//        }
//
//        // Set BCC recipients
//        if (!empty($arrBcc)) {
//            $arrData['Bcc'] = implode(',', $arrBcc);
//        }
//
//        // Set reply-to address
//        if ($strReplyTo = $objDraft->getReplyToEmail()) {
//            $arrData['ReplyTo'] = $strReplyTo;
//        }
//
//        // Set the Postmark tag
//        if ($strTag = $objDraft->getTag()) {
//            $arrData['Tag'] = $strTag;
//        }
//
        $strData = json_encode($arrTokens);

        $objRequest = new \Request();
        $objRequest->setHeader('Content-Type', 'application/json');
//        $objRequest->setHeader('X-Postmark-Server-Token', ($this->objModel->postmark_test ? 'POSTMARK_API_TEST' : $this->objModel->postmark_key));
        $objRequest->send($this->objModel->zapier_url, $strData, 'POST');

        // Postmark uses HTTP status code 10 for wrong API keys. The contao request class cannot handle this and thus returns 0.
        $code = $objRequest->code;
        if ($code == 0) {
            $code = 10;
        }
//
        if ($objRequest->hasError()) {
            \System::log(
                sprintf('Error sending the Zapier request for message ID "%s". HTTP Response status code: %s. JSON data sent: %s',
                    $objMessage->id,
                    $code,
                    $strData
                ),
                __METHOD__,
                TL_ERROR);

            return false;
        }

        return true;
    }
}
