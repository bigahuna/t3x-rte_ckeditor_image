<?php

declare(strict_types=1);

namespace Netresearch\RteCKEditorImage\Database;

use TYPO3\CMS\Backend\Form\FormDataGroupInterface;
use TYPO3\CMS\Backend\Form\FormDataProviderInterface;

class FormDataGroupHook implements FormDataProviderInterface
{
    /**
     * Post-process form data after all FormEngine Data Providers have run
     *
     * @param array $result
     * @return array
     */
    public function addData(array $result): array
    {
        if ($result['tableName'] === 'tt_content' && $result['command'] === 'edit') {
            /** @var \TYPO3\CMS\Core\Html\RteHtmlParser $rteHtmlParser */
            $rteHtmlParser = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Html\RteHtmlParser::class);

            // Iterate over all fields of the record
            foreach ($result['databaseRow'] as $fieldName => $fieldValue) {
                // Check if the field configuration indicates that it's an RTE field
                if (
                    isset($result['processedTca']['columns'][$fieldName]['config']['enableRichtext']) &&
                    $result['processedTca']['columns'][$fieldName]['config']['enableRichtext']
                ) {
                    // Process the content with the RteHtmlParser
                    //$processedContent = $rteHtmlParser->parse($fieldValue);

                    $imgSplit = $rteHtmlParser->splitTags('img', $fieldValue);

                    $y = 1;

                    // Do something with the processed content
                }
            }
        }

        return $result;
    }
}