<?php

namespace Saturn\PluginManager;

class Hibernate
{
    public function IsHibernating($Manifest): bool
    {
        foreach ($Manifest->Hibernate as $hibernatePath) {
            if (str_contains($_SERVER['REQUEST_URI'], $hibernatePath)) {
                return false;
            }
        }

        return true;
    }
}
