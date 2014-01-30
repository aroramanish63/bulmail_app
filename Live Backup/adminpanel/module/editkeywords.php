<?php

/* Created By : Shambhulal Verma
 *
 *
 */
?>
<?php

require_once($cfg['admin_path'] . "functions/publishClass.php");
$adminFunc = new publishClass();
$regions = $adminFunc->select('tbl_site_region');
if (isset($_POST['region'])) {
    $file = '';
    foreach ($regions as $region) {
        if ($region['id'] == $_POST['region']) {
            $file = $region['directory'] . '/' . $region['region_name'];
        }
    }


    $languages = $adminFunc->select("tbl_language");
    $lang = array();
    foreach ($languages as $language) {
        $lang[$language['id']] = $language['language'];
    }

    $where = array('key_region' => $_POST['region'], 'lang_key' => $_POST['lang_key']);
    $keywords = $adminFunc->select("tbl_lang_keywords", "*", $where);
    echo '<table class="table table-striped table-bordered"><thead><tr><th>Language</th><th>Text</th></tr></thead><tbody>';
    foreach ($keywords as $keyword) {
        echo '<tr><td>' . $lang[$keyword['lang_id']] . '</td>
                  <td><textarea style="height:100%; width:100%" name="val[][' . $keyword['id'] . ']">' . $keyword['lang_value'] . '</textarea></td></tr>';
    }
    echo '</tbody>
        </table>
        <div class="form-actions">
        <input type="submit" class="btn btn-primary" name="btn_save_text" value="Save" />
        </div>';
}
?>