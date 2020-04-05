<?
/************* Agent Authentication ***************/
$sid_parm = '';
if (!empty($_POST['p_sid'])) {
    $sid_parm = trim($_POST['p_sid']);
}
else if (!empty($_GET['p_sid'])){
   $sid_parm = trim($_GET['p_sid']); 
}

// Find our position in the file tree
if (!defined('DOCROOT')) {
    $docroot = get_cfg_var('doc_root');
    define('DOCROOT', $docroot);
}

$baseDir = dirname($_SERVER['PATH_INFO']);

// Set up and call the AgentAuthenticator
require_once (DOCROOT . '/include/services/AgentAuthenticator.phph');

$account = AgentAuthenticator::authenticateSessionID($sid_parm);
/********************* end agent authentication ***************************/

use RightNow\Connect\v1_1 as RNCPHP;
/** 
 ** Description    :  Used on product attribute workspace to add product to warranty region fields 
*/

$ip_dbreq = true; require_once('include/init.phph');

list ($common_cfgid, $rnw_common_cfgid, $rnw_ui_cfgid, $ma_cfgid)
    = msg_init($p_cfgdir, 'config', array('common', 'rnw_common', 'rnw_ui', 'ma'));

list ($common_mbid, $rnw_mbid)
    = msg_init($p_cfgdir, 'msgbase', array('common', 'rnw'));

require_once('ext_evt/rma_utils.phph');

// edit to remediate removal of register_globals directive, Dan Douthit, Upgrade Engineering, 4/7/16
$product_id = '';
$product_id = $_GET['product_id'];

if($product_id != '')
{
   if($product      =    RNCPHP\ServiceProduct::first("ID = $product_id"))
   {
   echo "<h2>Add or Remove Region2Product_Warrs Records for Product: " . $product->Name  . "</h2>";

   try{

     // handle submission of form
    if($_REQUEST['submit'])
    {
    	$region_id=$_REQUEST['region_id'];
    	$warr_id=$_REQUEST['warr_id'];
    	$regions     =    RNCPHP\CO\product_region::fetch($region_id);
        $warranty_terms      =    RNCPHP\CO\warranty_term::fetch($warr_id);

        $region2product_warrs = new RNCPHP\CO\region2product_warr();
        $region2product_warrs->region_id = $regions;
        $region2product_warrs->wt_id = $warranty_terms;
        $region2product_warrs->product_id = $product;

        $region2product_warrs->save();
        echo "new record for region2product_warrs has been created";
    }
    // handle deletion
    elseif($_REQUEST['delete']){
    	$delete=$_REQUEST['delete'];
        if($region2product_warrs     =    RNCPHP\CO\region2product_warr::fetch($delete)){
            $region2product_warrs->destroy();   
            echo "region2product_warrs with ID $delete has been destroyed";
        }
    }
    // start of getting data
  $where              =   "1=1 ";
  $regions     =    RNCPHP\CO\product_region::find($where);

  if($product_id)
  {
      $where              =   "product_id = '".$product_id."' ";
        $region2product_warrs     =    RNCPHP\CO\region2product_warr::find($where);
  }

  $where              =   "1=1 ";
  $warranty_terms      =    RNCPHP\CO\warranty_term::find($where); 
    
  }catch (Exception $err)
  {
       print($err->getMessage());
  } 
    // start of html
?>

<form method="POST">
<table border="1">
<tr>
    <th>Region</th>
    <td>
        <select name="region_id">
    <? foreach($regions as $region) { ?>
      <option value="<?= $region->ID ?>"><?= $region->LookupName ?></option>
    <? } ?>
    </select>
    </td>
</tr>
<tr>
    <th>Warranty</th>
    <td>
        <select name="warr_id">
    <? foreach($warranty_terms as $warranty_term) { ?>
      <option value="<?= $warranty_term->ID ?>"><?= $warranty_term->label_text->Name ?></option>
    <? } ?>
    </select>
    </td>
</tr>
<tr>
    <td colspan="2">
        <input type="submit" name="submit" value="submit">
    </td>
</tr>
</table>
<input type="hidden" name="product_id" value="<?= $product_id ?>" /> </form>

<table border="1" >
<tr>
    <th>Region</th>
    <th>Warranty Terms</th>
    <th>Action</th>
</tr>
    <? 
    foreach($region2product_warrs as $region2product_warr){ ?> <tr>
    <td><?= $region2product_warr->region_id->LookupName  ?></td>
    <td><?= $region2product_warr->wt_id->label_text->Name  ?></td>
    <td><a href="product_attr_region.php?product_id=<?= $product_id?>&delete=<?= $region2product_warr->ID ?>&p_sid=<?=$sid_parm ?>">Delete</a></td> </tr>
    <? } ?>
</table>

<?    }else{
         echo "Product with id: $product_id not found.  Please associate a valid Product to the product attribute record";
      }
   }else{ ?>
   No Product ID found, please make sure a product is assigned to the product attribute record and then re-load this page
<? } ?>
