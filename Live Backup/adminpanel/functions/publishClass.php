<?php

/**
 * Description of publishClass
 *
 * @author Shambhulal verma
 */
class publishClass extends AdminFunctions {

    public function __construct() {
        parent::__construct();
    }

    public function publish($page_id, $language) {
        if ($page_id == '' || $language == '') {
            return 'error';
        }
        global $cfg;
        $strtoupper = 'strtoupper';
        $ucwords = 'ucwords';
        $ucfirst = 'ucfirst';
        $include = 'include';
        $currency = 'currency';

        $where = array('id' => $language);
        $language_attr = $this->select($this->cfg['db_prefix'].'language', '*', $where);
        $lang_val = $this->langValuePublish($language_attr[0]['id'], $page_id);
        if (!count($lang_val) > 0) {
            return array('err' => 'Keyword not found');
        }
        $region_attr = $this->select($this->cfg['db_prefix'].'site_region', '*', array('id' => $page_id));
        if (count($region_attr) > 0) {
            foreach ($region_attr as $region) {
                ${$region['region_name'] . '_arr'} = $region['id']; //dynamic variable to use in array indexing
                if ($region['id'] == $page_id) {
                    $var_name = $region['region_name'];
                    $file_path = $region['directory'] . '/' . $region['region_name'];
                    if (!is_writable($cfg['base_path'] . $region['directory'])) {
                        return array('err' => $cfg['base_path'] . $region['directory'] . ' is not writable');
                    }
                    $fp = fopen($cfg['base_path'] . $file_path . '_' . strtolower($language_attr[0]['abrv']) . '.php', "w");
                    $code = htmlspecialchars_decode($region['page_code'], ENT_QUOTES);
                    if (!is_writable($cfg['admin_path'] . 'temp')) {
                        return array('err' => $cfg['admin_path'] . 'temp/ is not writable');
                    }
                    $temp = fopen($cfg['admin_path'] . 'temp/' . $var_name . '.php', 'w');
                    $writecnotent = '<?php $' . "$var_name" . ' = <<<EOL
';
                    $writecnotent.=$code;
                    $writecnotent.='

EOL;
                    ?>';
                    fwrite($temp, $writecnotent);
                    fclose($temp);
                    include $cfg['admin_path'] . 'temp/' . $var_name . '.php';

                    fwrite($fp, $$var_name);
                    fclose($fp);

                    $published = $this->update($this->cfg['db_prefix'].'site_region', array('published' => 1), array('id' => $page_id));
                }
            }
        }
        return array('success' => $var_name . '(' . $language_attr[0]['language'] . ') Published  ');
    }

}

?>
