<?php

namespace ControlPanel;

class Checksums
{
    public function Validate()
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');

        require_once __DIR__.'/Assets/ChkValues.php';
        if ($Checksum['CoreSettings'] !== $CoreSettings) {
            return false;
        }

        return true;
    }

    public function Reset()
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');
        $Data = '<?php $Checksum[\'CoreSettings\'] = \''.$CoreSettings.'\';';
        file_put_contents(__DIR__.'/Assets/ChkValues.php', $Data);
    }
}
