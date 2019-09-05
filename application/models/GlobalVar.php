<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class GlobalVar extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
	}
	function GetSideBar($userid,$parent)
	{
		$data = "
			select d.* from users a
			inner join userrole b on a.id = b.userid
			inner join permissionrole c on b.roleid = c.roleid
			inner join permission d on c.permissionid = d.id
			where a.id = $userid AND d.menusubmenu = $parent
		";
		return $this->db->query($data);
	}
}