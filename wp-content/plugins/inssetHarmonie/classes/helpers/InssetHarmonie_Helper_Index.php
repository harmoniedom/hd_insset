<?php

class inssetHarmonie_Helper_Index{

    public function isOpen(){

        $Configs =inssetHarmonie_crud_index::getConfigs();

        foreach($Configs as $Config)
            if ($id = $Config['id'])
                $$id = $Config['valeur'];

        if(!@$DateOuverture || !@$DateFermeture)
            return false;

        $start_at = strtotime($DateOuverture);
        $end_at= strtotime($DateFermeture);
        $now = strtotime(date('Y-m-d H:i'));

        return ($now >=$start_at ) && ($now <= $end_at);

    }
}
