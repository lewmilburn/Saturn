<?php

namespace Saturn\PluginManager;

class Hibernate
{
    public function IsHibernating($Manifest): bool
    {
        if (in_array($_SERVER['REQUEST_URI'], $Manifest->Hibernate)) {
            return false;
        }

        return true;
    }
}
