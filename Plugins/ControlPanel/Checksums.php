<?php

namespace ControlPanel;

use Exception;
use Saturn\ErrorHandler;

class Checksums
{
    public function Validate(): bool
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');

        require_once __DIR__.'/Assets/ChkValues.php';

        if ($Checksum['CoreSettings'] !== $CoreSettings) {
            return false;
        }

        return true;
    }

    public function Reset(): void
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');
        $Data = '<?php $Checksum[\'CoreSettings\'] = \''.$CoreSettings.'\';';

        if (is_writable(__DIR__.'/Assets/ChkValues.php')) {
            try {
                $fp = fopen(__DIR__ . '/Assets/ChkValues.php', 'w');
                if (fwrite($fp, $Data) === FALSE) {
                    $Error = new ErrorHandler();
                    $Error->SaturnError(
                        '500',
                        'SAT-6',
                        'Error Resetting Checksums',
                        'There was a problem whilst resetting the checksums.',
                        SATSYS_DOCS_URL . '/troubleshooting/errors/saturn#sat-6'
                    );
                }
                fclose($fp);
            } catch (Exception $e) {
                $Error = new ErrorHandler();
                $Error->SaturnError(
                    '500',
                    'SAT-6',
                    'Error Resetting Checksums',
                    'There was a problem whilst resetting the checksums. ' . $e->getMessage(),
                    SATSYS_DOCS_URL . '/troubleshooting/errors/saturn#sat-6'
                );
            }
        } else {
            if (!file_exists(__DIR__.'/Assets/ChkValues.php')) {
                $Error = new ErrorHandler();
                $Error->SaturnError(
                    '500',
                    'SAT-7',
                    'File is not writeable',
                    'DOES NOT EXIST: /Plugins/ControlPanel/Assets/ChkValues.php',
                    SATSYS_DOCS_URL . '/troubleshooting/errors/saturn#sat-7'
                );
            } else {
                $Error = new ErrorHandler();
                $Error->SaturnError(
                    '500',
                    'SAT-7',
                    'File is not writeable',
                    'NO PERMISSION: /Plugins/ControlPanel/Assets/ChkValues.php',
                    SATSYS_DOCS_URL . '/troubleshooting/errors/saturn#sat-7'
                );
            }
        }
    }
}
