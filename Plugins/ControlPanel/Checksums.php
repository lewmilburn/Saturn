<?php

namespace ControlPanel;

class Checksums
{
    public function Validate()
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');
        $CoreDeveloper = hash_file('sha3-512', __DIR__.'/../../Settings/Developer.php');

        require_once __DIR__.'/Assets/ChkValues.php';
        if ($Checksum['CoreSettings'] !== $CoreSettings) {
            return false;
        }
        if ($Checksum['CoreDeveloper'] !== $CoreDeveloper) {
            return false;
        }

        return true;
    }

    public function Reset()
    {
        $CoreSettings = hash_file('sha3-512', __DIR__.'/../../Settings/Settings.php');
        $CoreDeveloper = hash_file('sha3-512', __DIR__.'/../../Settings/Developer.php');
        $Data = '<?php $Checksum[\'CoreSettings\'] = \''.$CoreSettings.'\'; $Checksum[\'CoreDeveloper\'] = \''.$CoreDeveloper.'\';';
        file_put_contents(__DIR__.'/Assets/ChkValues.php', $Data);
    }
}
